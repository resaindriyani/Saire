<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lowongan Magang - SiMagang Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <x-navbar />

    <header class="bg-gradient-to-br from-gray-900 via-slate-800 to-red-950 text-white py-16 px-6 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold">Lowongan Magang 📋</h1>
        <p class="text-gray-300 mt-3 text-base">Temukan kesempatan magang terbaik di PT Telkom Indonesia Witel Sukabumi</p>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-12">
        @if($lowongans->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($lowongans as $lowongan)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md transition">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-2xl">💼</div>
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Buka</span>
                        </div>
                        <h2 class="text-lg font-bold text-gray-900 mb-2">{{ $lowongan->judul }}</h2>
                        <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-3">{{ $lowongan->deskripsi }}</p>
                        <div class="flex items-center gap-4 text-xs text-gray-400 mb-5">
                            <span>👥 {{ $lowongan->kuota }} orang</span>
                            <span>📅 Tutup {{ $lowongan->tgl_tutup->format('d M Y') }}</span>
                        </div>
                        @guest
                            <a href="{{ route('register') }}"
                                class="block text-center w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                                Daftar Sekarang
                            </a>
                        @endguest
                        @auth
                            @if(auth()->user()->role === 'pelamar')
                                <a href="{{ route('pelamar.form') }}"
                                    class="block text-center w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                                    Lamar Sekarang
                                </a>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-6xl mb-4">📭</div>
                <h2 class="text-xl font-bold text-gray-700">Belum Ada Lowongan</h2>
                <p class="text-sm text-gray-400 mt-2">Saat ini belum ada lowongan yang tersedia. Cek kembali nanti!</p>
                <a href="/" class="inline-block mt-6 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                    Kembali ke Beranda
                </a>
            </div>
        @endif
    </main>

    <footer class="bg-gray-100 py-8 border-t border-gray-200 text-center text-sm text-gray-500">
        <p>&copy; 2026 PT Telkom Indonesia Witel Sukabumi. All Rights Reserved.</p>
    </footer>

</body>
</html>
