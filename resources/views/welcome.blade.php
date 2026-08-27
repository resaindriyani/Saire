<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Magang - PT Telkom Sukabumi</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .fade-up { animation: fadeUp 0.7s ease forwards; }
        .fade-up-delay-1 { animation: fadeUp 0.7s ease 0.1s forwards; opacity: 0; }
        .fade-up-delay-2 { animation: fadeUp 0.7s ease 0.2s forwards; opacity: 0; }
        .fade-up-delay-3 { animation: fadeUp 0.7s ease 0.3s forwards; opacity: 0; }
        .reveal { opacity: 0; transform: translateY(40px); transition: all 0.7s ease; }
        .reveal.visible { opacity: 1; transform: translateY(0); }
    </style>
</head>
<body class="bg-gray-50 font-sans text-gray-800 antialiased">

    <x-navbar />

    {{-- HERO --}}
    <header class="relative bg-gradient-to-br from-gray-900 via-slate-800 to-red-950 text-white py-20 md:py-28 px-6 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-red-600/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-72 h-72 bg-red-800/20 rounded-full blur-3xl"></div>
        <div class="max-w-7xl mx-auto relative z-10 flex flex-col md:flex-row items-center justify-between gap-12">
            <div class="max-w-2xl text-center md:text-left">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-red-200 mb-4 border border-white/10 fade-up">🚀 Witel Sukabumi Digital Hub</span>
                <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold tracking-tight leading-tight fade-up-delay-1">
                    Mulai Karir Digitalmu Bersama
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-400 to-amber-300">PT Telkom Indonesia</span>
                </h1>
                <p class="mt-4 text-base sm:text-lg text-gray-300 leading-relaxed fade-up-delay-2">Kembangkan potensi, asah keterampilan teknis, dan rasakan pengalaman kerja nyata di industri telekomunikasi terbesar Indonesia.</p>
                <div class="mt-8 flex flex-col sm:flex-row justify-center md:justify-start gap-4 fade-up-delay-3">
                    <a href="/lowongan" class="w-full sm:w-auto text-center px-8 py-4 bg-red-600 hover:bg-red-700 font-bold rounded-xl shadow-lg transition-all duration-200">Lihat Lowongan</a>
                    <a href="#tentang" class="w-full sm:w-auto text-center px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/20 font-bold rounded-xl transition-all duration-200">Pelajari Selengkapnya</a>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center fade-up-delay-2">
                <div class="relative w-56 h-56 sm:w-72 sm:h-72 md:w-80 md:h-80 bg-gradient-to-tr from-red-600 to-red-400 rounded-3xl opacity-90 shadow-2xl flex items-center justify-center transform rotate-3 hover:rotate-0 transition-transform duration-500">
                    <img src="{{ asset('logo-simagang.png') }}" class="w-32 sm:w-48 bg-white p-4 sm:p-6 rounded-2xl shadow-xl">
                </div>
            </div>
        </div>
    </header>

    {{-- COUNTER --}}
    <section class="py-12 px-6 bg-white border-b border-gray-100">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-3 gap-6 text-center">
                <div class="reveal">
                    <p class="text-4xl font-extrabold text-red-600 counter" data-target="{{ $totalAlumni }}">0</p>
                    <p class="text-sm text-gray-500 mt-1 font-semibold">Alumni Magang</p>
                </div>
                <div class="reveal">
                    <p class="text-4xl font-extrabold text-green-600 counter" data-target="{{ $pesertaAktif }}">0</p>
                    <p class="text-sm text-gray-500 mt-1 font-semibold">Peserta Aktif</p>
                </div>
                <div class="reveal">
                    <p class="text-4xl font-extrabold text-blue-600 counter" data-target="{{ $totalPendaftar }}">0</p>
                    <p class="text-sm text-gray-500 mt-1 font-semibold">Total Pendaftar</p>
                </div>
            </div>
        </div>
    </section>

    {{-- KENAPA TELKOM --}}
    <section id="tentang" class="py-16 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl font-extrabold text-gray-900">Kenapa Magang di Telkom? 🚀</h2>
                <p class="text-gray-500 mt-3 text-base">Dapatkan pengalaman nyata di perusahaan telekomunikasi terbesar Indonesia</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 reveal">
                    <div class="text-5xl mb-4">💡</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Pengalaman Nyata</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Terlibat langsung dalam proyek-proyek teknologi skala nasional bersama para profesional berpengalaman.</p>
                </div>
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 reveal">
                    <div class="text-5xl mb-4">🎓</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Sertifikat Resmi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Dapatkan sertifikat magang resmi dari PT Telkom Indonesia yang diakui di dunia industri.</p>
                </div>
                <div class="text-center p-6 bg-white rounded-2xl shadow-sm border border-gray-100 reveal">
                    <div class="text-5xl mb-4">🤝</div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Networking Luas</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Bangun koneksi profesional dengan para engineer, manajer, dan eksekutif Telkom Indonesia.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- LOWONGAN AKTIF --}}
    <section class="py-16 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-10 reveal">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">Lowongan Tersedia 📋</h2>
                    <p class="text-gray-500 mt-2 text-base">Posisi magang yang sedang dibuka</p>
                </div>
                <a href="/lowongan" class="text-sm font-bold text-red-600 hover:underline">Lihat Semua →</a>
            </div>
            @if($lowongans->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($lowongans as $lowongan)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-200 reveal">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-2xl">💼</div>
                                <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Buka</span>
                            </div>
                            <h3 class="text-base font-bold text-gray-900 mb-2">{{ $lowongan->judul }}</h3>
                            <p class="text-sm text-gray-500 leading-relaxed mb-4 line-clamp-2">{{ $lowongan->deskripsi }}</p>
                            <div class="flex items-center gap-3 text-xs text-gray-400 mb-4">
                                <span>👥 {{ $lowongan->kuota }} orang</span>
                                <span>📅 Tutup {{ $lowongan->tgl_tutup->format('d M Y') }}</span>
                            </div>
                            <a href="{{ route('register') }}"
                                class="block text-center w-full px-4 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                                Daftar Sekarang
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-gray-50 rounded-2xl reveal">
                    <div class="text-4xl mb-3">📭</div>
                    <p class="text-gray-500 text-sm">Belum ada lowongan yang tersedia saat ini.</p>
                </div>
            @endif
        </div>
    </section>

    {{-- ALUR PENDAFTARAN --}}
    <section class="py-16 px-6 bg-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-12 reveal">
                <h2 class="text-3xl font-extrabold text-gray-900">Alur Pendaftaran 📋</h2>
                <p class="text-gray-500 mt-3 text-base">Ikuti langkah-langkah berikut untuk bergabung</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach([
                    ['01', '📝', 'Daftar Akun', 'Buat akun dan lengkapi data diri kamu'],
                    ['02', '📄', 'Upload Dokumen', 'Upload CV, transkrip, dan surat pengantar'],
                    ['03', '🎯', 'Seleksi & Interview', 'Tim kami akan menghubungi kamu untuk interview'],
                    ['04', '✅', 'Mulai Magang', 'Bergabung dan mulai pengalaman magang kamu'],
                ] as $step)
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 text-center relative reveal">
                    <div class="absolute -top-3 left-6 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">{{ $step[0] }}</div>
                    <div class="text-4xl mt-3 mb-3">{{ $step[1] }}</div>
                    <h3 class="font-bold text-gray-800 mb-1">{{ $step[2] }}</h3>
                    <p class="text-gray-500 text-xs leading-relaxed">{{ $step[3] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- TESTIMONI --}}
    @if($testimonis->count() > 0)
    <section class="py-16 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-10 reveal">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900">Kata Mereka 💬</h2>
                    <p class="text-gray-500 mt-2 text-base">Pengalaman nyata dari alumni magang Telkom</p>
                </div>
                <a href="/testimoni" class="text-sm font-bold text-red-600 hover:underline">Lihat Semua →</a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($testimonis as $testimoni)
                    <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 hover:shadow-md transition reveal">
                        <div class="text-2xl mb-3">⭐⭐⭐⭐⭐</div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">"{{ $testimoni->pesan }}"</p>
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                                <span class="text-xs font-bold text-white">{{ strtoupper(substr($testimoni->user->name, 0, 1)) }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-800">{{ $testimoni->user->name }}</p>
                                <p class="text-xs text-gray-400">Alumni Magang Telkom</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- CTA --}}
    <section class="py-16 px-6 bg-gradient-to-br from-gray-900 via-slate-800 to-red-950 text-white text-center">
        <div class="max-w-2xl mx-auto reveal">
            <h2 class="text-3xl font-extrabold mb-4">Siap Bergabung? 🎉</h2>
            <p class="text-gray-300 mb-8">Daftarkan dirimu sekarang dan mulai perjalanan karirmu bersama Telkom Indonesia.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="/lowongan" class="px-8 py-4 bg-red-600 hover:bg-red-700 font-bold rounded-xl shadow-lg transition-all">Lihat Lowongan</a>
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white/10 hover:bg-white/20 border border-white/20 font-bold rounded-xl transition-all">Daftar Sekarang</a>
            </div>
        </div>
    </section>

    <footer class="bg-gray-100 py-8 border-t border-gray-200 text-center text-sm text-gray-500 px-4">
        <p>&copy; 2026 PT Telkom Indonesia Witel Sukabumi. All Rights Reserved.</p>
    </footer>

    <script>
        const reveals = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1 });
        reveals.forEach(el => observer.observe(el));

        const counters = document.querySelectorAll('.counter');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = parseInt(entry.target.getAttribute('data-target'));
                    let count = 0;
                    const step = Math.ceil(target / 50) || 1;
                    const timer = setInterval(() => {
                        count += step;
                        if (count >= target) { count = target; clearInterval(timer); }
                        entry.target.textContent = count + '+';
                    }, 30);
                    counterObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        counters.forEach(el => counterObserver.observe(el));
    </script>
</body>
</html>
