<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Peminjaman - Kabag</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased">

    <div class="flex h-screen overflow-hidden">
        
        <div class="flex-1 flex flex-col overflow-y-auto p-8">
            
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Halaman Persetujuan Kabag</h1>
                    <p class="text-sm text-gray-500">Kelola dan verifikasi berkas permohonan kendaraan dinas pegawai.</p>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-4 p-4 text-sm text-emerald-700 bg-emerald-50 rounded-xl border border-emerald-200 flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 text-sm text-rose-700 bg-rose-50 rounded-xl border border-rose-200 flex items-center gap-2">
                    <i class="fa-solid fa-circle-xmark"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 border-b border-gray-200 text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th class="px-6 py-4">Mobil</th>
                                <th class="px-6 py-4">Keperluan</th>
                                <th class="px-6 py-4">Waktu Peminjaman</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 text-sm">
                            @forelse($peminjaman as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $item->mobil }}
                                    </td>
                                    
                                    <td class="px-6 py-4 text-gray-600 max-w-xs truncate">
                                        {{ $item->keperluan }}
                                    </td>
                                    
                                    <td class="px-6 py-4 text-gray-500 text-xs leading-relaxed">
                                        <div><span class="font-medium text-gray-700">Mulai:</span> {{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d M Y') }}</div>
                                        <div><span class="font-medium text-gray-700">Kembali:</span> {{ \Carbon\Carbon::parse($item->tanggal_kembali)->format('d M Y') }}</div>
                                    </td>
                                    
                                    <td class="px-6 py-4">
                                        @if($item->status == 'Menunggu Persetujuan')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-amber-50 text-amber-700 border border-amber-200">
                                                Menunggu Verifikasi
                                            </span>
                                        @elseif($item->status == 'Disetujui')
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                Disetujui Kabag
                                            </span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-rose-50 text-rose-700 border border-rose-200">
                                                Ditolak
                                            </span>
                                        @endif
                                    </td>
                                    
                                    <td class="px-6 py-4 text-center space-x-2">
                                        @if($item->status == 'Menunggu Persetujuan')
                                            <form action="{{ route('kabag.status', [$item->id, 'Disetujui']) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium inline-flex items-center gap-1 shadow-sm transition-all cursor-pointer">
                                                    <i class="fa-solid fa-check"></i> Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('kabag.status', [$item->id, 'Ditolak']) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-rose-600 hover:bg-rose-700 text-white px-3 py-1.5 rounded-lg text-xs font-medium inline-flex items-center gap-1 shadow-sm transition-all cursor-pointer">
                                                    <i class="fa-solid fa-xmark"></i> Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-gray-400 italic">Selesai diproses</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                        <div class="text-3xl mb-2"><i class="fa-solid fa-folder-open"></i></div>
                                        <p class="text-sm">Belum ada pengajuan peminjaman mobil masuk.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

</body>
</html>