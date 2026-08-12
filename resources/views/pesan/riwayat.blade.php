@extends('layouts.app')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">Riwayat Pesan & Peminjaman</h1>
    <p class="text-sm text-slate-500">Daftar riwayat pengajuan peminjaman dan pesan Anda.</p>
</div>

<div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse text-xs">
            <thead class="bg-slate-800 text-white uppercase font-bold">
                <tr>
                    <th class="p-3">No</th>
                    <th class="p-3">Tanggal Pengajuan</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayat as $index => $item)
                    <tr class="border-b border-slate-100">
                        <td class="p-3">{{ $index + 1 }}</td>
                        <td class="p-3">{{ $item->created_at ? $item->created_at->format('d M Y') : '-' }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 rounded-md text-xs font-semibold bg-blue-100 text-blue-800">
                                {{ $item->status ?? 'Pending' }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="p-4 text-center text-slate-400">Belum ada riwayat pesan atau pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection