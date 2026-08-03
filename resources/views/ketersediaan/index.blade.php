@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Ketersediaan Mobil Dinas</h1>
    <p class="text-sm text-slate-500">Cek status armada mobil dinas yang siap digunakan untuk operasional.</p>
</div>

{{-- 1. NOTIFIKASI OTOMATIS HARI TERAKHIR PENGEMBALIAN --}}
@php
    $notifPengembalian = null;
    try {
        if (\Illuminate\Support\Facades\Auth::check()) {
            $userId = \Illuminate\Support\Facades\Auth::id();
            $pegawaiId = \Illuminate\Support\Facades\Auth::user()->pegawai_id ?? $userId;

            $notifPengembalian = \Illuminate\Support\Facades\DB::table('peminjaman')
                ->where(function($query) use ($userId, $pegawaiId) {
                    if (\Illuminate\Support\Facades\Schema::hasColumn('peminjaman', 'pegawai_id')) {
                        $query->where('pegawai_id', $pegawaiId);
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('peminjaman', 'user_id')) {
                        $query->orWhere('user_id', $userId);
                    }
                    if (\Illuminate\Support\Facades\Schema::hasColumn('peminjaman', 'id_user')) {
                        $query->orWhere('id_user', $userId);
                    }
                })
                ->whereIn('status', ['disetujui', 'approved'])
                ->whereDate('tanggal_kembali', \Carbon\Carbon::today())
                ->first();
        }
    } catch (\Throwable $e) {
        $notifPengembalian = null;
    }
@endphp

@if($notifPengembalian)
    <div class="mb-6 p-4 bg-amber-500 text-white rounded-xl shadow-md flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <div>
                <h4 class="font-bold text-sm">Pemberitahuan Pengembalian Mobil!</h4>
                <p class="text-xs mt-1 md:mt-0">Hari ini adalah hari terakhir peminjaman unit mobil. Harap segera upload foto kondisi akhir kendaraan.</p>
            </div>
        </div>
        <button onclick="openModalKembalikan('{{ $notifPengembalian->id }}', 'Mobil Dinas')" class="w-full md:w-auto bg-white text-amber-700 px-4 py-2 rounded-lg text-xs font-bold hover:bg-amber-100 transition shadow whitespace-nowrap">
            Upload Foto Sesudah
        </button>
    </div>
@endif

{{-- ALERT SUCCESS/ERROR --}}
@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-500 text-white rounded-xl text-xs font-semibold shadow-sm">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 p-4 bg-rose-500 text-white rounded-xl text-xs font-semibold shadow-sm">
        {{ session('error') }}
    </div>
@endif

@if($errors->any())
    <div class="mb-6 p-4 bg-rose-500 text-white rounded-xl text-xs font-semibold shadow-sm">
        <ul class="list-disc pl-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8">
    <div class="bg-white p-5 rounded-xl border border-slate-100 shadow-sm flex items-center justify-between">
        <div>
            <p class="text-xs text-slate-500 font-semibold uppercase">Total Armada</p>
            <p class="text-2xl font-bold text-slate-800 mt-1">{{ count($cars ?? []) }} Unit</p>
        </div>
        <div class="p-3 bg-blue-50 text-blue-600 rounded-lg">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path></svg>
        </div>
    </div>
</div>

