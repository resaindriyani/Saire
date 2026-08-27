<nav class="bg-white/90 backdrop-blur-md border-b border-gray-200 shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('logo-simagang.png') }}"
                alt="Logo Telkom" class="h-9 p-1 bg-white rounded-lg shadow-sm border border-gray-200">
            <span class="font-bold text-lg tracking-tight text-gray-900">SiMagang <span class="text-red-600">Telkom</span></span>
        </div>

        <div class="hidden md:flex items-center space-x-6">
            <a href="/" class="font-semibold text-sm transition-colors {{ request()->is('/') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">Beranda</a>
            <a href="/tentang" class="font-semibold text-sm transition-colors {{ request()->is('tentang') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">Tentang</a>
            <a href="/lowongan" class="font-semibold text-sm transition-colors {{ request()->is('lowongan') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">Lowongan</a>
            <a href="/testimoni" class="font-semibold text-sm transition-colors {{ request()->is('testimoni') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">Testimoni</a>
            <a href="/kontak" class="font-semibold text-sm transition-colors {{ request()->is('kontak') ? 'text-red-600' : 'text-gray-700 hover:text-red-600' }}">Kontak</a>

            <div class="flex items-center space-x-3 border-l pl-6 border-gray-200">
                @guest
                    <a href="{{ route('login') }}" class="text-red-600 font-bold text-sm hover:text-red-700">Masuk Akun</a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm shadow-md transition-all">Daftar Magang</a>
                @endguest
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-900 font-bold text-sm">Dashboard Admin</a>
                    @else
                        <a href="{{ route('pelamar.dashboard') }}" class="text-gray-900 font-bold text-sm">Dashboard</a>
                    @endif
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 font-bold text-sm hover:underline">Keluar</button>
                    </form>
                @endauth
            </div>
        </div>

        <button onclick="toggleNav()" class="md:hidden p-2 rounded-lg text-gray-600">
            <svg id="icon-open" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
            <svg id="icon-close" class="w-6 h-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <div id="mobile-nav" class="hidden md:hidden border-t border-gray-100 bg-white px-4 py-4 space-y-2">
        <a href="/" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('/') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-gray-50' }}">Beranda</a>
        <a href="/tentang" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('tentang') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-gray-50' }}">Tentang</a>
        <a href="/lowongan" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('lowongan') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-gray-50' }}">Lowongan</a>
        <a href="/testimoni" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('testimoni') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-gray-50' }}">Testimoni</a>
        <a href="/kontak" class="block px-4 py-3 rounded-xl text-sm font-semibold {{ request()->is('kontak') ? 'text-red-600 bg-red-50' : 'text-gray-700 hover:bg-gray-50' }}">Kontak</a>
        <div class="pt-2 border-t border-gray-100 space-y-2">
            @guest
                <a href="{{ route('login') }}" class="block text-center px-4 py-3 rounded-xl text-sm font-bold text-red-600 border border-red-600">Masuk Akun</a>
                <a href="{{ route('register') }}" class="block text-center px-4 py-3 rounded-xl text-sm font-bold text-white bg-red-600">Daftar Magang</a>
            @endguest
        </div>
    </div>
</nav>

<script>
    function toggleNav() {
        const nav = document.getElementById('mobile-nav');
        const iconOpen = document.getElementById('icon-open');
        const iconClose = document.getElementById('icon-close');
        nav.classList.toggle('hidden');
        iconOpen.classList.toggle('hidden');
        iconClose.classList.toggle('hidden');
    }
</script>
