<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan & Coordination Center - Diskominfo Kubar</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
        }
        .ethnic-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 0), radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 0);
            background-size: 16px 16px;
            background-position: 0 0, 8px 8px;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="text-slate-800 antialiased bg-slate-100">

    <div class="flex h-screen overflow-hidden">
        
        <aside class="hidden md:flex w-72 bg-gradient-to-b from-[#1b4cc7] via-[#2563eb] to-[#1e40af] text-white flex-col justify-between p-6 shadow-xl relative overflow-hidden flex-shrink-0 z-20">
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
                    <a href="{{ url('/dashboard') }}" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-house text-white/60 w-5"></i> Home
                    </a>
                    <a href="{{ route('ketersediaan.index') }}" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-car-side text-white/60 w-5"></i> Ketersediaan Mobil
                    </a>
                    <a href="{{ route('pesan.index') }}" class="flex items-center gap-3 bg-[#0a1d37] text-white px-4 py-2.5 rounded-xl font-bold transition shadow-md border border-slate-800/20">
                        <i class="fa-solid fa-comments text-cyan-300 w-5"></i> Pesan
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
                    <a href="#" class="flex items-center gap-3 text-white/80 hover:bg-[#103bb3] hover:text-white px-4 py-2.5 rounded-xl font-bold transition">
                        <i class="fa-solid fa-gear text-white/60 w-5"></i> Pengaturan
                    </a>
                </nav>
            </div>

            <div class="border-t border-white/20 pt-4 space-y-3 z-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-[#05152b] border border-white/20 flex items-center justify-center text-white font-black uppercase">
                        {{ substr(Auth::user()->name ?? 'D', 0, 1) }}
                    </div>
                    <div class="overflow-hidden">
                        <h4 class="text-sm font-black truncate">{{ Auth::user()->name ?? 'Diskominfo Kubar' }}</h4>
                        <p class="text-[11px] text-blue-200 font-medium capitalize">{{ Auth::user()->role ?? 'Pegawai Internal' }}</p>
                    </div>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col md:flex-row h-full overflow-hidden bg-slate-100">
            
            <section id="contact-panel" class="w-full md:w-80 lg:w-96 bg-white border-r border-slate-200 flex-col h-full flex-shrink-0 z-10 {{ (isset($activeContact) || request('receiverId')) ? 'hidden md:flex' : 'flex' }}">
                
                <div class="p-4 border-b border-slate-100 flex items-center justify-between bg-white">
                    <div class="flex items-center gap-3">
                        <a href="{{ url('/dashboard') }}" class="md:hidden text-slate-600 hover:text-blue-600">
                            <i class="fa-solid fa-arrow-left text-lg"></i>
                        </a>
                        <h2 class="text-xl font-black text-slate-800 tracking-tight">Pesan</h2>
                    </div>
                    <span class="bg-blue-100 text-blue-600 text-xs font-bold px-2.5 py-1 rounded-full">
                        {{ count($contacts ?? []) }} Kontak
                    </span>
                </div>

                <div class="p-3 bg-slate-50 border-b border-slate-100">
                    <div class="relative">
                        <i class="fa-solid fa-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input type="text" placeholder="Cari kontak..." class="w-full pl-9 pr-4 py-2 bg-white rounded-xl text-xs font-medium text-slate-700 border border-slate-200 focus:outline-none focus:border-blue-500 shadow-sm">
                    </div>
                </div>

                <div class="flex-1 overflow-y-auto divide-y divide-slate-100 no-scrollbar">
                    @forelse($contacts ?? [] as $contact)
                        <a href="{{ route('pesan.index', ['receiverId' => $contact->id]) }}" 
                           class="flex items-center gap-3.5 p-3.5 hover:bg-slate-50 transition border-l-4 {{ (isset($activeContact) && $activeContact->id == $contact->id) ? 'bg-blue-50/60 border-blue-600' : 'border-transparent' }}">
                            <div class="relative flex-shrink-0">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-tr from-blue-600 to-indigo-600 text-white flex items-center justify-center font-black text-lg shadow-sm">
                                    {{ substr($contact->name, 0, 1) }}
                                </div>
                                <span class="absolute bottom-0 right-0 w-3.5 h-3.5 bg-emerald-500 border-2 border-white rounded-full"></span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex justify-between items-baseline mb-0.5">
                                    <h4 class="text-sm font-bold text-slate-800 truncate">{{ $contact->name }}</h4>
                                    <span class="text-[10px] text-slate-400 font-medium">12:30</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[9px] font-black uppercase px-1.5 py-0.2 bg-slate-100 text-slate-500 rounded border border-slate-200">
                                        {{ $contact->role ?? 'User' }}
                                    </span>
                                    <p class="text-xs text-slate-500 truncate font-normal">Klik untuk mulai ngobrol...</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="p-8 text-center text-slate-400">
                            <i class="fa-solid fa-comments text-4xl mb-3 text-slate-300"></i>
                            <p class="text-xs font-medium">Belum ada kontak tersedia.</p>
                        </div>
                    @endforelse
                </div>
            </section>

            <section id="chat-panel" class="w-full flex-1 bg-[#f8fafc] flex-col h-full {{ (isset($activeContact) || request('receiverId')) ? 'flex' : 'hidden md:flex' }}">
                @if(isset($activeContact))
                    <div class="p-3 px-4 bg-white border-b border-slate-200 flex items-center justify-between shadow-sm z-10">
                        <div class="flex items-center gap-3">
                            
                            <a href="{{ route('pesan.index') }}" class="md:hidden text-slate-600 hover:text-blue-600 p-2 -ml-2 rounded-lg active:bg-slate-100 transition">
                                <i class="fa-solid fa-arrow-left text-lg"></i>
                            </a>

                            <div class="relative">
                                <div class="w-10 h-10 rounded-full bg-blue-600 text-white flex items-center justify-center font-black text-base shadow-sm">
                                    {{ substr($activeContact->name, 0, 1) }}
                                </div>
                                <span class="absolute bottom-0 right-0 w-3 h-3 bg-emerald-500 border-2 border-white rounded-full"></span>
                            </div>
                            <div>
                                <h3 class="text-sm font-black text-slate-900 leading-tight">{{ $activeContact->name }}</h3>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[9px] font-bold text-blue-600 uppercase tracking-wide">{{ $activeContact->role ?? 'User' }}</span>
                                    <span class="text-[10px] text-emerald-600 font-medium">• Online</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-2 text-slate-400">
                            <button class="p-2 hover:text-blue-600 rounded-full transition"><i class="fa-solid fa-phone"></i></button>
                            <button class="p-2 hover:text-blue-600 rounded-full transition"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                        </div>
                    </div>

                    <div class="flex-1 overflow-y-auto p-4 md:p-6 space-y-4 no-scrollbar bg-slate-100/70">
                        <div class="flex justify-center my-2">
                            <span class="bg-white/80 border border-slate-200/60 text-slate-500 text-[10px] font-bold px-3 py-1 rounded-full shadow-2xs uppercase tracking-wider">Hari Ini</span>
                        </div>

                        @forelse($messages ?? [] as $msg)
                            @php 
                                $isSender = ($msg->sender_id == Auth::id()); 
                            @endphp
                            
                            <div class="flex items-end gap-2 {{ $isSender ? 'justify-end' : 'justify-start' }}">
                                @if(!$isSender)
                                    <div class="w-7 h-7 rounded-full bg-slate-300 text-slate-700 flex items-center justify-center font-bold text-xs flex-shrink-0">
                                        {{ substr($activeContact->name, 0, 1) }}
                                    </div>
                                @endif

                                <div class="max-w-[80%] md:max-w-[65%] p-3 px-4 rounded-2xl text-xs md:text-sm font-medium leading-relaxed shadow-sm relative group
                                            {{ $isSender 
                                                ? 'bg-blue-600 text-white rounded-br-xs' 
                                                : 'bg-white text-slate-800 border border-slate-200/80 rounded-bl-xs' }}">
                                    
                                    <p class="whitespace-pre-wrap break-words">{{ $msg->message ?? $msg->body }}</p>

                                    <div class="flex items-center justify-end gap-1 mt-1 text-[9px] {{ $isSender ? 'text-blue-200' : 'text-slate-400' }}">
                                        <span>{{ $msg->created_at ? $msg->created_at->format('H:i') : '00:00' }}</span>
                                        @if($isSender)
                                            <i class="fa-solid fa-check-double text-[10px] text-cyan-300"></i>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-12 text-slate-400">
                                <p class="text-xs">Belum ada obrolan. Mulai sapa kontak ini!</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="p-3 md:p-4 bg-white border-t border-slate-200 z-10">
                        <form action="{{ route('pesan.send') ?? '#' }}" method="POST" class="flex items-center gap-2">
                            @csrf
                            <input type="hidden" name="receiver_id" value="{{ $activeContact->id }}">
                            
                            <button type="button" class="text-slate-400 hover:text-blue-600 p-2 text-lg transition">
                                <i class="fa-solid fa-paperclip"></i>
                            </button>

                            <input type="text" name="message" required placeholder="Tulis pesan..." 
                                   class="flex-1 bg-slate-100 text-slate-800 text-xs md:text-sm px-4 py-3 rounded-full border border-transparent focus:bg-white focus:border-blue-500 focus:outline-none transition">

                            <button type="submit" 
                                    class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white w-10 h-10 md:w-11 md:h-11 rounded-full flex items-center justify-center shadow-md shadow-blue-500/20 transition flex-shrink-0">
                                <i class="fa-solid fa-paper-plane text-xs md:text-sm"></i>
                            </button>
                        </form>
                    </div>

                @else
                    <div class="flex-1 flex flex-col items-center justify-center p-8 text-center bg-slate-50">
                        <div class="w-20 h-20 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-3xl mb-4 shadow-inner">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <h3 class="text-lg font-black text-slate-800">Pesan & Coordination Center</h3>
                        <p class="text-xs text-slate-500 max-w-sm mt-1">Pilih salah satu kontak di sebelah kiri untuk memulai obrolan dengan tim operasional atau pengemudi.</p>
                    </div>
                @endif
            </section>

        </main>
    </div>

</body>
</html>