{{-- TABEL KETERSEDIAAN MOBIL --}}
<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
    
    {{-- VERSI DESKTOP (Tampil di layar besar) --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead class="bg-slate-800 text-white">
                <tr>
                    <th class="p-4 font-semibold whitespace-nowrap">Nama Mobil</th>
                    <th class="p-4 font-semibold whitespace-nowrap">Plat Nomor</th>
                    <th class="p-4 font-semibold whitespace-nowrap">Kapasitas</th>
                    <th class="p-4 font-semibold whitespace-nowrap">Status</th>
                    <th class="p-4 font-semibold whitespace-nowrap">Pengemudi / Sopir</th>
                    <th class="p-4 font-semibold whitespace-nowrap">Bahan Bakar</th>
                    <th class="p-4 font-semibold text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($cars as $item)
                @php 
                    $car = (object) $item; 
                    $carId = $car->id ?? $car->car_id ?? $car->id_mobil ?? 0;
                    $carStatus = 'Tersedia'; // HACK STATUS TERSEDIA
                @endphp
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-4 font-bold text-slate-800 whitespace-nowrap">{{ $car->nama ?? $car->name ?? '-' }}</td>
                    <td class="p-4 text-slate-600 font-mono whitespace-nowrap">{{ $car->plat ?? $car->plat_number ?? $car->plat_nomor ?? '-' }}</td>
                    <td class="p-4 text-slate-600 whitespace-nowrap">{{ $car->kapasitas ?? '-' }}</td>
                    <td class="p-4 whitespace-nowrap">
                        @if(in_array(strtolower($carStatus), ['tersedia', 'available']))
                            <span class="px-3 py-1 bg-emerald-100 text-emerald-700 font-semibold rounded-full text-xs">Tersedia</span>
                        @else
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 font-semibold rounded-full text-xs">{{ $carStatus }}</span>
                        @endif
                    </td>
                    <td class="p-4 text-slate-700 font-medium whitespace-nowrap">{{ $car->driver ?? $car->sopir ?? '-' }}</td>
                    <td class="p-4 text-slate-600 whitespace-nowrap">{{ $car->bahan_bakar ?? '-' }}</td>
                    <td class="p-4 text-center whitespace-nowrap">
                        @if(in_array(strtolower($carStatus), ['tersedia', 'available']))
                            <button type="button" onclick="openModalPinjam('{{ $carId }}', '{{ $car->nama ?? $car->name ?? '' }}')" class="px-3 py-1.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-xs transition shadow-sm">Pinjam</button>
                        @else
                            <button type="button" onclick="openModalKembalikan('{{ $carId }}', '{{ $car->nama ?? $car->name ?? '' }}')" class="px-3 py-1.5 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-lg text-xs transition shadow-sm">Kembalikan</button>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-6 text-center text-slate-400">Belum ada data mobil dinas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- VERSI MOBILE (Tampil di HP sebagai Card) --}}
    <div class="md:hidden divide-y divide-slate-100 bg-slate-50">
        @forelse($cars as $item)
        @php 
            $car = (object) $item; 
            $carId = $car->id ?? $car->car_id ?? $car->id_mobil ?? 0;
            $carStatus = 'Tersedia'; // HACK STATUS TERSEDIA
        @endphp
        <div class="p-4 bg-white m-4 rounded-xl shadow-sm border border-slate-200">
            <div class="flex justify-between items-start mb-3">
                <div>
                    <h4 class="font-bold text-slate-800 text-base">{{ $car->nama ?? $car->name ?? '-' }}</h4>
                    <p class="text-sm text-slate-500 font-mono mt-1">{{ $car->plat ?? $car->plat_number ?? $car->plat_nomor ?? '-' }}</p>
                </div>
                <div>
                    @if(in_array(strtolower($carStatus), ['tersedia', 'available']))
                        <span class="px-3 py-1 bg-emerald-100 text-emerald-700 font-bold rounded-full text-[10px] uppercase tracking-wider">Tersedia</span>
                    @else
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 font-bold rounded-full text-[10px] uppercase tracking-wider">{{ $carStatus }}</span>
                    @endif
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-y-2 gap-x-4 mb-4 text-xs bg-slate-50 p-3 rounded-lg">
                <div><span class="text-slate-400 block mb-0.5">Kapasitas</span><span class="font-semibold text-slate-700">{{ $car->kapasitas ?? '-' }}</span></div>
                <div><span class="text-slate-400 block mb-0.5">Bahan Bakar</span><span class="font-semibold text-slate-700">{{ $car->bahan_bakar ?? '-' }}</span></div>
                <div class="col-span-2 mt-1"><span class="text-slate-400 block mb-0.5">Sopir / Pengemudi</span><span class="font-semibold text-slate-700">{{ $car->driver ?? $car->sopir ?? '-' }}</span></div>
            </div>

            <div class="pt-2">
                @if(in_array(strtolower($carStatus), ['tersedia', 'available']))
                    <button type="button" onclick="openModalPinjam('{{ $carId }}', '{{ $car->nama ?? $car->name ?? '' }}')" class="w-full py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-lg text-sm transition shadow-sm">Pinjam Mobil</button>
                @else
                    <button type="button" onclick="openModalKembalikan('{{ $carId }}', '{{ $car->nama ?? $car->name ?? '' }}')" class="w-full py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-lg text-sm transition shadow-sm">Kembalikan Mobil</button>
                @endif
            </div>
        </div>
        @empty
        <div class="p-6 text-center text-slate-400 text-sm">Belum ada data mobil dinas.</div>
        @endforelse
    </div>
</div>

{{-- 2. PANEL PERSETUJUAN ADMIN --}}
@if(\Illuminate\Support\Facades\Auth::check() && (\Illuminate\Support\Facades\Auth::user()->role === 'admin' || \Illuminate\Support\Facades\Auth::user()->is_admin))
<div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-slate-200">
    <h3 class="text-base font-bold text-slate-800 mb-4">Persetujuan Peminjaman Mobil (Admin)</h3>
    @php
        $peminjamans = [];
        try {
            $peminjamans = \App\Models\Peminjaman::with(['car'])->orderBy('id', 'desc')->get();
        } catch (\Throwable $e) {
            $peminjamans = [];
        }
    @endphp
    
    {{-- VERSI DESKTOP ADMIN --}}
    <div class="hidden md:block overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead class="bg-slate-100 text-slate-600 uppercase font-bold">
                <tr>
                    <th class="p-3 whitespace-nowrap">Pemohon</th>
                    <th class="p-3 whitespace-nowrap">Mobil</th>
                    <th class="p-3 min-w-[200px]">Alasan</th>
                    <th class="p-3 whitespace-nowrap">Tgl Pinjam & Kembali</th>
                    <th class="p-3 whitespace-nowrap">Foto Kondisi</th>
                    <th class="p-3 text-center whitespace-nowrap">Aksi / Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($peminjamans as $item)
                <tr>
                    <td class="p-3 font-bold text-slate-800 whitespace-nowrap">{{ $item->user->name ?? $item->pegawai->nama ?? '-' }}</td>
                    <td class="p-3 whitespace-nowrap">{{ $item->car->nama ?? $item->car->name ?? '-' }}</td>
                    <td class="p-3">{{ $item->alasan ?? $item->keperluan ?? '-' }}</td>
                    <td class="p-3 whitespace-nowrap">{{ $item->tanggal_pinjam }} <br><span class="text-slate-400">s/d</span><br> {{ $item->tanggal_kembali }}</td>
                    <td class="p-3 whitespace-nowrap">
                        <div class="flex flex-col gap-2">
                            @if($item->foto_sebelum)
                                <a href="{{ asset('storage/' . $item->foto_sebelum) }}" target="_blank" class="text-blue-600 font-semibold hover:underline inline-flex items-center gap-1">Sebelum <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></a>
                            @endif
                            @if($item->foto_sesudah)
                                <a href="{{ asset('storage/' . $item->foto_sesudah) }}" target="_blank" class="text-emerald-600 font-semibold hover:underline inline-flex items-center gap-1">Sesudah <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg></a>
                            @endif
                            @if(!$item->foto_sebelum && !$item->foto_sesudah) <span class="text-slate-400">-</span> @endif
                        </div>
                    </td>
                    <td class="p-3 text-center whitespace-nowrap">
                        @if($item->status == 'pending')
                            <div class="flex justify-center gap-2">
                                <form action="{{ route('peminjaman.update-status', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="disetujui">
                                    <button class="bg-emerald-500 text-white px-3 py-1.5 rounded-lg font-bold hover:bg-emerald-600 shadow-sm">Setujui</button>
                                </form>
                                <form action="{{ route('peminjaman.update-status', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="ditolak">
                                    <button class="bg-rose-500 text-white px-3 py-1.5 rounded-lg font-bold hover:bg-rose-600 shadow-sm">Tolak</button>
                                </form>
                            </div>
                        @else
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider {{ $item->status == 'disetujui' ? 'bg-emerald-100 text-emerald-700' : ($item->status == 'selesai' ? 'bg-blue-100 text-blue-700' : 'bg-rose-100 text-rose-700') }}">
                                {{ $item->status }}
                            </span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="p-4 text-center text-slate-400">Belum ada riwayat pengajuan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- VERSI MOBILE ADMIN (Tampil bentuk list/card) --}}
    <div class="md:hidden flex flex-col gap-4 mt-2">
        @forelse($peminjamans as $item)
        <div class="border border-slate-200 rounded-xl p-4 shadow-sm bg-slate-50">
            <div class="flex justify-between items-center mb-3 border-b border-slate-200 pb-2">
                <span class="font-bold text-slate-800 text-sm">{{ $item->user->name ?? $item->pegawai->nama ?? '-' }}</span>
                @if($item->status != 'pending')
                    <span class="px-2 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider {{ $item->status == 'disetujui' ? 'bg-emerald-100 text-emerald-700' : ($item->status == 'selesai' ? 'bg-blue-100 text-blue-700' : 'bg-rose-100 text-rose-700') }}">
                        {{ $item->status }}
                    </span>
                @endif
            </div>
            
            <div class="text-xs text-slate-600 space-y-2 mb-4">
                <p><span class="font-semibold block text-slate-500">Mobil:</span> {{ $item->car->nama ?? $item->car->name ?? '-' }}</p>
                <p><span class="font-semibold block text-slate-500">Tanggal:</span> {{ $item->tanggal_pinjam }} s/d {{ $item->tanggal_kembali }}</p>
                <p><span class="font-semibold block text-slate-500">Alasan:</span> {{ $item->alasan ?? $item->keperluan ?? '-' }}</p>
                
                <div class="pt-2">
                    <span class="font-semibold block text-slate-500 mb-1">Foto Kondisi:</span>
                    <div class="flex gap-4">
                        @if($item->foto_sebelum)
                            <a href="{{ asset('storage/' . $item->foto_sebelum) }}" target="_blank" class="text-blue-600 font-semibold hover:underline">Sebelum ↗</a>
                        @endif
                        @if($item->foto_sesudah)
                            <a href="{{ asset('storage/' . $item->foto_sesudah) }}" target="_blank" class="text-emerald-600 font-semibold hover:underline">Sesudah ↗</a>
                        @endif
                        @if(!$item->foto_sebelum && !$item->foto_sesudah) <span class="text-slate-400">Tidak ada foto</span> @endif
                    </div>
                </div>
            </div>

            @if($item->status == 'pending')
                <div class="flex gap-2 pt-3 border-t border-slate-200">
                    <form action="{{ route('peminjaman.update-status', $item->id) }}" method="POST" class="w-1/2">
                        @csrf
                        <input type="hidden" name="status" value="disetujui">
                        <button class="w-full bg-emerald-500 text-white py-2 rounded-lg font-bold text-xs shadow-sm hover:bg-emerald-600">Setujui</button>
                    </form>
                    <form action="{{ route('peminjaman.update-status', $item->id) }}" method="POST" class="w-1/2">
                        @csrf
                        <input type="hidden" name="status" value="ditolak">
                        <button class="w-full bg-rose-500 text-white py-2 rounded-lg font-bold text-xs shadow-sm hover:bg-rose-600">Tolak</button>
                    </form>
                </div>
            @endif
        </div>
        @empty
        <div class="p-4 text-center text-slate-400 text-sm border border-dashed border-slate-300 rounded-xl">Belum ada riwayat pengajuan.</div>
        @endforelse
    </div>
