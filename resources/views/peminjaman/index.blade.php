@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Persetujuan Peminjaman Mobil</h1>
    <p class="text-sm text-slate-500">Kelola dan tinjau seluruh pengajuan peminjaman mobil dinas dari pegawai.</p>
</div>

{{-- ALERT SUCCESS/ERROR --}}
@if(session('success'))
    <div class="mb-6 p-4 bg-emerald-500 text-white rounded-xl text-xs font-semibold shadow-sm">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead class="bg-slate-800 text-white uppercase font-bold">
                <tr>
                    <th class="p-3.5">Pemohon</th>
                    <th class="p-3.5">Mobil</th>
                    <th class="p-3.5">Alasan</th>
                    <th class="p-3.5">Tgl Pinjam & Kembali</th>
                    <th class="p-3.5">Foto Kondisi</th>
                    <th class="p-3.5 text-center">Aksi / Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($peminjamans as $item)
                <tr class="hover:bg-slate-50 transition">
                    <td class="p-3.5 font-bold text-slate-800">
                        {{ $item->user->name ?? '-' }}
                        <span class="block text-[10px] text-slate-400 font-normal">{{ $item->user->email ?? '' }}</span>
                    </td>
                    <td class="p-3.5 font-semibold text-slate-700">{{ $item->car->nama ?? '-' }}</td>
                    <td class="p-3.5 text-slate-600 max-w-xs leading-relaxed">{{ $item->alasan }}</td>
                    <td class="p-3.5 text-slate-600 whitespace-nowrap">
                        <span class="font-semibold text-slate-700">{{ $item->tanggal_pinjam }}</span> 
                        <span class="text-slate-400">s/d</span> 
                        <span class="font-semibold text-slate-700">{{ $item->tanggal_kembali }}</span>
                    </td>
                    <td class="p-3.5">
                        <div class="flex flex-col gap-1">
                            @if($item->foto_sebelum)
                                <a href="{{ asset('storage/' . $item->foto_sebelum) }}" target="_blank" class="text-blue-600 font-bold hover:underline inline-flex items-center gap-1">
                                    <i class="fa-solid fa-image"></i> Sebelum ↗
                                </a>
                            @endif
                            @if($item->foto_sesudah)
                                <a href="{{ asset('storage/' . $item->foto_sesudah) }}" target="_blank" class="text-emerald-600 font-bold hover:underline inline-flex items-center gap-1">
                                    <i class="fa-solid fa-image"></i> Sesudah ↗
                                </a>
                            @endif
                            @if(!$item->foto_sebelum && !$item->foto_sesudah) 
                                <span class="text-slate-400 italic">Belum ada</span>
                            @endif
                        </div>
                    </td>
                    <td class="p-3.5 text-center">
                        @if($item->status == 'pending')
                            <div class="flex justify-center gap-2">
                                <form action="{{ route('peminjaman.update-status', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="disetujui">
                                    <button class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg font-bold transition shadow-sm">
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('peminjaman.update-status', $item->id) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="status" value="ditolak">
                                    <button class="bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg font-bold transition shadow-sm">
                                        Tolak
                                    </button>
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
                    <td colspan="6" class="p-8 text-center text-slate-400">
                        <i class="fa-solid fa-inbox text-3xl mb-2 text-slate-300"></i>
                        <p>Belum ada pengajuan peminjaman mobil yang masuk.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection