<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mobi-Kubar - Diskominfo</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
</head>
<body class="bg-slate-100 font-sans antialiased text-slate-800">

    <div class="flex min-h-screen relative">
        
        <aside id="app-sidebar" 
               class="fixed inset-y-0 left-0 z-50 w-64 bg-blue-600 text-white min-h-screen p-4 flex flex-col justify-between shrink-0 shadow-lg transition-transform duration-300 ease-in-out -translate-x-full md:translate-x-0 md:static">
            <div>
                <div class="flex items-center justify-between px-2 py-4 mb-2 md:mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2.5 bg-black rounded-xl text-cyan-400 flex items-center justify-center">
                            <i class="fa-solid fa-car text-xl"></i>
                        </div>
                        <div>
                            <h2 class="font-black text-lg leading-tight uppercase tracking-wide">Mobi-Kubar</h2>
                            <p class="text-[10px] text-blue-200 font-bold uppercase tracking-wider">Diskominfo App</p>
                        </div>
                    </div>
                    <button onclick="toggleSidebar()" class="md:hidden text-white/80 hover:text-white p-2 focus:outline-none">
                        <i class="fa-solid fa-xmark text-xl"></i>
                    </button>
                </div>

                <nav class="space-y-1">
                    <p class="text-[10px] font-bold text-blue-200/80 uppercase tracking-widest px-3 mb-2">Menu Utama</p>

                    {{-- Home / Dashboard --}}
                    <a href="{{ route('dashboard') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition {{ request()->routeIs('dashboard') ? 'bg-slate-900 text-white shadow-md' : 'text-white/90 hover:bg-blue-700' }}">
                        <i class="fa-solid fa-house w-5 text-center"></i>
                        <span>Home</span>
                    </a>

                    {{-- Ketersediaan Mobil --}}
                    <a href="{{ route('ketersediaan.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition {{ request()->routeIs('ketersediaan.*') ? 'bg-slate-900 text-white shadow-md' : 'text-white/90 hover:bg-blue-700' }}">
                        <i class="fa-solid fa-car-side w-5 text-center"></i>
                        <span>Ketersediaan Mobil</span>
                    </a>

                    {{-- Pesan / Chat --}}
                    <a href="{{ route('pesan.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition {{ request()->routeIs('pesan.*') ? 'bg-slate-900 text-white shadow-md' : 'text-white/90 hover:bg-blue-700' }}">
                        <i class="fa-solid fa-comments w-5 text-center"></i>
                        <span>Pesan</span>
                    </a>

                    {{-- Lokasi & Antar Jemput --}}
                    <a href="{{ route('lokasi.index') }}" 
                       class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition {{ request()->routeIs('lokasi.*') ? 'bg-slate-900 text-white shadow-md' : 'text-white/90 hover:bg-blue-700' }}">
                        <i class="fa-solid fa-location-dot w-5 text-center"></i>
                        <span>Lokasi & Antar Jemput</span>
                    </a>

                    {{-- PANEL KHUSUS ADMIN --}}
                    @if(Auth::check() && strtolower(Auth::user()->role ?? '') === 'admin')
                        <div class="pt-4 mt-4 border-t border-white/20">
                            <p class="text-[10px] font-bold text-blue-200/80 uppercase tracking-widest px-3 mb-2">Panel Admin</p>
                            
                            <a href="{{ route('admin.peminjaman.index') }}" 
                               class="flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm transition {{ request()->routeIs('admin.peminjaman.*') ? 'bg-slate-900 text-white shadow-md' : 'bg-blue-700/60 text-white hover:bg-blue-700' }}">
                                <i class="fa-solid fa-clipboard-check w-5 text-center text-cyan-300"></i>
                                <span>Persetujuan Pinjam</span>
                            </a>
                        </div>
                    @endif
                </nav>
            </div>

            @auth
            <div class="p-3 bg-blue-700/50 rounded-xl flex items-center justify-between border border-white/10 mt-auto">
                <div class="flex items-center gap-3 overflow-hidden">
                    <div class="w-8 h-8 rounded-full bg-slate-900 text-white flex items-center justify-center font-bold text-xs uppercase shrink-0">
                        {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <p class="text-xs font-bold text-white truncate">{{ Auth::user()->name }}</p>
                        <p class="text-[10px] text-blue-200 uppercase font-semibold">{{ Auth::user()->role ?? 'Pegawai' }}</p>
                    </div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="text-white/70 hover:text-white p-1 transition" title="Logout">
                        <i class="fa-solid fa-power-off text-sm"></i>
                    </button>
                </form>
            </div>
            @endauth
        </aside>

        <div id="sidebar-overlay" onclick="toggleSidebar()" 
             class="fixed inset-0 bg-black/50 z-40 hidden md:hidden">
        </div>

        <main class="flex-1 p-4 md:p-6 overflow-y-auto bg-slate-100 w-full">
            <div class="md:hidden flex items-center justify-between mb-4 bg-white p-3 rounded-xl shadow-sm">
                <div class="flex items-center gap-2">
                    <button onclick="toggleSidebar()" class="text-slate-700 hover:text-blue-600 p-2 focus:outline-none">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>
                    <span class="font-black text-slate-800 text-sm">Mobi-Kubar</span>
                </div>
                <span class="text-xs font-semibold bg-blue-100 text-blue-600 px-2.5 py-1 rounded-full">
                    {{ Auth::user()->name ?? 'Guest' }}
                </span>
            </div>

            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                overlay.classList.add('block');
            } else {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.remove('block');
                overlay.classList.add('hidden');
            }
        }

        // Gesture Swipe (Geser Layar)
        let touchStartX = 0;
        let touchEndX = 0;

        document.addEventListener('touchstart', e => {
            touchStartX = e.touches[0].clientX;
        }, {passive: true});

        document.addEventListener('touchend', e => {
            touchEndX = e.changedTouches[0].clientX;
            handleSwipe();
        }, {passive: true});

        function handleSwipe() {
            const sidebar = document.getElementById('app-sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            let diff = touchEndX - touchStartX;
            
            // Geser ke kanan dari tepi kiri layar (< 50px) untuk membuka
            if (sidebar.classList.contains('-translate-x-full') && touchStartX < 50 && diff > 50) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                overlay.classList.add('block');
            }
            
            // Geser ke kiri untuk menutup saat sidebar sedang terbuka
            if (!sidebar.classList.contains('-translate-x-full') && diff < -50) {
                sidebar.classList.add('-translate-x-full');
                sidebar.classList.remove('translate-x-0');
                overlay.classList.remove('block');
                overlay.classList.add('hidden');
            }
        }
    </script>
    @stack('scripts')
</body>
</html>