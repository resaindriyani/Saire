<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SiMagang Telkom')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { isolation: isolate; }
        .sidebar-link { transition: all 0.2s ease; }
        .sidebar-link:hover { background: rgba(255,255,255,0.08); }
        .sidebar-link.active { background: rgba(255,255,255,0.12); }
    </style>
</head>
<body class="bg-gray-100 font-sans text-gray-800 antialiased h-full">

<div class="flex h-screen overflow-hidden">
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black/50 z-40 hidden md:hidden"></div>
    <aside id="sidebar" class="w-64 flex flex-col flex-shrink-0 h-full overflow-y-auto z-50 fixed md:static inset-y-0 left-0 -translate-x-full md:translate-x-0 transition-transform duration-300" style="background: linear-gradient(180deg, #1a0000 0%, #7f0000 50%, #1a0000 100%);">
        <div class="px-6 py-5 border-b border-white/10">
            <a href="/" class="flex items-center gap-3">
                <img src="{{ asset('logo-simagang.png') }}" class="h-10">
                </a>
        </div>

        @auth
        <div class="px-6 py-5 border-b border-white/10">
            <div class="flex flex-col items-center text-center">
                @if(auth()->user()->role === 'pelamar')
                    @php $profilSidebar = auth()->user()->profilPelamar; @endphp
                    @if($profilSidebar && $profilSidebar->foto)
                        <img src="{{ asset('storage/' . $profilSidebar->foto) }}" class="w-16 h-16 rounded-full object-cover border-2 border-white/20 mb-3">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center mb-3 border-2 border-white/20">
                            <span class="text-xl font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                        </div>
                    @endif
                @else
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-gray-600 to-gray-800 flex items-center justify-center mb-3 border-2 border-white/20">
                        <span class="text-xl font-bold text-white">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
                    </div>
                @endif
                <p class="text-white font-bold text-sm">{{ auth()->user()->name }}</p>
                <p class="text-gray-400 text-xs mt-0.5">{{ auth()->user()->email }}</p>
                <span class="mt-2 px-2 py-0.5 rounded-full text-xs font-semibold {{ auth()->user()->role === 'admin' ? 'bg-red-500/20 text-red-400' : 'bg-blue-500/20 text-blue-400' }}">
                    {{ ucfirst(auth()->user()->role) }}
                </span>
            </div>
        </div>

        <nav class="flex-1 px-4 py-4 space-y-1">
            @if(auth()->user()->role === 'pelamar')
                <a href="{{ route('pelamar.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('pelamar.dashboard') ? 'active text-white' : '' }}">
                    <span class="text-lg">🏠</span> Dasbor
                </a>

                {{-- DIPERBAIKI: Menggunakan pelamar.pesan.index --}}
                <a href="{{ route('pelamar.pesan.index') }}" class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('pelamar.pesan.*') ? 'active text-white' : '' }}">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">✉️</span> Pesan
                    </div>
                    <span id="badge-pesan" class="hidden bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center leading-none"></span>
                </a>

                <a href="{{ route('pelamar.interview') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('pelamar.interview') ? 'active text-white' : '' }}">
                    <span class="text-lg">📅</span> Interview
                </a>
                <a href="{{ route('pelamar.logbook') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('pelamar.logbook') ? 'active text-white' : '' }}">
                    <span class="text-lg">📝</span> Logbook
                </a>
                <a href="{{ route('pelamar.sertifikat') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('pelamar.sertifikat') ? 'active text-white' : '' }}">
                    <span class="text-lg">🎓</span> Sertifikat
                </a>
                <a href="{{ route('testimoni') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('testimoni') ? 'active text-white' : '' }}">
                    <span class="text-lg">💬</span> Testimoni
                </a>
                <div class="pt-3 mt-3 border-t border-white/10">
                    <a href="{{ route('pelamar.profil') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('pelamar.profil') ? 'active text-white' : '' }}">
                        <span class="text-lg">👤</span> Profil
                    </a>
                </div>

            @elseif(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'active text-white' : '' }}">
                    <span class="text-lg">📊</span> Dasbor
                </a>
                <a href="{{ route('admin.pesan.index') }}" class="sidebar-link flex items-center justify-between px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('admin.pesan.*') ? 'active text-white' : '' }}">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">✉️</span> Pesan Masuk
                    </div>
                    <span id="badge-pesan" class="hidden bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full min-w-[18px] text-center leading-none"></span>
                </a>
                <a href="{{ route('admin.pelamar.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('admin.pelamar.*') ? 'active text-white' : '' }}">
                    <span class="text-lg">👥</span> Data Pelamar
                </a>
                <a href="{{ route('admin.lowongan.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('admin.lowongan.*') ? 'active text-white' : '' }}">
                    <span class="text-lg">📋</span> Lowongan
                </a>
                <a href="{{ route('admin.magang.aktif') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('admin.magang.aktif') ? 'active text-white' : '' }}">
                    <span class="text-lg">🟢</span> Magang Aktif
                </a>
                <a href="{{ route('admin.testimoni.index') }}" class="sidebar-link flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-300 hover:text-white {{ request()->routeIs('admin.testimoni.*') ? 'active text-white' : '' }}">
                    <span class="text-lg">💬</span> Testimoni
                </a>
            @endif
        </nav>

        <div class="px-4 py-4 border-t border-white/10">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 rounded-xl text-sm font-semibold text-gray-400 hover:text-red-400 hover:bg-red-500/10 transition">
                    <span class="text-lg">🚪</span> Keluar
                </button>
            </form>
        </div>
        @endauth
    </aside>

    <div class="flex-1 flex flex-col overflow-hidden">
        <header class="bg-white border-b border-gray-200 px-6 py-4 flex items-center justify-between flex-shrink-0">
            <div>
                <h1 class="text-lg font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs text-gray-400 mt-0.5">@yield('page-subtitle', 'Selamat datang di SiMagang Telkom')</p>
            </div>
            <button onclick="toggleSidebar()" class="md:hidden p-2 rounded-lg border border-gray-200 text-gray-600">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
        </header>
        <main class="flex-1 overflow-y-auto px-6 py-4">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-4 text-sm font-medium">
                    ✅ {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-4 text-sm font-medium">
                    ❌ {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('-translate-x-full');
    }

    function cekNotifPesan() {
        fetch('/notif/pesan')
            .then(res => res.json())
            .then(data => {
                const badge = document.getElementById('badge-pesan');
                if (badge) {
                    if (data.count > 0) {
                        badge.textContent = data.count;
                        badge.classList.remove('hidden');
                    } else {
                        badge.classList.add('hidden');
                    }
                }
            })
            .catch(() => {});
    }

    cekNotifPesan();
    setInterval(cekNotifPesan, 10000);
</script>
</body>
</html>
