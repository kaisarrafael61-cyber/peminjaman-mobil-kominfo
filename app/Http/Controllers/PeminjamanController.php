<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // Menampilkan daftar pesanan pegawai
    public function index()
    {
        $pesanan = Peminjaman::orderBy('created_at', 'desc')->get();
        return view('pesanan', compact('pesanan'));
    }

    // Menyimpan permohonan baru dari form
    public function store(Request $request)
    {
        $request->validate([
            'mobil' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_mulai',
            'keperluan' => 'required|string',
        ]);

        Peminjaman::create([
            'mobil' => $request->mobil,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_kembali' => $request->tanggal_kembali,
            'keperluan' => $request->keperluan,
            'status' => 'Menunggu Persetujuan'
        ]);

        return response()->json(['success' => true, 'message' => 'Permohonan berhasil disimpan!']);
    }

    // Menampilkan daftar persetujuan di halaman Kabag
    public function kabagIndex()
    {
        $peminjaman = Peminjaman::orderBy('created_at', 'desc')->get();
        return view('kabag.persetujuan', compact('peminjaman'));
    }

    // Memproses perubahan status (Disetujui / Ditolak) oleh Kabag
    public function kabagUpdateStatus($id, $status)
    {
        $item = Peminjaman::findOrFail($id);

        if (in_array($status, ['Disetujui', 'Ditolak'])) {
            $item->update([
                'status' => $status
            ]);

            return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui status.');
    }
}