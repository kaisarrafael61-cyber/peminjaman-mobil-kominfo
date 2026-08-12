<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class PeminjamanController extends Controller
{
    /**
     * Menampilkan halaman utama peminjaman / riwayat peminjaman user.
     */
    public function index()
    {
        $riwayat = Peminjaman::where('user_id', Auth::id())->latest()->get();
        return view('peminjaman.riwayat', compact('riwayat'));
    }

    /**
     * Menangani proses autentikasi login pengguna.
     */
    public function login(Request $request)
    {
        // 1. Validasi Input Data Form
        $credentials = $request->validate([
            'username' => 'required|string',
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        // 2. Logika Pengecekan Akun
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Jika sukses, arahkan ke halaman dashboard
            return redirect()->intended('/dashboard');
        }

        // 3. Jika gagal, kembalikan ke halaman login dengan pesan error
        return back()->withErrors([
            'login_error' => 'Kredensial yang dimasukkan tidak cocok dengan data kami.',
        ])->onlyInput('username', 'email');
    }

    /**
     * Menampilkan halaman khusus persetujuan peminjaman untuk Admin.
     */
    public function adminIndex()
    {
        // Ambil data peminjaman beserta relasi user dan car/mobil
        $peminjamans = Peminjaman::with(['user', 'car'])->orderBy('id', 'desc')->get();

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    /**
     * 1. User: Simpan Pengajuan Peminjaman Mobil (beserta foto sebelum).
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id'          => 'required',
            'alasan'          => 'required|string',
            'tanggal_pinjam'  => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'foto_sebelum'    => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $fotoSebelumPath = null;
        if ($request->hasFile('foto_sebelum')) {
            $fotoSebelumPath = $request->file('foto_sebelum')->store('peminjaman', 'public');
        }

        // Tentukan nama kolom ID mobil di database (car_id, mobil_id, atau id_mobil)
        $carColumn = 'car_id';
        if (Schema::hasColumn('peminjaman', 'car_id')) {
            $carColumn = 'car_id';
        } elseif (Schema::hasColumn('peminjaman', 'mobil_id')) {
            $carColumn = 'mobil_id';
        } elseif (Schema::hasColumn('peminjaman', 'id_mobil')) {
            $carColumn = 'id_mobil';
        }

        Peminjaman::create([
            'user_id'         => Auth::id(),
            $carColumn        => $request->car_id,
            'alasan'          => $request->alasan,
            'tanggal_pinjam'  => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'foto_sebelum'    => $fotoSebelumPath,
            'status'          => 'pending',
        ]);

        return redirect()->back()->with('success', 'Pengajuan peminjaman mobil berhasil dikirim!');
    }

    /**
     * 2. User: Upload Foto Kondisi Mobil Sesudah Pemakaian & Selesaikan Peminjaman.
     */
    public function uploadFotoSesudah(Request $request, $id)
    {
        // Cegah error jika diakses via GET request / reload halaman
        if ($request->isMethod('get')) {
            return redirect()->route('ketersediaan.index')->with('info', 'Silakan gunakan tombol "Kembalikan" untuk mengunggah foto.');
        }

        $request->validate([
            'foto_sesudah' => 'required|image|mimes:jpeg,png,jpg|max:4096',
        ]);

        $userId = Auth::id();

        // 1. Cari berdasarkan ID transaksi Peminjaman langsung
        $peminjaman = Peminjaman::find($id);

        // 2. Jika ID tidak cocok dengan ID Peminjaman, cari berdasarkan ID Mobil dan User yang sedang Login
        if (!$peminjaman || $peminjaman->status === 'selesai') {
            $peminjaman = Peminjaman::where(function ($query) use ($id) {
                if (Schema::hasColumn('peminjaman', 'car_id')) {
                    $query->orWhere('car_id', $id);
                }
                if (Schema::hasColumn('peminjaman', 'mobil_id')) {
                    $query->orWhere('mobil_id', $id);
                }
                if (Schema::hasColumn('peminjaman', 'id_mobil')) {
                    $query->orWhere('id_mobil', $id);
                }
            })
            ->where('status', '!=', 'selesai')
            ->when($userId, function ($q) use ($userId) {
                // Filter berdasarkan user yang login jika kolom user_id ada
                if (Schema::hasColumn('peminjaman', 'user_id')) {
                    $q->where('user_id', $userId);
                }
            })
            ->latest()
            ->first();
        }

        // 3. Backup: Cari transaksi aktif mobil tanpa filter user_id jika langkah #2 tidak menemukan data
        if (!$peminjaman) {
            $peminjaman = Peminjaman::where(function ($query) use ($id) {
                if (Schema::hasColumn('peminjaman', 'car_id')) $query->orWhere('car_id', $id);
                if (Schema::hasColumn('peminjaman', 'mobil_id')) $query->orWhere('mobil_id', $id);
                if (Schema::hasColumn('peminjaman', 'id_mobil')) $query->orWhere('id_mobil', $id);
            })
            ->where('status', '!=', 'selesai')
            ->latest()
            ->first();
        }

        if (!$peminjaman) {
            return redirect()->back()->withErrors(['msg' => 'Data peminjaman aktif tidak ditemukan untuk mobil ini!']);
        }

        // Simpan foto sesudah & update status
        if ($request->hasFile('foto_sesudah')) {
            $path = $request->file('foto_sesudah')->store('peminjaman', 'public');
            
            $peminjaman->update([
                'foto_sesudah' => $path,
                'status'       => 'selesai'
            ]);

            // Kembalikan status mobil di tabel cars menjadi 'Tersedia'
            if ($peminjaman->car) {
                $peminjaman->car->update(['status' => 'Tersedia']);
            } else {
                $carId = $peminjaman->car_id ?? $peminjaman->mobil_id ?? $peminjaman->id_mobil ?? $id;
                if ($carId && class_exists('App\Models\Car')) {
                    Car::where('id', $carId)->update(['status' => 'Tersedia']);
                }
            }
        }

        return redirect()->back()->with('success', 'Mobil berhasil dikembalikan dan foto kondisi akhir telah diunggah!');
    }

    /**
     * 3. Admin: Menyetujui atau Menolak Pengajuan Peminjaman.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update(['status' => $request->status]);

        // Jika disetujui admin, ubah status mobil menjadi 'Dipakai'
        if ($request->status === 'disetujui') {
            if ($peminjaman->car) {
                $peminjaman->car->update(['status' => 'Dipakai']);
            } else {
                $carId = $peminjaman->car_id ?? $peminjaman->mobil_id ?? $peminjaman->id_mobil ?? null;
                if ($carId && class_exists('App\Models\Car')) {
                    Car::where('id', $carId)->update(['status' => 'Dipakai']);
                }
            }
        }

        return redirect()->back()->with('success', 'Status pengajuan peminjaman berhasil diperbarui!');
    }

    /**
     * Menampilkan riwayat peminjaman (Alias/Alternatif method).
     */
    public function riwayat()
    {
        $riwayat = Peminjaman::where('user_id', Auth::id())->latest()->get();
        return view('peminjaman.riwayat', compact('riwayat'));
    }
}