</div>
@endif

{{-- MODAL FORM PEMINJAMAN --}}
<div id="modal-pinjam" class="fixed inset-0 bg-slate-900/50 hidden flex items-center justify-center z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-xl max-w-md w-full p-5 md:p-6 shadow-2xl my-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-base font-bold text-slate-800">Form Peminjaman</h3>
            <button type="button" onclick="document.getElementById('modal-pinjam').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 font-bold bg-slate-100 rounded-full w-8 h-8 flex items-center justify-center">✕</button>
        </div>

        <form action="{{ route('peminjaman.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs md:text-sm">
            @csrf
            <input type="hidden" name="car_id" id="modal_car_id">

            <div>
                <label class="block font-bold text-slate-700 mb-1">Mobil yang Dipinjam</label>
                <input type="text" id="modal_car_name" readonly class="w-full p-2.5 md:p-3 bg-slate-100 rounded-lg border border-slate-200 text-slate-600 font-semibold focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Alasan Peminjaman</label>
                <textarea name="alasan" required rows="3" class="w-full p-2.5 md:p-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500" placeholder="Tuliskan tujuan keperluan..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" required class="w-full p-2.5 md:p-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                </div>
                <div>
                    <label class="block font-bold text-slate-700 mb-1">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" required class="w-full p-2.5 md:p-3 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500">
                </div>
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Foto Kondisi Sebelum Dipakai</label>
                <input type="file" name="foto_sebelum" accept="image/*" class="w-full text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 border border-slate-200 rounded-lg p-1.5">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition shadow-md mt-4 text-sm">
                Kirim Pengajuan
            </button>
        </form>
    </div>
