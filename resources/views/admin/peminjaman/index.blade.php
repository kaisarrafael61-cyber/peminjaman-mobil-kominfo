<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Persetujuan Peminjaman - Admin MOBI-KUBAR</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f1f5f9; }
    </style>
</head>
<body class="text-slate-800 antialiased min-h-screen flex flex-col">

    <header class="bg-gradient-to-r from-[#1b4cc7] via-[#2563eb] to-[#1e40af] text-white px-8 py-5 flex justify-between items-center shadow-lg">
        <div class="flex items-center gap-4">
            <a href="{{ url('/dashboard') }}" class="p-2 bg-[#05152b] hover:bg-[#0a1d37] rounded-xl text-cyan-400 transition">
                <i class="fa-solid fa-arrow-left text-lg"></i>
            </a>
            <div>
                <h1 class="font-black text-lg tracking-wide">PANEL PERSETUJUAN PEMINJAMAN</h1>
                <p class="text-[10px] text-amber-300 font-bold uppercase tracking-widest">Diskominfo Kutai Barat</p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <span class="bg-amber-400/20 text-amber-300 border border-amber-400/30 text-xs font-bold px-3 py-1 rounded-full uppercase">
                <i class="fa-solid fa-user-shield mr-1"></i> {{ Auth::user()->name ?? 'Admin' }}
            </span>
        </div>
    </header>

    <main class="flex-1 p-8 max-w-7xl mx-auto w-full space-y-6">

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-5 py-4 rounded-2xl text-sm flex items-center gap-3 shadow-sm">
                <i class="fa-solid fa-circle-check text-emerald-600 text-lg"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-5 py-4 rounded-2xl text-sm flex items-center gap-3 shadow-sm">
                <i class="fa-solid fa-circle-xmark text-red-600 text-lg"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <div class="bg-white rounded-3xl p-6 shadow-md border border-slate-200/80">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-lg font-black text-slate-900">Daftar Permohonan Peminjaman</h2>
                    <p class="text-xs text-slate-500 font-medium mt-0.5">Kelola status permohonan peminjaman kendaraan dinas pegawai.</p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm border-collapse">
                    <thead>
                        <tr class="border-b border-slate-200 text-xs text-slate-400 uppercase tracking-wider font-bold">
                            <th class="py-3 px-4">No</th>
                            <th class="py-3 px-4">Pemohon</th>
                            <th class="py-3 px-4">Mobil</th>
                            <th class="py-3 px-4">Tanggal Pinjam</th>
                            <th class="py-3 px-4">Dokumentasi Mobil</th>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 font-medium">
                        @forelse($peminjamans as $index => $item)
                            @php
                                // Penanganan akses aman baik untuk Array maupun Objek Eloquent/stdClass
                                $itemId = is_array($item) ? ($item['id'] ?? null) : ($item->id ?? null);
                                $status = is_array($item) ? ($item['status'] ?? 'pending') : ($item->status ?? 'pending');
                                
                                $userName = is_array($item) ? ($item['user']['name'] ?? $item['pegawai']['nama'] ?? 'Pegawai') : ($item->user->name ?? $item->pegawai->nama ?? 'Pegawai');
                                $userEmail = is_array($item) ? ($item['user']['email'] ?? $item['pegawai']['email'] ?? '-') : ($item->user->email ?? $item->pegawai->email ?? '-');
                                $keperluan = is_array($item) ? ($item['keperluan'] ?? null) : ($item->keperluan ?? null);
                                
                                $carName = is_array($item) ? ($item['car']['nama'] ?? $item['car']['name'] ?? 'Mobil') : ($item->car->nama ?? $item->car->name ?? 'Mobil');
                                $platNomor = is_array($item) ? ($item['car']['plat_nomor'] ?? $item['car']['plat_number'] ?? '') : ($item->car->plat_nomor ?? $item->car->plat_number ?? '');
                                
                                $tglPinjam = is_array($item) ? ($item['tanggal_pinjam'] ?? $item['start_date'] ?? $item['created_at'] ?? now()) : ($item->tanggal_pinjam ?? $item->start_date ?? $item->created_at ?? now());
                                $tglKembali = is_array($item) ? ($item['tanggal_kembali'] ?? $item['end_date'] ?? $item['created_at'] ?? now()) : ($item->tanggal_kembali ?? $item->end_date ?? $item->created_at ?? now());
                                
                                $fotoSebelum = is_array($item) ? ($item['foto_sebelum'] ?? null) : ($item->foto_sebelum ?? null);
                                $fotoSesudah = is_array($item) ? ($item['foto_sesudah'] ?? null) : ($item->foto_sesudah ?? null);
                            @endphp
                            <tr class="hover:bg-slate-50 transition">
                                <td class="py-4 px-4 font-bold text-slate-500">{{ $index + 1 }}</td>
                                <td class="py-4 px-4">
                                    <div class="font-bold text-slate-800">{{ $userName }}</div>
                                    <div class="text-[11px] text-slate-400">{{ $userEmail }}</div>
                                    @if($keperluan)
                                        <div class="text-[11px] text-slate-500 italic mt-1">"{{ $keperluan }}"</div>
                                    @endif
                                </td>
                                <td class="py-4 px-4">
                                    <span class="font-bold text-blue-600">{{ $carName }}</span>
                                    <div class="text-[11px] text-slate-400">{{ $platNomor }}</div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="text-xs font-semibold text-slate-700">
                                        {{ \Carbon\Carbon::parse($tglPinjam)->format('d M Y') }}
                                        - 
                                        {{ \Carbon\Carbon::parse($tglKembali)->format('d M Y') }}
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <div class="flex items-center gap-2">
                                        {{-- Foto Sebelum --}}
                                        @if(!empty($fotoSebelum))
                                            <button type="button" onclick="openImageModal('{{ asset('storage/' . $fotoSebelum) }}', 'Foto Kondisi Awal')" class="group relative cursor-pointer">
                                                <img src="{{ asset('storage/' . $fotoSebelum) }}" alt="Awal" class="w-10 h-10 object-cover rounded-xl border border-slate-200 shadow-sm group-hover:scale-105 transition">
                                                <span class="absolute -bottom-1 -right-1 bg-blue-600 text-white text-[9px] px-1 rounded font-bold">Awal</span>
                                            </button>
                                        @else
                                            <span class="text-[11px] text-slate-400 italic">Awal: -</span>
                                        @endif

                                        {{-- Foto Sesudah --}}
                                        @if(!empty($fotoSesudah))
                                            <button type="button" onclick="openImageModal('{{ asset('storage/' . $fotoSesudah) }}', 'Foto Kondisi Akhir')" class="group relative cursor-pointer">
                                                <img src="{{ asset('storage/' . $fotoSesudah) }}" alt="Akhir" class="w-10 h-10 object-cover rounded-xl border border-slate-200 shadow-sm group-hover:scale-105 transition">
                                                <span class="absolute -bottom-1 -right-1 bg-emerald-600 text-white text-[9px] px-1 rounded font-bold">Akhir</span>
                                            </button>
                                        @else
                                            <span class="text-[11px] text-slate-400 italic">Akhir: -</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    @if(in_array(strtolower($status), ['approved', 'disetujui']))
                                        <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-3 py-1 rounded-full inline-block">
                                            <i class="fa-solid fa-check mr-1"></i> Disetujui
                                        </span>
                                    @elseif(in_array(strtolower($status), ['rejected', 'ditolak']))
                                        <span class="bg-red-100 text-red-700 text-xs font-bold px-3 py-1 rounded-full inline-block">
                                            <i class="fa-solid fa-xmark mr-1"></i> Ditolak
                                        </span>
                                    @elseif(strtolower($status) == 'selesai')
                                        <span class="bg-blue-100 text-blue-700 text-xs font-bold px-3 py-1 rounded-full inline-block">
                                            <i class="fa-solid fa-flag-checkered mr-1"></i> Selesai
                                        </span>
                                    @else
                                        <span class="bg-amber-100 text-amber-700 text-xs font-bold px-3 py-1 rounded-full inline-block">
                                            <i class="fa-solid fa-clock mr-1"></i> Menunggu
                                        </span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        @if(in_array(strtolower($status), ['pending', 'menunggu']))
                                            <form action="{{ route('peminjaman.update-status', $itemId) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="disetujui">
                                                <button type="submit" onclick="return confirm('Setujui peminjaman ini?')" class="bg-emerald-600 hover:bg-emerald-700 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1 shadow-sm cursor-pointer">
                                                    <i class="fa-solid fa-check"></i> Setujui
                                                </button>
                                            </form>

                                            <form action="{{ route('peminjaman.update-status', $itemId) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="status" value="ditolak">
                                                <button type="submit" onclick="return confirm('Tolak peminjaman ini?')" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 rounded-xl text-xs font-bold transition flex items-center gap-1 shadow-sm cursor-pointer">
                                                    <i class="fa-solid fa-xmark"></i> Tolak
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400 font-semibold italic">Sudah diproses</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="py-12 text-center text-slate-400 font-medium">
                                    <i class="fa-solid fa-inbox text-3xl mb-2 block"></i>
                                    Belum ada data permohonan peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </main>

    <div id="imageModal" class="fixed inset-0 bg-slate-900/70 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-4 rounded-3xl max-w-lg w-full shadow-2xl relative">
            <div class="flex justify-between items-center mb-3 px-2">
                <h3 id="imageModalTitle" class="text-sm font-bold text-slate-800">Pratinjau Foto</h3>
                <button type="button" onclick="closeImageModal()" class="text-slate-400 hover:text-slate-600 p-1 cursor-pointer">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
            <img id="imageModalSrc" src="" alt="Preview" class="w-full max-h-[70vh] object-contain rounded-2xl bg-slate-100 border border-slate-200">
        </div>
    </div>

    <footer class="py-4 text-center text-xs text-slate-400 border-t border-slate-200 bg-white font-medium mt-auto">
        &copy; {{ date('Y') }} Diskominfo Kutai Barat. All Rights Reserved.
    </footer>

    <script>
        function openImageModal(src, title) {
            document.getElementById('imageModalSrc').src = src;
            document.getElementById('imageModalTitle').innerText = title;
            document.getElementById('imageModal').classList.remove('hidden');
            document.getElementById('imageModal').classList.add('flex');
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.getElementById('imageModal').classList.remove('flex');
        }
    </script>

</body>
</html>