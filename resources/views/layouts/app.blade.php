<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiMagang Telkom')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { isolation: isolate; }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased h-full">

    <nav class="bg-white sticky top-0 border-b border-gray-200 shadow-sm w-full z-[60]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
            
            <a href="/" class="flex items-center space-x-3">
                <img src="{{ asset('logo-simagang.png') }}"
                    alt="Logo Telkom" class="h-10">
                </a>

            <div class="hidden md:flex items-center space-x-6">
                @auth
                    @if(auth()->user()->role === 'pelamar')
                        <a href="{{ route('pelamar.dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600 transition">Dasbor</a>
                        <a href="{{ route('pelamar.interview') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600 transition">Interview</a>
                        <a href="{{ route('pelamar.logbook') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600 transition">Logbook</a>
                        <a href="{{ route('pelamar.sertifikat') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600 transition">Sertifikat</a>
                        <a href="{{ route('pelamar.profil') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600 transition">Profil</a>
                        {{-- Menu Pesan dengan badge notif --}}
                        <a href="{{ route('pelamar.pesan') }}" class="relative flex items-center text-sm font-semibold text-gray-700 hover:text-red-600 transition">
                            Pesan
                            <span id="badge-pesan" class="hidden absolute -top-2 -right-4 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center"></span>
                        </a>
                    @elseif(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600 transition">Dasbor</a>
                        <a href="{{ route('admin.pelamar.index') }}" class="text-sm font-semibold text-gray-700 hover:text-red-600 transition">Data Pelamar</a>
                        {{-- Menu Pesan Admin dengan badge notif --}}
                        <a href="{{ route('admin.pesan.index') }}" class="relative flex items-center text-sm font-semibold text-gray-700 hover:text-red-600 transition">
                            Pesan Masuk
                            <span id="badge-pesan" class="hidden absolute -top-2 -right-4 bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center"></span>
                        </a>
                    @endif
                    
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 text-red-600 border border-red-600 hover:bg-red-600 hover:text-white font-bold rounded-xl text-sm transition-all duration-200">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-4 py-2 text-red-600 hover:text-white border border-red-600 hover:bg-red-600 font-bold rounded-xl text-sm transition-all duration-200">Masuk</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm shadow-md transition-all duration-200">Daftar</a>
                @endauth
            </div>

            <button onclick="toggleNav()" type="button" class="md:hidden p-2 rounded-lg border border-gray-200 text-gray-600 hover:text-red-600 transition">
                <svg id="icon-open" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg id="icon-close" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-nav" class="hidden md:hidden border-t border-gray-100 bg-white px-4 py-4 space-y-1">
            @auth
                @if(auth()->user()->role === 'pelamar')
                    <a href="{{ route('pelamar.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">Dasbor</a>
                    <a href="{{ route('pelamar.interview') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">Interview</a>
                    <a href="{{ route('pelamar.logbook') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">Logbook</a>
                    <a href="{{ route('pelamar.sertifikat') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">Sertifikat</a>
                    <a href="{{ route('pelamar.profil') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">Profil</a>
                    <a href="{{ route('pelamar.pesan') }}" class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">
                        Pesan
                        <span id="badge-pesan-mobile" class="hidden bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center"></span>
                    </a>
                @elseif(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">Dasbor</a>
                    <a href="{{ route('admin.pelamar.index') }}" class="block px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">Data Pelamar</a>
                    <a href="{{ route('admin.pesan.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl text-sm font-semibold text-gray-700 hover:bg-red-50">
                        Pesan Masuk
                        <span id="badge-pesan-mobile" class="hidden bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center"></span>
                    </a>
                @endif
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-3 text-red-600 font-semibold">Keluar</button>
                </form>
            @endauth
        </div>
    </nav>

    <main class="max-w-5xl mx-auto px-4 py-8 relative z-10">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium">
                ✅ {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm font-medium">
                ❌ {{ session('error') }}
            </div>
        @endif
        @yield('content')
    </main>

    <script>
        function toggleNav() {
            const nav = document.getElementById('mobile-nav');
            const iconOpen = document.getElementById('icon-open');
            const iconClose = document.getElementById('icon-close');
            nav.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        }

        // Polling notifikasi pesan setiap 10 detik
        function cekNotifPesan() {
            fetch('/notif/pesan')
                .then(res => res.json())
                .then(data => {
                    const badge = document.getElementById('badge-pesan');
                    const badgeMobile = document.getElementById('badge-pesan-mobile');
                    
                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count;
                            badge.classList.remove('hidden');
                        }
                        if (badgeMobile) {
                            badgeMobile.textContent = data.count;
                            badgeMobile.classList.remove('hidden');
                        }
                    } else {
                        if (badge) badge.classList.add('hidden');
                        if (badgeMobile) badgeMobile.classList.add('hidden');
                    }
                })
                .catch(() => {});
        }

        @auth
        cekNotifPesan();
        setInterval(cekNotifPesan, 10000);
        @endauth
    </script>
</body>
</html>
