@extends('layouts.app')

@section('content')
<div class="mb-6 md:mb-8">
    <h1 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight">Pengaturan Akun</h1>
    <p class="text-sm text-slate-500 mt-1">Kelola data diri, keamanan, dan preferensi akun Anda di sini.</p>
</div>

<div class="flex flex-col md:flex-row gap-6">
    
    <div class="w-full md:w-1/3 lg:w-1/4">
        <div class="bg-white p-3 rounded-2xl shadow-sm border border-slate-100 flex flex-col gap-1">
            <button onclick="switchTab('profil')" id="btn-profil" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm bg-blue-50 text-blue-600 transition">
                <i class="fa-solid fa-user-pen w-5 text-center"></i> Profil Akun
            </button>
            <button onclick="switchTab('keamanan')" id="btn-keamanan" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">
                <i class="fa-solid fa-lock w-5 text-center"></i> Keamanan
            </button>
            <hr class="border-slate-100 my-2">
            <button onclick="switchTab('bantuan')" id="btn-bantuan" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl font-bold text-sm text-slate-600 hover:bg-slate-50 hover:text-blue-600 transition">
                <i class="fa-solid fa-circle-info w-5 text-center"></i> Bantuan & Info
            </button>
        </div>
    </div>

    <div class="w-full md:w-2/3 lg:w-3/4">
        
        {{-- TAB 1: PROFIL AKUN --}}
        <div id="tab-profil" class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 block">
            <div class="border-b border-slate-100 pb-4 mb-6">
                <h3 class="font-bold text-lg text-slate-800">Informasi Pribadi</h3>
                <p class="text-xs text-slate-500 mt-1">Pastikan data kontak aktif agar mudah dihubungi saat peminjaman mobil.</p>
            </div>
            
            <form action="#" method="POST" class="space-y-5">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 focus:border-blue-600 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Username / NIP</label>
                        <input type="text" name="username" value="{{ Auth::user()->username ?? '' }}" class="w-full bg-slate-100 border border-slate-200 text-slate-500 rounded-xl px-4 py-3 text-sm cursor-not-allowed" readonly title="Username tidak dapat diubah">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Bidang / Jabatan</label>
                        <input type="text" name="jabatan" placeholder="Contoh: Bidang E-Government" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 outline-none transition">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">No. WhatsApp</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-400">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </div>
                            <input type="tel" name="no_wa" placeholder="081234567890" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl pl-11 pr-4 py-3 text-sm focus:ring-2 focus:ring-green-500 focus:border-green-500 outline-none transition">
                        </div>
                    </div>
                </div>
                
                <div class="pt-4 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-xl text-sm transition shadow-md shadow-blue-500/30">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        {{-- TAB 2: KEAMANAN (GANTI PASSWORD) --}}
        <div id="tab-keamanan" class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 hidden">
            <div class="border-b border-slate-100 pb-4 mb-6">
                <h3 class="font-bold text-lg text-slate-800">Keamanan Akun</h3>
                <p class="text-xs text-slate-500 mt-1">Perbarui kata sandi Anda secara berkala untuk menjaga keamanan akun.</p>
            </div>
            
            <form action="#" method="POST" class="space-y-5 max-w-lg">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Password Lama</label>
                    <input type="password" name="old_password" placeholder="Masukkan password saat ini" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Password Baru</label>
                    <input type="password" name="new_password" placeholder="Minimal 8 karakter" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 outline-none transition">
                </div>
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wide mb-2">Konfirmasi Password Baru</label>
                    <input type="password" name="new_password_confirmation" placeholder="Ulangi password baru" class="w-full bg-slate-50 border border-slate-200 text-slate-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-blue-600 outline-none transition">
                </div>
                
                <div class="pt-4">
                    <button type="submit" class="bg-slate-800 hover:bg-black text-white font-bold py-3 px-6 rounded-xl text-sm transition shadow-md shadow-slate-900/20">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        {{-- TAB 3: BANTUAN & INFO --}}
        <div id="tab-bantuan" class="bg-white p-6 md:p-8 rounded-2xl shadow-sm border border-slate-100 hidden">
            <div class="border-b border-slate-100 pb-4 mb-6">
                <h3 class="font-bold text-lg text-slate-800">Pusat Bantuan Mobi-Kubar</h3>
                <p class="text-xs text-slate-500 mt-1">Informasi sistem dan kontak administrator.</p>
            </div>
            
            <div class="flex items-center gap-4 p-4 bg-blue-50 border border-blue-100 rounded-xl mb-6">
                <div class="w-12 h-12 bg-blue-600 text-white rounded-full flex items-center justify-center text-xl shrink-0 shadow-md">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <div>
                    <h4 class="font-black text-sm text-slate-800">Butuh Bantuan Teknis?</h4>
                    <p class="text-xs text-slate-600 mt-0.5">Hubungi Admin IT Diskominfo jika Anda kesulitan memesan mobil atau mereset akun.</p>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 border border-slate-200 rounded-xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Versi Aplikasi</p>
                    <p class="text-sm font-semibold text-slate-700">Mobi-Kubar v1.0 (Beta)</p>
                </div>
                <div class="p-4 border border-slate-200 rounded-xl">
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Pengembang</p>
                    <p class="text-sm font-semibold text-slate-700">Tim PKL Diskominfo 2026</p>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
<script>
    function switchTab(tabName) {
        // 1. Sembunyikan semua konten tab
        document.getElementById('tab-profil').classList.add('hidden');
        document.getElementById('tab-keamanan').classList.add('hidden');
        document.getElementById('tab-bantuan').classList.add('hidden');
        
        // 2. Reset style semua tombol menu
        let buttons = ['btn-profil', 'btn-keamanan', 'btn-bantuan'];
        buttons.forEach(id => {
            let btn = document.getElementById(id);
            btn.classList.remove('bg-blue-50', 'text-blue-600');
            btn.classList.add('text-slate-600');
        });

        // 3. Tampilkan tab yang dipilih
        document.getElementById('tab-' + tabName).classList.remove('hidden');
        
        // 4. Ubah warna tombol yang aktif
        let activeBtn = document.getElementById('btn-' + tabName);
        activeBtn.classList.remove('text-slate-600');
        activeBtn.classList.add('bg-blue-50', 'text-blue-600');
    }
</script>
@endpush