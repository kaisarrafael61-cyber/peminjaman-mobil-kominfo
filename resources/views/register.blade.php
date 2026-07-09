<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Diskominfo Kutai Barat</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 font-sans antialiased min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md bg-white rounded-[2rem] shadow-2xl p-8 border border-gray-100">
        <div class="text-center mb-6">
            <h3 class="text-2xl font-bold text-gray-800">Daftar Akun Baru</h3>
            <p class="text-sm text-gray-400 mt-1">Lengkapi data di bawah untuk mendaftar</p>
        </div>

        <form action="/register" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-[#1A365D] font-bold text-sm pl-2 mb-1">Username</label>
                <input type="text" name="username" required class="w-full px-5 py-3 border-2 border-blue-100 rounded-full focus:outline-none focus:border-[#1A365D] text-sm text-gray-700">
            </div>

            <div>
                <label class="block text-[#1A365D] font-bold text-sm pl-2 mb-1">Email Address</label>
                <input type="email" name="email" required class="w-full px-5 py-3 border-2 border-blue-100 rounded-full focus:outline-none focus:border-[#1A365D] text-sm text-gray-700">
            </div>

            <div>
                <label class="block text-[#1A365D] font-bold text-sm pl-2 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-5 py-3 border-2 border-blue-100 rounded-full focus:outline-none focus:border-[#1A365D] text-sm text-gray-700">
            </div>

            <div class="pt-2">
                <button type="submit" class="w-full bg-[#1e4693] hover:bg-[#15326b] text-white font-bold py-3.5 rounded-full text-base transition-all shadow-md cursor-pointer">
                    Sign Up
                </button>
            </div>
        </form>

        <div class="text-center text-xs font-semibold mt-4 text-gray-400">
            Sudah punya akun? <a href="/login-page" class="text-[#1e4693] hover:underline">Log In disini</a>
        </div>
    </div>
</body>
</html>