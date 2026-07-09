<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Login - Diskominfo Kutai Barat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            overflow: hidden; /* Mengunci scroll pada body utama */
        }
    </style>
</head>
<body class="bg-slate-100 h-[100dvh] w-screen flex items-center justify-center p-0 sm:p-6 md:p-8">

    <div class="bg-white md:rounded-3xl shadow-2xl flex flex-col md:flex-row w-full h-full md:h-auto md:max-w-5xl overflow-hidden md:min-h-[600px]">
        
        <div class="w-full md:w-1/2 bg-[#2B6CB0] p-6 md:p-12 flex flex-col justify-between relative text-white h-[25dvh] md:h-auto">
            
            <div class="absolute top-4 left-4 md:top-6 md:left-6 text-white/70 hover:text-white cursor-pointer transition">
                <i class="fa-solid fa-xmark text-lg md:text-xl"></i>
            </div>

            <div class="mt-4 md:mt-4 flex flex-row md:flex-col items-center md:items-start justify-between md:justify-start gap-4">
                <div class="bg-white/10 backdrop-blur-md border border-white/20 px-3 py-1.5 md:px-4 md:py-2 rounded-full flex items-center gap-2 text-[10px] md:text-xs font-medium tracking-wide">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <i class="fa-solid fa-cloud text-sky-300"></i> DISKOMINFO KUTAI BARAT
                </div>
                
                <h1 class="hidden md:block text-2xl md:text-4xl font-bold leading-tight mt-2">
                    Log In to access your personalized dashboard.
                </h1>
                <p class="hidden md:block text-white/80 text-xs md:text-sm font-light max-w-sm mt-1">
                    Kelola berkas, monitoring peminjaman kendaraan dinas, dan pantau status pengajuan dalam satu platform terintegrasi.
                </p>
            </div>

            <div class="hidden md:flex my-8 justify-center items-center w-full relative">
                <div class="w-full h-44 bg-white/5 border border-white/10 rounded-2xl flex flex-col justify-center items-center p-4 text-center group hover:bg-white/10 transition duration-300">
                    <div class="flex justify-center items-center gap-4 text-white/20 mb-2 relative">
                        <i class="fa-solid fa-people-holding text-6xl text-blue-200/40 transition group-hover:scale-105 duration-300"></i>
                        <i class="fa-solid fa-puzzle-piece text-4xl text-amber-300/60 absolute -top-4 animate-bounce"></i>
                    </div>
                    <span class="text-xs text-blue-100/60 font-mono">[ Komponen Ilustrasi Canva Berhasil Terintegrasi ]</span>
                </div>
            </div>

            <div class="hidden md:flex justify-center md:justify-start items-center gap-6 text-white/40 text-xl mt-auto pt-4 border-t border-white/10">
                <i class="fa-solid fa-desktop hover:text-white transition cursor-pointer" title="Desktop Version"></i>
                <i class="fa-solid fa-puzzle-piece hover:text-white transition cursor-pointer" title="Modules Linked"></i>
                <i class="fa-solid fa-mobile-screen-button hover:text-white transition cursor-pointer" title="Mobile Friendly"></i>
            </div>
        </div>

        <div class="w-full md:w-1/2 p-6 md:p-12 flex flex-col justify-center bg-white h-[75dvh] md:h-auto overflow-y-auto">
            
            <div class="mb-4 md:mb-8">
                <h2 class="text-xl md:text-3xl font-bold text-slate-800">Selamat Datang</h2>
                <p class="text-slate-400 text-xs md:text-sm mt-0.5">Silakan masukkan akun verifikasi Anda</p>
            </div>

            <form action="{{ url('/login-process') }}" method="POST" class="space-y-3 md:space-y-5">
                @csrf
                
                <div class="space-y-1 md:space-y-1.5">
                    <label for="username" class="text-xs md:text-sm font-semibold text-slate-700 block">Username :</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 md:pl-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-user text-[11px] md:text-xs"></i>
                        </div>
                        <input type="text" id="username" name="username" placeholder="Masukkan username Anda" required
                            class="w-full pl-9 md:pl-10 pr-4 py-2 md:py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-xs md:text-sm text-slate-700 bg-slate-50/50">
                    </div>
                </div>

                <div class="space-y-1 md:space-y-1.5">
                    <label for="email" class="text-xs md:text-sm font-semibold text-slate-700 block">Email Address :</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 md:pl-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-envelope text-[11px] md:text-xs"></i>
                        </div>
                        <input type="email" id="email" name="email" placeholder="contoh@gmail.com" required
                            class="w-full pl-9 md:pl-10 pr-4 py-2 md:py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-xs md:text-sm text-slate-700 bg-slate-50/50">
                    </div>
                </div>

                <div class="space-y-1 md:space-y-1.5">
                    <label for="password" class="text-xs md:text-sm font-semibold text-slate-700 block">Password :</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 md:pl-4 flex items-center pointer-events-none text-slate-400">
                            <i class="fa-solid fa-lock text-[11px] md:text-xs"></i>
                        </div>
                        <input type="password" id="password" name="password" placeholder="••••••••" required
                            class="w-full pl-9 md:pl-10 pr-10 md:pr-12 py-2 md:py-3 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition text-xs md:text-sm text-slate-700 bg-slate-50/50">
                        <div class="absolute inset-y-0 right-0 pr-3 md:pr-4 flex items-center cursor-pointer text-slate-400 hover:text-slate-600">
                            <i class="fa-solid fa-eye-slash text-[11px] md:text-xs"></i>
                        </div>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full bg-[#1E40AF] hover:bg-blue-800 text-white font-medium py-2.5 md:py-3 rounded-xl transition duration-200 transform active:scale-[0.98] shadow-md shadow-blue-700/20 text-xs md:text-sm tracking-wide mt-2">
                    Login
                </button>
            </form>

            <div class="mt-4 pt-4 md:mt-6 md:pt-5 border-t border-slate-100 flex items-center justify-between text-[11px] md:text-xs font-medium">
                <span class="text-slate-400">Don't Have an Account? <a href="#" class="text-blue-600 hover:underline">Sign Up</a></span>
                <a href="#" class="text-slate-400 hover:text-blue-600 transition">Forgot Password?</a>
            </div>

            <div class="mt-4 md:mt-8 bg-blue-50/70 border border-blue-100/50 rounded-xl p-2.5 md:p-3 text-center flex items-center justify-center gap-2 text-[10px] md:text-xs font-medium text-blue-700">
                <i class="fa-solid fa-shield-halved text-blue-500"></i>
                Your Information is safe with us.
            </div>

        </div>
    </div>

</body>
</html>