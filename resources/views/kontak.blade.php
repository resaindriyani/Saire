<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - SiMagang Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-gray-800 antialiased flex flex-col min-h-screen">

    <x-navbar />

    <div class="bg-gradient-to-r from-gray-900 to-red-950 text-white py-12 px-6 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <h1 class="text-3xl font-extrabold relative z-10">Pusat Informasi & Kontak</h1>
        <p class="text-red-200 text-sm mt-2 relative z-10">Hubungi kami atau kunjungi kantor operasional Witel Sukabumi</p>
    </div>

    <main class="flex-grow max-w-4xl mx-auto px-6 py-12 w-full">
        <div class="grid md:grid-cols-2 gap-6 items-stretch">

            {{-- Info Kontak --}}
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm space-y-6 flex flex-col justify-between">
                <div class="space-y-4">
                    <div class="flex gap-3 items-start">
                        <span class="text-xl bg-gray-100 p-2 rounded-lg block">📍</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Alamat Kantor Wilayah</h4>
                            <p class="text-xs text-gray-600 mt-1 leading-relaxed">Plaza Telkom Sukabumi, Jl. Masjid No.1, Gunungparang, Cikole, Kota Sukabumi, Jawa Barat 43111</p>
                            <a href="https://maps.google.com/?q=Plaza+Telkom+Sukabumi,+Jl.+Masjid+No.1,+Gunungparang,+Cikole,+Kota+Sukabumi,+Jawa+Barat+43111"
                                target="_blank"
                                class="inline-flex items-center gap-1.5 mt-2 px-3 py-1.5 bg-blue-50 hover:bg-blue-100 text-blue-600 font-semibold text-xs rounded-lg transition">
                                🗺️ Buka di Google Maps
                            </a>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="text-xl bg-gray-100 p-2 rounded-lg block">✉️</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Email Layanan Magang</h4>
                            <p class="text-xs text-gray-600 mt-0.5">witel.sukabumi@telkom.co.id</p>
                        </div>
                    </div>
                    <div class="flex gap-3 items-start">
                        <span class="text-xl bg-gray-100 p-2 rounded-lg block">🕒</span>
                        <div>
                            <h4 class="font-bold text-gray-900 text-sm">Jam Operasional Kantor</h4>
                            <p class="text-xs text-gray-600 mt-0.5">Senin - Jumat | 08:00 - 16:30 WIB</p>
                        </div>
                    </div>
                </div>
                <div class="pt-4 border-t border-gray-100 text-[11px] text-gray-400">
                    *Harap membawa Surat Pengantar Kampus saat kunjungan verifikasi berkas fisik.
                </div>
            </div>

            {{-- CTA --}}
            <div class="bg-gradient-to-br from-red-600 to-red-800 text-white p-8 rounded-2xl flex flex-col justify-between shadow-md relative overflow-hidden">
                <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/5 rounded-full pointer-events-none"></div>
                <div>
                    <span class="bg-white/20 text-xs font-bold px-2.5 py-1 rounded-full uppercase tracking-wider inline-block mb-3 border border-white/10">Alur Pengajuan</span>
                    <h3 class="text-lg font-bold mb-2">Butuh Bantuan Koordinasi?</h3>
                    <p class="text-xs text-red-100 leading-relaxed mb-4">
                        Seluruh berkas administrasi (CV, Transkrip Nilai, & Proposal) wajib diunggah secara digital melalui akun pendaftaran mahasiswa di website ini sebelum dilakukan penilaian oleh tim unit terkait.
                    </p>
                </div>
                <a href="{{ route('register') }}" class="w-full text-center bg-white text-red-700 py-3 rounded-xl font-bold text-xs hover:bg-red-50 transition-colors shadow-sm block">
                    Buat Akun Pelamar Sekarang
                </a>
            </div>
        </div>

        {{-- Google Maps Embed --}}
        <div class="mt-8 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-4 border-b border-gray-100">
                <h3 class="font-bold text-gray-800 text-sm">📍 Lokasi Kantor Telkom Witel Sukabumi</h3>
            </div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3962.1!2d106.9272!3d-6.9198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6831c4b4b4b4b4%3A0x1!2sPlaza+Telkom+Sukabumi!5e0!3m2!1sid!2sid!4v1620000000000!5m2!1sid!2sid"
                width="100%"
                height="300"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </main>

    <footer class="bg-white py-6 text-center text-sm text-gray-500 border-t border-gray-200">
        <p>&copy; 2026 PT Telkom Indonesia Witel Sukabumi. All Rights Reserved.</p>
    </footer>

    
</body>
</html>
