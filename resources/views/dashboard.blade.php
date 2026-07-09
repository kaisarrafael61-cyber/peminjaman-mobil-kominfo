<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Mobil Diskominfo Kubar</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex">

    <aside class="w-64 bg-slate-900 text-slate-300 min-h-screen flex flex-col justify-between hidden md:flex shadow-xl shrink-0">
        <div>
            <div class="p-6 border-b border-slate-800 flex items-center gap-3">
                <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center text-white text-lg shadow-md">
                    <i class="fa-solid fa-car-side"></i>
                </div>
                <div>
                    <h2 class="text-sm font-black text-white uppercase tracking-wider">Mobi-Kubar</h2>
                    <p class="text-[10px] text-slate-500 font-medium">Diskominfo App</p>
                </div>
            </div>
            
            <nav class="p-4 space-y-2">
                <a href="/dashboard" class="flex items-center gap-3 px-4 py-3 bg-blue-600 text-white rounded-xl font-bold text-sm shadow-md transition">
                    <i class="fa-solid fa-house text-base"></i> Home
                </a>
                <a href="/pinjam" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 hover:text-white rounded-xl font-medium text-sm transition">
                    <i class="fa-solid fa-car-rear text-base"></i> Pinjam Mobil
                </a>
                <a href="/pesanan" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 hover:text-white rounded-xl font-medium text-sm transition">
                    <i class="fa-solid fa-receipt text-base"></i> Pesanan Anda
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 hover:bg-slate-800 hover:text-white rounded-xl font-medium text-sm transition">
                    <i class="fa-solid fa-bell text-base"></i> Notifikasi
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800">
            <div class="flex items-center gap-3 p-2 bg-slate-950/40 rounded-xl">
                <div class="w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-xs">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div class="overflow-hidden">
                    <h4 class="text-xs font-bold text-white truncate">Diskominfo Kubar</h4>
                    <p class="text-[10px] text-slate-500 truncate">Pegawai Internal</p>
                </div>
            </div>
        </div>
    </aside>


    <div class="flex-1 flex flex-col min-h-screen overflow-hidden">
        
        <header class="bg-white border-b border-gray-200 h-16 flex justify-between items-center px-4 md:px-8 sticky top-0 z-40 shadow-sm">
            <button id="btnHamburger" class="w-10 h-10 bg-gray-50 hover:bg-gray-100 rounded-xl flex md:hidden items-center justify-center text-gray-700 text-lg transition shadow-sm">
                <i class="fa-solid fa-bars"></i>
            </button>
            
            <div>
                <div class="md:hidden text-center pr-10 flex-1">
                    <h1 class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none">Mobi-Kubar</h1>
                    <span class="text-[9px] bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full font-bold border border-blue-100">Diskominfo</span>
                </div>
                <div class="hidden md:block">
                    <h3 class="text-xs font-semibold uppercase tracking-wider text-gray-400">Internal System</h3>
                    <h1 class="text-sm font-bold text-gray-800">Dashboard Utama Pelayanan</h1>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button class="text-gray-500 hover:text-blue-600 transition relative">
                    <i class="fa-solid fa-bell text-lg"></i>
                    <span class="w-2 h-2 bg-red-500 rounded-full absolute -top-0.5 -right-0.5"></span>
                </button>
                <div class="h-4 w-[1px] bg-gray-300 hidden md:block"></div>
                <span class="text-xs font-bold text-gray-700 bg-gray-100 px-3 py-1.5 rounded-lg hidden md:block">Kutai Barat, Kaltim</span>
            </div>
        </header>

        <main class="p-5 md:p-8 flex-1 max-w-md md:max-w-5xl w-full mx-auto space-y-6 md:space-y-8">
            
            <div class="md:hidden">
                <h2 class="text-xs text-gray-400 font-bold uppercase tracking-wider">Selamat Datang,</h2>
                <h1 class="text-xl font-black text-gray-800 tracking-wide">Diskominfo Kutai Barat</h1>
            </div>

            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 md:from-blue-600 md:to-indigo-700 bg-gradient-to-r max-md:from-amber-500 max-md:to-orange-600 rounded-2xl p-6 md:p-8 text-white shadow-md flex justify-between items-center relative overflow-hidden">
                <div class="max-w-xl z-10">
                    <span class="text-xs font-bold uppercase tracking-widest text-blue-200 md:text-blue-200 max-md:text-orange-100">Selamat Datang,</span>
                    <h2 class="text-xl md:text-3xl font-black mt-1 tracking-wide max-md:hidden">Diskominfo Kutai Barat</h2>
                    <h2 class="text-lg font-extrabold uppercase leading-tight md:hidden">Bantuan Tersedia Disini</h2>
                    <p class="text-xs text-blue-100 mt-2 leading-relaxed opacity-90 max-w-md max-md:hidden">
                        Akses layanan operasional internal dinas komunikasi dan informatika dalam satu pintu aplikasi terintegrasi.
                    </p>
                    <button class="bg-white text-orange-600 font-bold text-[11px] px-4 py-2 rounded-xl shadow hover:bg-orange-50 transition transform active:scale-95 mt-3 md:hidden">
                        Selengkapnya
                    </button>
                </div>
                
                <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-xl p-5 text-right hidden md:block z-10 max-w-xs">
                    <h4 class="text-sm font-extrabold uppercase tracking-wide mb-1">Bantuan Tersedia</h4>
                    <p class="text-[11px] text-blue-100 mb-3">Butuh bantuan teknis terkait unit armada?</p>
                    <button class="bg-white text-blue-700 font-bold text-xs px-4 py-2 rounded-lg shadow hover:bg-blue-50 transition">
                        Hubungi Admin
                    </button>
                </div>
                <i class="fa-solid fa-shield-halved text-[12rem] text-white/5 absolute -right-6 -bottom-10 transform -rotate-12 max-md:hidden"></i>
                <i class="fa-solid fa-headset text-7xl text-white/20 absolute -right-2 -bottom-2 transform rotate-12 md:hidden"></i>
            </div>

            <div>
                <h4 class="text-xs font-extrabold text-gray-800 uppercase tracking-widest mb-4">Kategori Layanan Utama</h4>
                <div class="grid grid-cols-2 md:grid-cols-2 gap-4 md:gap-6">
                    
                    <a href="/pinjam" class="bg-white max-md:bg-blue-50/50 border border-gray-200 max-md:border-blue-100 hover:border-blue-400 p-4 md:p-6 rounded-2xl flex flex-col md:flex-row items-center md:items-center gap-3 md:gap-5 text-center md:text-left transition shadow-sm hover:shadow-md group">
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-blue-500 md:bg-blue-100 text-white md:text-blue-600 md:group-hover:bg-blue-600 md:group-hover:text-white rounded-full md:rounded-xl flex items-center justify-center text-xl md:text-2xl shadow-sm transition duration-300">
                            <i class="fa-solid fa-car"></i>
                        </div>
                        <div>
                            <h4 class="text-xs md:text-sm font-bold text-gray-700 md:text-gray-800">Ketersediaan Mobil</h4>
                            <p class="text-xs text-gray-500 mt-1 hidden md:block">Cek jadwal kosong armada dan buat formulir izin peminjaman dinas.</p>
                        </div>
                    </a>

                    <a href="/pesanan" class="bg-white max-md:bg-emerald-50/50 border border-gray-200 max-md:border-emerald-100 hover:border-emerald-400 p-4 md:p-6 rounded-2xl flex flex-col md:flex-row items-center md:items-center gap-3 md:gap-5 text-center md:text-left transition shadow-sm hover:shadow-md group">
                        <div class="w-12 h-12 md:w-14 md:h-14 bg-emerald-500 md:bg-emerald-100 text-white md:text-emerald-600 md:group-hover:bg-emerald-600 md:group-hover:text-white rounded-full md:rounded-xl flex items-center justify-center text-xl md:text-2xl shadow-sm transition duration-300">
                            <i class="fa-solid fa-receipt"></i>
                        </div>
                        <div>
                            <h4 class="text-xs md:text-sm font-bold text-gray-700 md:text-gray-800">Pesanan Anda</h4>
                            <p class="text-xs text-gray-500 mt-1 hidden md:block">Pantau proses verifikasi permohonan kendaraan oleh Kabag diskominfo.</p>
                        </div>
                    </a>

                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-2xl p-4 md:p-6 shadow-sm flex items-center justify-between">
                <div class="flex items-center gap-3 md:gap-4">
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center text-lg">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <div>
                        <h4 class="text-xs md:text-sm font-bold text-gray-800">Kebun dan Halaman Dinas</h4>
                        <p class="text-[10px] md:text-xs text-gray-400 md:text-gray-500 mt-0.5">Layanan kebersihan area perkantoran Diskominfo Kutai Barat.</p>
                    </div>
                </div>
                <span class="text-[9px] md:text-[11px] bg-amber-50 text-amber-700 px-2 py-1 md:px-3 md:py-1.5 font-bold rounded-lg border border-amber-100 shrink-0">Layanan Pendukung</span>
            </div>

        </main>

        <footer class="bg-white border-t border-gray-200 py-4 text-center text-[10px] text-gray-400 mt-auto hidden md:block">
            &copy; 2026 Diskominfo Kutai Barat. All Rights Reserved.
        </footer>
        <footer class="text-center text-[10px] text-gray-400 pb-4 md:hidden">
            &copy; 2026 Diskominfo Kutai Barat.
        </footer>

    </div>


    <div id="sidebarBackdrop" class="fixed inset-0 bg-black/50 z-50 hidden opacity-0 transition-opacity duration-300 md:hidden"></div>

    <aside id="sidebarMenu" class="fixed top-0 bottom-0 left-0 w-72 bg-slate-900 text-slate-300 z-50 transform -translate-x-full transition-transform duration-300 flex flex-col justify-between shadow-2xl md:hidden">
        <div>
            <div class="p-5 border-b border-slate-800 flex justify-between items-center">
                <div class="flex items-center gap-2.5">
                    <div class="w-7 h-7 bg-blue-600 text-white rounded-lg flex items-center justify-center text-sm shadow-md">
                        <i class="fa-solid fa-car-side"></i>
                    </div>
                    <h2 class="text-xs font-black text-white uppercase tracking-wider">Mobi-Kubar</h2>
                </div>
                <button id="btnCloseSidebar" class="w-8 h-8 hover:bg-slate-800 rounded-lg flex items-center justify-center text-slate-400 hover:text-white transition">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <nav class="p-4 space-y-1.5">
                <a href="/dashboard" class="flex items-center gap-3.5 px-4 py-3 bg-blue-600 text-white rounded-xl font-bold text-xs shadow-md transition">
                    <i class="fa-solid fa-house text-sm"></i> Home / Dashboard
                </a>
                <a href="/pinjam" class="flex items-center gap-3.5 px-4 py-3 hover:bg-slate-800 hover:text-white rounded-xl font-bold text-xs transition">
                    <i class="fa-solid fa-car-rear text-sm"></i> Formulir Pinjam Mobil
                </a>
                <a href="/pesanan" class="flex items-center gap-3.5 px-4 py-3 hover:bg-slate-800 hover:text-white rounded-xl font-bold text-xs transition">
                    <i class="fa-solid fa-receipt text-sm"></i> Status Pesanan Anda
                </a>
                <a href="/notifikasi" class="flex items-center gap-3.5 px-4 py-3 hover:bg-slate-800 hover:text-white rounded-xl font-bold text-xs transition">
                    <i class="fa-solid fa-bell text-sm"></i> Notifikasi Masuk
                </a>
            </nav>
        </div>

        <div class="p-4 border-t border-slate-800 bg-slate-950/30">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 bg-slate-700 text-white rounded-full flex items-center justify-center font-bold text-xs">
                    <i class="fa-solid fa-user"></i>
                </div>
                <div>
                    <h4 class="text-xs font-bold text-white leading-tight">Diskominfo Kubar</h4>
                    <p class="text-[9px] text-slate-500 font-medium">Pegawai Internal</p>
                </div>
            </div>
        </div>
    </aside>

    <script>
        const btnHamburger = document.getElementById('btnHamburger');
        const btnCloseSidebar = document.getElementById('btnCloseSidebar');
        const sidebarMenu = document.getElementById('sidebarMenu');
        const sidebarBackdrop = document.getElementById('sidebarBackdrop');

        function openSidebar() {
            sidebarBackdrop.classList.remove('hidden');
            setTimeout(() => {
                sidebarBackdrop.classList.remove('opacity-0');
                sidebarMenu.classList.remove('-translate-x-full');
            }, 10);
        }

        function closeSidebar() {
            sidebarMenu.classList.add('-translate-x-full');
            sidebarBackdrop.classList.add('opacity-0');
            setTimeout(() => {
                sidebarBackdrop.classList.add('hidden');
            }, 300);
        }

        if(btnHamburger) btnHamburger.addEventListener('click', openSidebar);
        if(btnCloseSidebar) btnCloseSidebar.addEventListener('click', closeSidebar);
        if(sidebarBackdrop) sidebarBackdrop.addEventListener('click', closeSidebar);
    </script>

</body>
</html>