</div>

{{-- MODAL UPLOAD FOTO SESUDAH / KEMBALIKAN MOBIL --}}
<div id="modal-upload-sesudah" class="fixed inset-0 bg-slate-900/50 hidden flex items-center justify-center z-50 p-4 overflow-y-auto">
    <div class="bg-white rounded-xl max-w-md w-full p-5 md:p-6 shadow-2xl my-auto">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-base font-bold text-slate-800">Pengembalian Mobil</h3>
            <button type="button" onclick="document.getElementById('modal-upload-sesudah').classList.add('hidden')" class="text-slate-400 hover:text-slate-600 font-bold bg-slate-100 rounded-full w-8 h-8 flex items-center justify-center">✕</button>
        </div>

        <form id="form-upload-sesudah" action="" method="POST" enctype="multipart/form-data" class="space-y-4 text-xs md:text-sm">
            @csrf
            <div>
                <label class="block font-bold text-slate-700 mb-1">Mobil yang Dikembalikan</label>
                <input type="text" id="modal_return_car_name" readonly value="Mobil Dinas" class="w-full p-2.5 md:p-3 bg-slate-100 rounded-lg border border-slate-200 text-slate-600 font-semibold focus:outline-none">
            </div>

            <div>
                <label class="block font-bold text-slate-700 mb-1">Foto Kondisi (Sesudah Pemakaian)</label>
                <input type="file" name="foto_sesudah" required accept="image/*" class="w-full text-slate-500 file:mr-3 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-slate-200 rounded-lg p-1.5">
            </div>

            <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-3 rounded-lg transition shadow-md mt-4 text-sm">
                Selesaikan Peminjaman
            </button>
        </form>
    </div>
</div>

<script>
    function openModalPinjam(carId, carName) {
        document.getElementById('modal_car_id').value = carId;
        document.getElementById('modal_car_name').value = carName;
        document.getElementById('modal-pinjam').classList.remove('hidden');
    }

    function openModalKembalikan(peminjamanOrCarId, carName) {
        const returnInput = document.getElementById('modal_return_car_name');
        if (returnInput && carName) {
            returnInput.value = carName;
        }

        const formSesudah = document.getElementById('form-upload-sesudah');
        if (formSesudah && peminjamanOrCarId) {
            formSesudah.action = "/peminjaman/" + peminjamanOrCarId + "/foto-sesudah";
        }

        document.getElementById('modal-upload-sesudah').classList.remove('hidden');
    }
</script>
@endsection