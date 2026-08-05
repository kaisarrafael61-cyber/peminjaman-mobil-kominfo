<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peminjaman Mobil Diskominfo Kubar</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }
        /* Aksen Pola Halus untuk Latar Belakang Gradasi */
        .ethnic-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 0), radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 0);
            background-size: 16px 16px;
            background-position: 0 0, 8px 8px;
        }
    </style>
</head>
<body class="text-slate-800 antialiased">

    <div class="hidden md:flex min-h-screen">
        <aside class="w-72 bg-gradient-to-b from-[#1b4cc7] via-[#2563eb] to-[#1e40af] text-white flex flex-col justify-between p-6 shadow-xl relative overflow-hidden flex-shrink-0">
            <div class="absolute inset-0 opacity-10 pointer-events-none ethnic-pattern"></div>
            
            <div class="z-10">
                <div class="flex items-center gap-3 mb-8">
                    <div class="bg-[#05152b] p-2.5 rounded-xl text-cyan-400 shadow-md">
                        <i class="fa-solid fa-car text-xl"></i>
                    </div>
                    <div>
                        <h1 class="font-black tracking-wider text-sm">MOBI-KUBAR</h1>
                        <p class="text-[9px] text-amber-300 font-bold uppercase tracking-widest">Diskominfo App</p>
                    </div>
                </div>

                <p class="text-[10px] font-bold text-blue-200/60 tracking-widest uppercase mb-2 px-2">Menu Utama</p>
                <nav class="space-y-1">
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 bg-[#0a1d37] text-white px-4 py-2.5 rounded-xl font-bold transition shadow-md border border-slate-800/20">
                        <i class="fa-solid fa-house text-cyan-300 w-5"></i> Home
                    </a>
                    
                    <a href="{{ route('ketersediaan.index') }}" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-car-side text-white/60 w-5"></i> Ketersediaan Mobil
                    </a>
                    
                    <a href="{{ route('pesan.index') }}" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-comments text-white/60 w-5"></i> Pesan
                    </a>
                    
                    <a href="{{ route('lokasi.index') }}" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-location-dot text-white/60 w-5"></i> Lokasi & Antar Jemput
                    </a>
                    
                    <a href="#" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-clock-rotate-left text-white/60 w-5"></i> Riwayat Pemesanan
                    </a>
                    
                    <a href="#" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-wallet text-white/60 w-5"></i> Payment
                    </a>
                    
                    <a href="{{ route('pengaturan.index') }}" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-gear text-white/60 w-5"></i> Pengaturan
                    </a>

                    {{-- MENU KHUSUS ADMIN (DESKTOP) --}}
                    @if(Auth::check() && strtolower(Auth::user()->role ?? '') === 'admin')
                        <div class="pt-3 mt-3 border-t border-white/20">
                            <p class="text-[10px] font-bold text-amber-300 tracking-widest uppercase mb-2 px-2">Panel Admin</p>
                            <a href="{{ route('admin.peminjaman.index') }}" class="flex items-center gap-3 bg-amber-500/20 text-amber-300 hover:bg-amber-500/30 border border-amber-400/30 px-4 py-2.5 rounded-xl font-bold transition shadow-sm">
                                <i class="fa-solid fa-clipboard-check text-amber-300 w-5"></i> Persetujuan Pinjam
                            </a>
                        </div>
                    @endif
                </nav>
            </div>

            <div class="border-t border-white/20 pt-4 space-y-3 z-10">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-[#05152b] border border-white/20 flex items-center justify-center text-white font-black uppercase">
                            {{ substr(Auth::user()->name ?? 'D', 0, 1) }}
                        </div>
                        <div>
                            <h4 class="text-sm font-black truncate max-w-[120px]">{{ Auth::user()->name ?? 'Diskominfo Kubar' }}</h4>
                            <p class="text-[10px] text-amber-300 font-bold uppercase">
                                {{ Auth::user()->role ?? 'Pegawai Internal' }}
                            </p>
                        </div>
                    </div>

                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                onclick="return confirm('Apakah Anda yakin ingin keluar / ganti akun?')"
                                title="Logout / Ganti Akun"
                                class="p-2 text-red-200 hover:text-white hover:bg-red-500/30 rounded-lg transition">
                            <i class="fa-solid fa-power-off text-base"></i>
                        </button>
                    </form>
                </div>
                
                <form action="{{ url('/logout') }}" method="POST" class="block">
                    @csrf
                    <button type="submit" 
                            onclick="return confirm('Apakah Anda yakin ingin keluar / ganti akun?')"
                            class="w-full text-left text-xs text-amber-300 hover:text-amber-200 font-bold transition py-1 flex items-center gap-2">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> Keluar / Ganti Akun
                    </button>
                </form>
            </div>
        </aside>

        <main class="flex-1 flex flex-col bg-gradient-to-tr from-[#1e40af]/5 via-white to-white overflow-y-auto">
            <header class="bg-white border-b border-slate-200/80 px-8 py-4 flex justify-between items-center shadow-sm">
                <div>
                    <span class="text-xs font-black text-[#2563eb] tracking-widest uppercase block">Internal System</span>
                    <h2 class="text-xl font-black text-slate-900">Dashboard Utama Pelayanan</h2>
                </div>
                <div class="flex items-center gap-4">
                    <button class="relative p-2 text-slate-400 hover:text-[#2563eb] transition">
                        <i class="fa-solid fa-bell text-xl"></i>
                        <span class="absolute top-1 right-1 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                    </button>
                    <div class="bg-amber-500 text-slate-950 px-4 py-1.5 rounded-full text-xs font-black tracking-wide shadow-sm border border-amber-400">
                        <i class="fa-solid fa-map-marker-alt mr-1"></i> Kutai Barat, Kaltim
                    </div>
                </div>
            </header>

            <div class="p-8 space-y-8 max-w-6xl flex-1">
                @if(session('success'))
                    <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl text-sm flex items-center gap-2 shadow-sm">
                        <i class="fa-solid fa-circle-check text-emerald-600"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-gradient-to-r from-[#1b4cc7] via-[#2563eb] to-[#1e40af] text-white p-8 rounded-3xl shadow-xl flex justify-between items-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10 pointer-events-none ethnic-pattern"></div>
                    <div class="space-y-3 z-10">
                        <div class="inline-block bg-amber-500/30 border border-amber-400/40 px-3 py-1 rounded-xl text-[10px] font-black tracking-widest text-amber-300 uppercase mb-1">
                            <i class="fa-solid fa-award mr-1"></i> TANAA PURAI NGERIMAN
                        </div>
                        <h3 class="text-3xl font-black tracking-tight leading-tight">Selamat Datang,<br><span class="text-amber-300">{{ Auth::user()->name ?? 'Diskominfo Kutai Barat' }}</span></h3>
                        <p class="text-blue-100 max-w-xl text-xs font-medium leading-relaxed">Akses layanan operasional internal dinas komunikasi dan informatika dalam satu pintu aplikasi terintegrasi.</p>
                    </div>
                    
                    <div class="bg-[#0a1d37] p-6 rounded-2xl border border-slate-800/40 text-left w-64 z-10 shadow-2xl relative overflow-hidden">
                        <h4 class="font-black text-sm tracking-wider mb-1 leading-tight text-white">BANTUAN<br>TERSEDIA<br>DISINI</h4>
                        <p class="text-[11px] text-slate-400 mb-4 font-medium">Butuh bantuan unit armada?</p>
                        <a href="{{ route('pesan.index') }}" class="inline-block bg-[#00a8cc] text-white px-5 py-2 rounded-xl text-xs font-black hover:bg-[#00bbf0] transition shadow-md w-full text-center">Hubungi Admin</a>
                        <div class="absolute right-[-10px] bottom-[-15px] text-white/5 text-5xl font-black select-none pointer-events-none">
                            <i class="fa-solid fa-headset"></i>
                        </div>
                    </div>
                </div>

                <div>
                    <h4 class="font-black text-xs tracking-widest text-slate-400 uppercase mb-4">KATEGORI LAYANAN UTAMA</h4>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        
                        <a href="{{ route('ketersediaan.index') }}" class="bg-[#103bb3] text-white p-5 rounded-2xl shadow-lg border border-blue-600/30 hover:bg-[#1648cc] transition flex items-start gap-4 cursor-pointer group">
                            <div class="bg-[#05152b] p-3.5 rounded-xl text-cyan-300 shadow-md group-hover:scale-105 transition flex-shrink-0">
                                <i class="fa-solid fa-car-side text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-white text-sm mb-0.5">Ketersediaan Mobil</h5>
                                <p class="text-[11px] text-blue-100/80 leading-normal font-medium">Cek jadwal kosong armada dan buat permohonan dinas.</p>
                            </div>
                        </a>

                        <a href="{{ route('pesan.index') }}" class="bg-[#103bb3] text-white p-5 rounded-2xl shadow-lg border border-blue-600/30 hover:bg-[#1648cc] transition flex items-start gap-4 cursor-pointer group">
                            <div class="bg-[#05152b] p-3.5 rounded-xl text-cyan-300 shadow-md group-hover:scale-105 transition flex-shrink-0">
                                <i class="fa-solid fa-comments text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-white text-sm mb-0.5">Pesan</h5>
                                <p class="text-[11px] text-blue-100/80 leading-normal font-medium">Hubungi koordinasi internal tim operasional dinas.</p>
                            </div>
                        </a>

                        <a href="{{ route('pengaturan.index') }}" class="bg-[#103bb3] text-white p-5 rounded-2xl shadow-lg border border-blue-600/30 hover:bg-[#1648cc] transition flex items-start gap-4 cursor-pointer group">
                            <div class="bg-[#05152b] p-3.5 rounded-xl text-cyan-300 shadow-md group-hover:scale-105 transition flex-shrink-0">
                                <i class="fa-solid fa-gear text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-white text-sm mb-0.5">Pengaturan</h5>
                                <p class="text-[11px] text-blue-100/80 leading-normal font-medium">Konfigurasi akun data profil pegawai internal dinas.</p>
                            </div>
                        </a>

                        <a href="{{ route('lokasi.index') }}" class="bg-[#103bb3] text-white p-5 rounded-2xl shadow-lg border border-blue-600/30 hover:bg-[#1648cc] transition flex items-start gap-4 cursor-pointer group">
                            <div class="bg-[#05152b] p-3.5 rounded-xl text-cyan-300 shadow-md group-hover:scale-105 transition flex-shrink-0">
                                <i class="fa-solid fa-location-dot text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-white text-sm mb-0.5">Lokasi & Antar Jemput</h5>
                                <p class="text-[11px] text-blue-100/80 leading-normal font-medium">Pantau titik koordinat penjemputan mobil dinas.</p>
                            </div>
                        </a>

                        <a href="#" class="bg-[#103bb3] text-white p-5 rounded-2xl shadow-lg border border-blue-600/30 hover:bg-[#1648cc] transition flex items-start gap-4 cursor-pointer group">
                            <div class="bg-[#05152b] p-3.5 rounded-xl text-cyan-300 shadow-md group-hover:scale-105 transition flex-shrink-0">
                                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-white text-sm mb-0.5">Riwayat Pemesanan</h5>
                                <p class="text-[11px] text-blue-100/80 leading-normal font-medium">Lihat kembali seluruh rekaman arsip perjalanan dinas.</p>
                            </div>
                        </a>

                        <a href="#" class="bg-[#103bb3] text-white p-5 rounded-2xl shadow-lg border border-blue-600/30 hover:bg-[#1648cc] transition flex items-start gap-4 cursor-pointer group">
                            <div class="bg-[#05152b] p-3.5 rounded-xl text-cyan-300 shadow-md group-hover:scale-105 transition flex-shrink-0">
                                <i class="fa-solid fa-wallet text-xl"></i>
                            </div>
                            <div>
                                <h5 class="font-black text-white text-sm mb-0.5">Payment</h5>
                                <p class="text-[11px] text-blue-100/80 leading-normal font-medium">Monitoring anggaran tol atau klaim bensin perjalanan.</p>
                            </div>
                        </a>

                        {{-- TOMBOL KARTU LAYANAN PERSETUJUAN (KHUSUS ADMIN) --}}
                        @if(Auth::check() && strtolower(Auth::user()->role ?? '') === 'admin')
                            <a href="{{ route('admin.peminjaman.index') }}" class="bg-gradient-to-r from-amber-600 to-amber-700 text-white p-5 rounded-2xl shadow-lg border border-amber-500/40 hover:from-amber-500 hover:to-amber-600 transition flex items-start gap-4 cursor-pointer group col-span-1 sm:col-span-2 lg:col-span-3">
                                <div class="bg-[#05152b] p-3.5 rounded-xl text-amber-400 shadow-md group-hover:scale-105 transition flex-shrink-0">
                                    <i class="fa-solid fa-clipboard-check text-xl"></i>
                                </div>
                                <div>
                                    <h5 class="font-black text-amber-300 text-sm mb-0.5">Persetujuan Pinjam (Admin Panel)</h5>
                                    <p class="text-[11px] text-amber-100/90 leading-normal font-medium">Kelola, setujui, atau tolak permohonan peminjaman mobil dinas dari pegawai.</p>
                                </div>
                            </a>
                        @endif
                    </div>
                </div>

                <div class="bg-[#05152b] text-white p-5 rounded-2xl border border-slate-900/40 shadow-xl flex justify-between items-center">
                    <div class="flex items-center gap-4">
                        <div class="bg-[#103bb3] p-3 rounded-xl text-cyan-300 shadow-md">
                            <i class="fa-solid fa-leaf text-xl"></i>
                        </div>
                        <div>
                            <h5 class="font-black text-white text-base mb-0.5">Kebun dan Halaman Dinas</h5>
                            <p class="text-xs text-slate-400 font-medium">Layanan kebersihan area perkantoran Diskominfo Kutai Barat.</p>
                        </div>
                    </div>
                    <span class="bg-[#00a8cc] text-white px-5 py-2 rounded-full text-xs font-black shadow-md">Layanan Pendukung</span>
                </div>
            </div>
            
            <footer class="mt-auto py-4 text-center text-xs text-slate-400 border-t border-slate-200 bg-white font-medium">
                &copy; {{ date('Y') }} Diskominfo Kutai Barat. All Rights Reserved.
            </footer>
        </main>
    </div>

    <div class="md:hidden min-h-screen bg-gradient-to-b from-[#1b4cc7] via-[#2563eb] to-[#1e40af] text-white flex flex-col pb-24 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 pointer-events-none ethnic-pattern"></div>
        
        <header class="p-6 flex justify-between items-start z-10">
            <div>
                <form action="{{ url('/logout') }}" method="POST" id="logout-form-mobile">
                    @csrf
                    <button type="submit" 
                            onclick="return confirm('Apakah Anda yakin ingin keluar / ganti akun?')"
                            class="text-white text-2xl mb-4 hover:opacity-85 transition" 
                            title="Keluar / Ganti Akun">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
                
                <h2 class="text-4xl font-extrabold text-white leading-tight tracking-tight">Selamat<br>Datang,</h2>
                <p class="text-white font-extrabold text-base mt-2 tracking-wide drop-shadow">
                    {!! nl2br(e(Auth::user()->name ?? "Diskominfo\nKutai Barat")) !!}
                </p>
                <span class="inline-block bg-amber-400/30 text-amber-200 text-[10px] font-bold px-2.5 py-0.5 rounded-full uppercase mt-1 border border-amber-300/30">
                    {{ Auth::user()->role ?? 'Pegawai' }}
                </span>
            </div>
        </header>

        <div class="mx-6 mb-3 bg-amber-500/20 border border-amber-400/30 px-4 py-1.5 rounded-xl text-center z-10">
            <p class="text-[10px] font-bold tracking-widest text-amber-300 uppercase"><i class="fa-solid fa-mountain"></i> Tanaa Purai Ngeriman</p>
        </div>

        <div class="mx-6 mb-8 bg-[#0a1d37] text-white p-6 rounded-3xl flex justify-between items-center shadow-2xl relative overflow-hidden border border-slate-800/50 z-10">
            <div>
                <h4 class="font-black text-base tracking-wider leading-tight">BANTUAN<br>TERSEDIA<br>DISINI</h4>
                <a href="{{ route('pesan.index') }}" class="text-xs font-bold text-cyan-400 flex items-center gap-1.5 hover:underline mt-3">Selengkapnya <i class="fa-solid fa-circle-arrow-right"></i></a>
            </div>
            <div class="absolute right-[-5px] bottom-[-15px] text-white/5 text-7xl font-black select-none pointer-events-none">
                <i class="fa-solid fa-headset"></i>
            </div>
        </div>

        <div class="px-6 space-y-6 flex-1 z-10">
            <h4 class="font-black text-xs text-white/90 tracking-widest uppercase">KATEGORI LAYANAN</h4>
            
            <div class="grid grid-cols-3 gap-4">
                <a href="{{ route('ketersediaan.index') }}" class="bg-[#103bb3] text-white p-4 rounded-2xl shadow-xl border border-blue-600/30 flex flex-col items-center justify-center text-center gap-2 aspect-square active:scale-95 transition">
                    <i class="fa-solid fa-car text-xl text-cyan-300"></i>
                    <span class="text-[9px] font-black uppercase tracking-tight block leading-tight">Ketersediaan<br>Mobil</span>
                </a>

                <a href="{{ route('pesan.index') }}" class="bg-[#103bb3] text-white p-4 rounded-2xl shadow-xl border border-blue-600/30 flex flex-col items-center justify-center text-center gap-2 aspect-square active:scale-95 transition">
                    <i class="fa-solid fa-comments text-xl text-cyan-300"></i>
                    <span class="text-[9px] font-black uppercase tracking-tight block">Pesan</span>
                </a>

                <a href="{{ route('pengaturan.index') }}" class="bg-[#103bb3] text-white p-4 rounded-2xl shadow-xl border border-blue-600/30 flex flex-col items-center justify-center text-center gap-2 aspect-square active:scale-95 transition">
                    <i class="fa-solid fa-gear text-xl text-cyan-300"></i>
                    <span class="text-[9px] font-black uppercase tracking-tight block">Pengaturan</span>
                </a>
                
                <a href="{{ route('lokasi.index') }}" class="bg-[#103bb3] text-white p-4 rounded-2xl shadow-xl border border-blue-600/30 flex flex-col items-center justify-center text-center gap-2 aspect-square active:scale-95 transition">
                    <i class="fa-solid fa-location-dot text-xl text-cyan-300"></i>
                    <span class="text-[9px] font-black uppercase tracking-tight block leading-tight">Lokasi & Antar<br>Jemput</span>
                </a>
                
                <a href="#" class="bg-[#103bb3] text-white p-4 rounded-2xl shadow-xl border border-blue-600/30 flex flex-col items-center justify-center text-center gap-2 aspect-square active:scale-95 transition">
                    <i class="fa-solid fa-clock-rotate-left text-xl text-cyan-300"></i>
                    <span class="text-[9px] font-black uppercase tracking-tight block leading-tight">Riwayat<br>Pemesanan</span>
                </a>

                <a href="#" class="bg-[#103bb3] text-white p-4 rounded-2xl shadow-xl border border-blue-600/30 flex flex-col items-center justify-center text-center gap-2 aspect-square active:scale-95 transition">
                    <i class="fa-solid fa-wallet text-xl text-cyan-300"></i>
                    <span class="text-[9px] font-black uppercase tracking-tight block">Payment</span>
                </a>

                {{-- MENU ADMIN MOBILE --}}
                @if(Auth::check() && strtolower(Auth::user()->role ?? '') === 'admin')
                    <a href="{{ route('admin.peminjaman.index') }}" class="bg-amber-600 text-white p-4 rounded-2xl shadow-xl border border-amber-400/40 flex flex-col items-center justify-center text-center gap-2 col-span-3 active:scale-95 transition">
                        <i class="fa-solid fa-clipboard-check text-2xl text-amber-300"></i>
                        <span class="text-xs font-black uppercase tracking-wider block">Persetujuan Pinjam (Admin)</span>
                    </a>
                @endif
            </div>

            <div class="bg-[#05152b] text-white p-5 rounded-3xl flex justify-between items-center shadow-2xl border border-slate-900/40">
                <div>
                    <h5 class="text-xl font-black tracking-tight leading-tight">Pesanan Anda</h5>
                    <p class="text-xs text-slate-400 mt-0.5">Kebun dan Halaman</p>
                </div>
                <button class="bg-[#00a8cc] text-white font-black text-xs px-6 py-2.5 rounded-full hover:bg-[#00bbf0] transition active:scale-95 shadow-md shadow-cyan-500/20">Buka</button>
            </div>
        </div>

        <div class="fixed bottom-0 left-0 right-0 bg-white border-t border-slate-200 py-3 px-12 flex justify-between items-center z-50 rounded-t-3xl shadow-[0_-8px_30px_rgb(0,0,0,0.08)]">
            <button class="text-slate-400 hover:text-blue-600 p-2 text-xl transition">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <a href="{{ url('/dashboard') }}" class="text-blue-600 p-2 text-2xl transition">
                <i class="fa-solid fa-house"></i>
            </a>
        </div>
    </div>

</body>
</html>