<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pesanan Anda - Diskominfo Kubar</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen">

    <div class="max-w-4xl mx-auto p-4 md:p-8">
        <div class="flex items-center gap-4 mb-6">
            <a href="/dashboard" class="w-10 h-10 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-700 hover:text-blue-600 shadow-sm transition">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-xl font-black text-gray-800">Status Pesanan Anda</h1>
                <p class="text-xs text-gray-500">Pantau proses verifikasi berkas permohonan kendaraan dinas</p>
            </div>
        </div>

        @if($pesanan->isEmpty())
            <div class="bg-white rounded-2xl p-8 text-center border border-gray-200 shadow-sm">
                <div class="w-16 h-16 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h3 class="text-sm font-bold text-gray-700">Belum Ada Riwayat Pengajuan</h3>
                <p class="text-xs text-gray-400 mt-1">Silakan mengisi formulir pinjam mobil terlebih dahulu.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($pesanan as $item)
                    <div class="bg-white border border-gray-200 rounded-2xl p-5 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
                        <div class="space-y-2">
                            <div class="flex items-center gap-2">
                                <span class="text-xs bg-blue-50 text-blue-700 border border-blue-100 px-2.5 py-1 rounded-lg font-bold">
                                    <i class="fa-solid fa-car mr-1"></i> {{ $item->mobil }}
                                </span>
                                
                                @if($item->status == 'Menunggu Persetujuan')
                                    <span class="text-[11px] bg-amber-50 text-amber-700 border border-amber-200 px-2.5 py-1 rounded-lg font-bold">
                                        <i class="fa-solid fa-hourglass-half mr-1"></i> Menunggu Kabag
                                    </span>
                                @elseif($item->status == 'Disetujui')
                                    <span class="text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-200 px-2.5 py-1 rounded-lg font-bold">
                                        <i class="fa-solid fa-circle-check mr-1"></i> Disetujui
                                    </span>
                                @else
                                    <span class="text-[11px] bg-red-50 text-red-700 border border-red-200 px-2.5 py-1 rounded-lg font-bold">
                                        <i class="fa-solid fa-circle-xmark mr-1"></i> Ditolak
                                    </span>
                                @endif
                            </div>
                            
                            <p class="text-xs font-bold text-gray-800">{{ $item->keperluan }}</p>
                            
                            <div class="text-[11px] text-gray-400 flex flex-wrap gap-x-4 gap-y-1 pt-1">
                                <span><i class="fa-solid fa-calendar text-gray-300 mr-1"></i> Mulai: {{ date('d M Y H:i', strtotime($item->tanggal_mulai)) }}</span>
                                <span><i class="fa-solid fa-calendar-check text-gray-300 mr-1"></i> Kembali: {{ date('d M Y H:i', strtotime($item->tanggal_kembali)) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</body>
</html>