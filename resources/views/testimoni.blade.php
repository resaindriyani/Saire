<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testimoni - SiMagang Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <x-navbar />

    <header class="bg-gradient-to-br from-gray-900 via-slate-800 to-red-950 text-white py-16 px-6 text-center">
        <h1 class="text-3xl md:text-4xl font-extrabold">Testimoni Alumni 💬</h1>
        <p class="text-gray-300 mt-3 text-base">Cerita nyata dari peserta magang Telkom Sukabumi</p>
    </header>

    <main class="max-w-5xl mx-auto px-4 py-12">

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

        @auth
            @if(auth()->user()->role === 'pelamar')
                @php
                    $lamaran = auth()->user()->lamarans()->latest()->first();
                    $sudahKirim = \App\Models\Testimoni::where('user_id', auth()->id())->exists();
                @endphp
                @if($lamaran && $lamaran->status === 'selesai' && !$sudahKirim)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">✍️ Bagikan Pengalamanmu</h2>
                        <form action="{{ route('testimoni.store') }}" method="POST">
                            @csrf
                            <textarea name="pesan" rows="4"
                                placeholder="Ceritakan pengalaman magangmu di Telkom Sukabumi..."
                                class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 resize-none mb-4">{{ old('pesan') }}</textarea>
                            @error('pesan')
                                <p class="text-red-500 text-xs mb-3">{{ $message }}</p>
                            @enderror
                            <button type="submit"
                                class="px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                                Kirim Testimoni
                            </button>
                        </form>
                    </div>
                @elseif($sudahKirim)
                    <div class="bg-blue-50 border border-blue-200 text-blue-700 p-4 rounded-xl mb-6 text-sm font-medium">
                        ℹ️ Kamu sudah mengirim testimoni. Menunggu persetujuan admin.
                    </div>
                @endif
            @endif
        @endauth

        @if($testimonis->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($testimonis as $testimoni)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                                <span class="text-sm font-bold text-white">{{ strtoupper(substr($testimoni->user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="font-bold text-gray-800 text-sm">{{ $testimoni->user->name }}</p>
                                <p class="text-xs text-gray-400">{{ $testimoni->created_at->format('d M Y') }}</p>
                            </div>
                            <div class="ml-auto text-2xl">⭐</div>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed">"{{ $testimoni->pesan }}"</p>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="text-6xl mb-4">💬</div>
                <h2 class="text-xl font-bold text-gray-700">Belum Ada Testimoni</h2>
                <p class="text-sm text-gray-400 mt-2">Jadilah yang pertama berbagi pengalaman!</p>
            </div>
        @endif

    </main>

    <footer class="bg-gray-100 py-8 border-t border-gray-200 text-center text-sm text-gray-500">
        <p>&copy; 2026 PT Telkom Indonesia Witel Sukabumi. All Rights Reserved.</p>
    </footer>

</body>
</html>
