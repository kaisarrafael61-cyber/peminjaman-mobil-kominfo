<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Diskominfo Kutai Barat</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 h-screen md:min-h-screen w-screen flex items-center justify-center p-0 md:p-8 overflow-hidden antialiased font-sans">

    <div class="bg-white w-full h-screen max-h-screen md:h-[780px] md:max-w-5xl md:rounded-[40px] shadow-[0_25px_60px_-15px_rgba(0,0,0,0.8)] flex flex-col md:flex-row overflow-hidden relative border md:border-white/10">
        
        <div class="bg-[#2B6CB0] w-full h-[45%] md:h-full md:w-[45%] pt-3 md:pt-8 pb-0 px-4 md:px-6 flex flex-col relative overflow-hidden shrink-0 justify-between">
            
            <div class="absolute inset-0 opacity-15 pointer-events-none z-0 mix-blend-overlay scale-110">
                <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                    <defs>
                        <pattern id="dayak-pattern" width="120" height="120" patternUnits="userSpaceOnUse">
                            <path d="M 0 20 Q 30 0, 60 20 T 120 20 M 0 60 Q 30 40, 60 60 T 120 60 M 0 100 Q 30 80, 60 100 T 120 100" fill="none" stroke="#ffffff" stroke-width="3"/>
                            <path d="M 20 0 Q 40 30, 20 60 T 20 120 M 60 0 Q 80 30, 60 60 T 60 120 M 100 0 Q 120 30, 100 60 T 100 120" fill="none" stroke="#ffffff" stroke-width="1.5"/>
                            <circle cx="60" cy="40" r="6" fill="none" stroke="#ffffff" stroke-width="2"/>
                            <circle cx="60" cy="80" r="6" fill="none" stroke="#ffffff" stroke-width="2"/>
                        </pattern>
                    </defs>
                    <rect width="100%" height="100%" fill="url(#dayak-pattern)" />
                </svg>
            </div>

            <div class="absolute -left-10 -top-10 w-40 h-40 bg-amber-400/20 rounded-full blur-2xl z-0"></div>

            <a href="/" class="absolute left-4 top-4 text-white hover:text-white/70 transition z-30">
                <svg class="w-6 h-6 stroke-[3]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </a>

            <div class="relative z-10 w-full flex flex-col items-center">
                <div class="w-full flex justify-center items-center mt-2 mb-1 md:mt-4 md:mb-6">
                    <img src="{{ asset('images/logo-kubar.png') }}" 
                         alt="Logo Diskominfo Kutai Barat" 
                         class="w-[200px] sm:w-[240px] md:w-[320px] h-auto object-contain block filter drop-shadow-[0_4px_8px_rgba(0,0,0,0.2)]">
                </div>

                <p class="text-white text-center font-bold text-xs sm:text-sm md:text-base tracking-wide mb-1 hidden sm:block drop-shadow-md max-w-sm mx-auto">
                    Log In to access your personalized dashboard.
                </p>
            </div>

            <div class="w-full mt-auto relative z-10 flex justify-center items-end px-0 pb-0 overflow-visible">
                <img src="{{ asset('images/login-team-illustration.jpeg') }}" 
                     alt="Team Puzzle Illustration" 
                     class="w-full md:w-[102%] h-auto object-contain block translate-y-[1px] md:translate-y-[6px] mix-blend-screen filter brightness-110 contrast-105 pointer-events-none">
            </div>
        </div>

        <div class="bg-white w-full h-[55%] md:h-full md:w-[55%] flex flex-col justify-between p-5 sm:p-8 md:p-12 z-20 overflow-y-auto">
            
            <div class="my-auto w-full max-w-md mx-auto flex flex-col gap-2.5 md:gap-4">
                
                <div class="text-left hidden md:block mb-2">
                    <h2 class="text-2xl font-black text-slate-850 tracking-tight">Selamat Datang</h2>
                    <p class="text-sm font-medium text-gray-400">Silakan masukkan akun verifikasi Anda</p>
                </div>
                
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-full text-xs font-bold text-center">
                        {{ session('success') }}
                    </div>
                @endif
                
                <form action="{{ route('login.process') }}" method="POST" class="flex flex-col gap-2.5 md:gap-4">
                    @csrf
                    
                    <div class="flex flex-col gap-1">
                        <label for="username" class="text-[#1A428A] font-extrabold text-[12px] md:text-[14px] tracking-wide pl-1">
                            Username :
                        </label>
                        <input type="text" id="username" name="username" placeholder="Masukkan Username"
                               class="w-full border border-gray-300 rounded-full py-2 px-4 md:py-2.5 md:px-5 text-gray-750 font-medium focus:outline-none focus:ring-2 focus:ring-[#2B6CB0]/50 transition text-xs md:text-sm bg-slate-50/50 shadow-inner">
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="email" class="text-[#1A428A] font-extrabold text-[12px] md:text-[14px] tracking-wide pl-1">
                            Email Address :
                        </label>
                        <input type="email" id="email" name="email" required value="{{ old('email') }}" placeholder="contoh@gmail.com"
                               class="w-full border border-gray-300 rounded-full py-2 px-4 md:py-2.5 md:px-5 text-gray-750 font-medium focus:outline-none focus:ring-2 focus:ring-[#2B6CB0]/50 transition text-xs md:text-sm bg-slate-50/50 shadow-inner">
                        @error('email')
                            <span class="text-red-500 text-[10px] md:text-xs pl-4 mt-0.5 block font-semibold">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex flex-col gap-1">
                        <label for="password" class="text-[#1A428A] font-extrabold text-[12px] md:text-[14px] tracking-wide pl-1">
                            Password :
                        </label>
                        <input type="password" id="password" name="password" required placeholder="••••••••"
                               class="w-full border border-gray-300 rounded-full py-2 px-4 md:py-2.5 md:px-5 text-gray-750 font-medium focus:outline-none focus:ring-2 focus:ring-[#2B6CB0]/50 transition text-xs md:text-sm bg-slate-50/50 shadow-inner">
                    </div>

                    <button type="submit" 
                            class="w-full bg-[#244E9E] hover:bg-[#1C3F82] text-white font-black text-center py-2.5 md:py-3.5 rounded-full transition shadow-[0_4px_12px_rgba(36,78,158,0.3)] active:scale-[0.98] text-sm md:text-base mt-1 tracking-wider">
                        Login
                    </button>
                </form>

                <div class="flex items-center justify-between mt-1.5 px-1 text-[11px] md:text-xs font-bold">
                    <p class="text-gray-400 font-semibold">
                        Don't Have an Account? 
                        <a href="{{ route('register') }}" class="text-[#2B6CB0] font-bold hover:underline transition pl-0.5">
                            Sign Up
                        </a>
                    </p>
                    <a href="{{ route('password.forgot') }}" class="text-gray-400 font-semibold hover:underline transition">
                        Forgot Password?
                    </a>
                </div>
            </div>

            <div class="w-full max-w-md mx-auto pt-3 md:pt-0">
                <div class="w-full bg-[#EBF4FF] text-[#2B6CB0] font-extrabold text-center py-2 rounded-full text-[10px] md:text-xs tracking-wide border border-[#D2E6FF] shadow-sm">
                    Your Information Is safe with us.
                </div>
            </div>

        </div>

    </div>

</body>
</html>