<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Car Rental Service - Diskominfo Kutai Barat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen w-screen flex items-center justify-center p-0 md:p-8 overflow-x-hidden antialiased font-sans">

    <div class="bg-[#2B6CB0] w-full h-screen md:h-[800px] md:max-w-7xl md:rounded-[40px] shadow-[0_25px_60px_-15px_rgba(0,0,0,0.7)] flex flex-col md:flex-row overflow-hidden relative border border-white/10">
        
        <div class="flex md:hidden flex-col justify-between h-full w-full p-6 pb-6 relative overflow-hidden z-20 bg-[#2B6CB0]">
            
            <div class="w-full flex justify-center pt-1">
                <img src="{{ asset('images/logo-kubar.png') }}" 
                     alt="Logo Diskominfo Mobile" 
                     class="w-full max-w-[220px] h-auto object-contain block">
            </div>

            <div class="text-left px-2 mt-3 flex flex-col gap-2">
                <h1 class="text-white font-black text-3xl tracking-wide uppercase leading-tight">
                    Car Rental<br><span class="text-amber-400">Service</span>
                </h1>
                <p class="text-white/90 text-xs leading-relaxed text-justify mt-1">
                    Sistem informasi pengelolaan, monitoring, dan peminjaman armada mobil dinas terintegrasi pada <span class="text-white font-bold">Dinas Komunikasi dan Informatika Kabupaten Kutai Barat</span>.
                </p>
            </div>

            <div class="relative w-full flex-1 flex items-center justify-center my-4 overflow-visible">
                <div class="absolute left-[-24px] top-2 w-[75%] h-44 bg-blue-500/30 rounded-[32px] z-0"></div>
                <div class="absolute right-[-24px] bottom-0 w-[85%] h-36 bg-[#0F2D52] rounded-[32px] z-0"></div>
                
                <img src="{{ asset('images/pajero.png') }}" 
                     alt="Pajero Sport Mobile" 
                     class="absolute max-w-none w-[140%] left-[-6%] bottom-[-8px] object-contain z-10 
                            drop-shadow-[-20px_25px_15px_rgba(0,0,0,0.6)] pointer-events-none">
            </div>

            <div class="w-full px-2 relative z-30">
                <a href="{{ route('login') }}" 
                   class="block w-full bg-white text-[#2B6CB0] font-bold text-center py-3.5 rounded-[24px] transition shadow-2xl active:scale-95 text-lg tracking-wide">
                    Get started
                </a>
            </div>
        </div>


        <div class="hidden md:flex w-[45%] p-16 flex-col justify-between z-20 relative">
            
            <div class="w-full flex justify-start items-center">
                <img src="{{ asset('images/logo-kubar.png') }}" 
                     alt="Logo Diskominfo Desktop" 
                     class="w-[260px] lg:w-[290px] h-auto object-contain block filter drop-shadow-sm">
            </div>

            <div class="my-auto pt-10">
                <div class="flex items-center gap-2 mb-3">
                    <span class="h-[2px] w-8 bg-amber-400 rounded-full"></span>
                    <span class="text-amber-400 text-xs font-bold uppercase tracking-widest">Layanan Transportasi Dinas</span>
                </div>
                <h1 class="text-white font-black text-5xl lg:text-6xl tracking-wide uppercase mb-6 leading-[1.05] drop-shadow-xl">
                    Car Rental<br><span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-300 via-amber-400 to-yellow-200">Service</span>
                </h1>
                <p class="text-blue-100/80 text-base lg:text-lg leading-relaxed max-w-sm font-normal text-justify">
                    Sistem informasi pengelolaan, monitoring, dan peminjaman armada mobil dinas terintegrasi pada <span class="text-white font-semibold">Dinas Komunikasi dan Informatika Kabupaten Kutai Barat</span>.
                </p>
            </div>

            <div class="pt-4 border-t border-white/10 w-full">
                <p class="text-left text-[11px] text-white/30 font-medium tracking-widest">
                    © 2026 DISKOMINFO KUTAI BARAT • INDONESIA
                </p>
            </div>
        </div>

        <div class="hidden md:flex w-[55%] flex-col items-center justify-between relative p-12 pr-16 overflow-visible z-20">
            <div class="absolute w-[520px] h-[520px] rounded-full bg-gradient-to-tr from-blue-600/20 via-sky-400/5 to-transparent blur-xl right-12 top-10 pointer-events-none z-0"></div>
            
            <div class="relative w-full flex-1 flex items-center justify-center overflow-visible z-10">
                <img src="{{ asset('images/pajero.png') }}" 
                     alt="Pajero Sport Dinas" 
                     class="w-[125%] max-w-none object-contain drop-shadow-[-35px_45px_30px_rgba(0,0,0,0.55)] transform scale-135 translate-x-12 translate-y-6 pointer-events-none">
            </div>

            <div class="w-full flex justify-center pt-6 z-30 relative">
                <a href="{{ route('login') }}" 
                   class="inline-flex items-center justify-center bg-gradient-to-r from-amber-400 via-amber-500 to-yellow-400 hover:from-amber-500 hover:to-yellow-500 text-slate-900 font-black text-center text-lg py-4 px-24 rounded-2xl transition-all duration-300 shadow-[0_20px_40px_rgba(251,191,36,0.3)] transform hover:-translate-y-1.5 active:translate-y-0 min-w-[320px] tracking-wider uppercase">
                    Get started
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>

    </div>

</body>
</html>