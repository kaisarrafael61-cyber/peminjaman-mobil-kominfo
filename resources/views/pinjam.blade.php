<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Peminjaman Mobil Dinas - Diskominfo Kubar</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex flex-col">

    <nav class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 h-16 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <a href="/dashboard" class="text-gray-600 hover:text-blue-600 transition flex items-center gap-2">
                    <i class="fa-solid fa-arrow-left text-lg"></i>
                    <span class="text-sm font-semibold hidden sm:inline">Kembali</span>
                </a>
                <div class="h-5 w-[1px] bg-gray-300 hidden sm:block"></div>
                <h1 class="text-md font-bold text-gray-800 tracking-wide flex items-center gap-2">
                    <i class="fa-solid fa-car-side text-blue-600"></i>
                    Sistem Peminjaman Mobil Dinas
                </h1>
            </div>
            
            <div class="flex items-center gap-6">
                <a href="/dashboard" class="text-sm font-bold text-blue-600 flex items-center gap-1.5 border-b-2 border-blue-600 pb-5 pt-5">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
                <a href="#" class="text-sm font-medium text-gray-500 hover:text-blue-600 transition flex items-center gap-1.5">
                    <i class="fa-solid fa-bell"></i> Notifikasi
                </a>
                <div class="flex items-center gap-2 border-l border-gray-200 pl-4">
                    <div class="w-8 h-8 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-xs shadow-sm">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <span class="text-xs font-semibold text-gray-700 hidden md:inline">Diskominfo Kubar</span>
                </div>
            </div>
        </div>
    </nav>

    <main class="flex-1 max-w-7xl w-full mx-auto px-6 py-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl p-6 text-white shadow-md relative overflow-hidden">
                <div class="relative z-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-200">Aplikasi Internal</span>
                    <h2 class="text-xl font-black mt-1 leading-tight">Diskominfo<br>Kutai Barat</h2>
                    <p class="text-xs text-blue-100 mt-4 leading-relaxed opacity-90">
                        Pastikan pengajuan dilakukan minimal H-1 sebelum penugasan dinas luar kota dimulai untuk koordinasi kendaraan.
                    </p>
                </div>
                <i class="fa-solid fa-building text-9xl text-white/10 absolute -right-4 -bottom-6 transform -rotate-12"></i>
            </div>

            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-200">
                <h3 class="text-xs font-bold text-gray-800 uppercase tracking-wider mb-4">
                    <i class="fa-solid fa-circle-nodes mr-1 text-blue-500"></i> Tahapan Pengajuan
                </h3>
                <ul class="relative border-l border-gray-200 ml-2.5 space-y-5">
                    <li class="ml-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-600 rounded-full -left-3 font-bold text-xs">1</span>
                        <h4 class="text-xs font-bold text-gray-800">Isi Form Pengajuan</h4>
                        <p class="text-[11px] text-gray-500">Lengkapi data mobil, tanggal, dan keperluan dinas.</p>
                    </li>
                    <li class="ml-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 text-gray-500 rounded-full -left-3 font-bold text-xs">2</span>
                        <h4 class="text-xs font-bold text-gray-700">Validasi Admin & Kabag</h4>
                        <p class="text-[11px] text-gray-400">Pengecekan berkas dan status ketersediaan fisik mobil.</p>
                    </li>
                    <li class="ml-6">
                        <span class="absolute flex items-center justify-center w-6 h-6 bg-gray-100 text-gray-500 rounded-full -left-3 font-bold text-xs">3</span>
                        <h4 class="text-xs font-bold text-gray-700">Pemberian Izin Penugasan</h4>
                        <p class="text-[11px] text-gray-400">Notifikasi persetujuan muncul dan kunci mobil siap diambil.</p>
                    </li>
                </ul>
            </div>
        </div>

        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
    
    <form id="formPeminjaman" action="/pinjam/store" method="POST">
        @csrf
                <div class="border-b border-gray-100 pb-4 mb-6">
                    <h3 class="text-lg font-bold text-gray-800">Formulir Pengajuan Kendaraan</h3>
                    <p class="text-xs text-gray-500">Silakan masukkan informasi penugasan dengan benar</p>
                </div>

                <div id="formPeminjaman" class="space-y-6">
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            <i class="fa-solid fa-car mr-1 text-blue-500"></i> Kendaraan Dinas yang Tersedia
                        </label>
                        <select name="mobil" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition shadow-sm" required>
                            <option value="">-- Pilih Kendaraan --</option>
                            <option value="Mitsubishi Pajero Sport">Mitsubishi Pajero Sport (KT 1234 BZ) - Tersedia</option>
                            <option value="Toyota Avanza Veloz">Toyota Avanza Veloz (KT 5678 AY) - Tersedia</option>
                            <option value="Toyota Innova Zenix">Toyota Innova Zenix (KT 9012 CY) - Tersedia</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                <i class="fa-solid fa-calendar-days mr-1 text-blue-500"></i> Tanggal & Waktu Mulai
                            </label>
                            <input type="datetime-local" name="tanggal_mulai" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                                <i class="fa-solid fa-calendar-check mr-1 text-blue-500"></i> Tanggal & Waktu Kembali
                            </label>
                            <input type="datetime-local" name="tanggal_kembali" class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition shadow-sm" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">
                            <i class="fa-solid fa-map-location-dot mr-1 text-blue-500"></i> Maksud Keperluan & Tujuan Dinas
                        </label>
                        <textarea name="keperluan" rows="4" placeholder="Tuliskan secara detail mengenai agenda rapat kerja, koordinasi dinas, atau penugasan lapangan beserta lokasi tujuannya..." class="w-full bg-gray-50 border border-gray-300 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-blue-500 focus:bg-white transition shadow-sm" required></textarea>
                    </div>

                    <div class="flex justify-end pt-2">
                        <button type="submit" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3.5 rounded-xl shadow-md transition transform active:scale-95 flex items-center justify-center gap-2 text-sm">
                            <i class="fa-solid fa-paper-plane"></i> Kirim Permohonan Pinjaman
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-white border-t border-gray-200 mt-12 py-4 text-center text-xs text-gray-400">
        &copy; 2026 Diskominfo Kutai Barat. All Rights Reserved.
    </footer>

    <script>
    document.getElementById('formPeminjaman').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Mengambil seluruh data inputan form secara otomatis
        let formData = new FormData(this);

        // Mengirimkan data ke backend Laravel Controller
        fetch(this.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Pengajuan Peminjaman Berhasil Dikirim! Menunggu Verifikasi Kabag.');
                window.location.href = '/pesanan'; // Langsung diarahkan ke halaman pesanan anda
            } else {
                alert('Gagal mengirim pengajuan. Silakan periksa kembali inputan Anda.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan jaringan atau database tidak merespon.');
        });
    });
</script>>

</body>
</html>