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

    <div class="flex min-h-screen">
        <aside class="w-64 bg-blue-600 text-white min-h-screen p-4 flex flex-col justify-between shrink-0 shadow-lg">
            <div>
                <div class="flex items-center gap-3 px-2 py-4 mb-6">
                    <div class="p-2.5 bg-black rounded-xl text-cyan-400 flex items-center justify-center">
                        <i class="fa-solid fa-car text-xl"></i>
                    </div>
                    <div>
                        <h2 class="font-black text-lg leading-tight uppercase tracking-wide">Mobi-Kubar</h2>
                        <p class="text-[10px] text-blue-200 font-bold uppercase tracking-wider">Diskominfo App</p>
                    </div>
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

        <main class="flex-1 p-6 overflow-y-auto bg-slate-100">
            @yield('content')
        </main>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    @stack('scripts')
</body>
</html>