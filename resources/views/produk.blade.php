<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk & Layanan - SiMagang Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-gray-800 antialiased flex flex-col min-h-screen">

    <x-navbar />

    <div class="bg-gradient-to-r from-gray-900 to-red-950 text-white py-12 px-6 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-5 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <h1 class="text-3xl font-extrabold relative z-10">Produk & Inovasi Digital</h1>
        <p class="text-red-200 text-sm mt-2 relative z-10">Infrastruktur telekomunikasi penopang digitalisasi Indonesia</p>
    </div>

    <main class="flex-grow max-w-6xl mx-auto px-6 py-12 w-full">
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-200">
                <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center text-xl text-red-600 font-bold mb-4 group-hover:bg-red-600 group-hover:text-white transition-colors">🌐</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">IndiHome / Telkomsel One</h3>
                <p class="text-xs text-gray-600 leading-relaxed">Layanan internet broadband super cepat berbasis jaringan serat optik (*fiber optic*) berskala nasional untuk segmen perumahan, instansi, hingga UMKM guna mempercepat koneksi digital harian.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-200">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center text-xl text-blue-600 font-bold mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">🏢</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Astinet (Dedicated Internet)</h3>
                <p class="text-xs text-gray-600 leading-relaxed">Solusi premium konektivitas internet privat (*dedicated*) dengan jaminan keandalan tinggi dan kecepatan simetris (*bandwidth* 1:1) khusus bagi kebutuhan korporasi, perbankan, dan instansi pemerintahan.</p>
            </div>

            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-all group hover:-translate-y-1 duration-200">
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center text-xl text-amber-600 font-bold mb-4 group-hover:bg-amber-500 group-hover:text-white transition-colors">☁️</div>
                <h3 class="font-bold text-lg text-gray-900 mb-2">Pijar Mahir & Data Center</h3>
                <p class="text-xs text-gray-600 leading-relaxed">Platform ekosistem digital anak bangsa yang fokus pada akselerasi edukasi, pelatihan sertifikasi digital (Pijar), serta penyediaan infrastruktur *cloud data center* aman bagi bisnis modern.</p>
            </div>
        </div>
    </main>

    <footer class="bg-white py-6 text-center text-sm text-gray-500 border-t border-gray-200">
        <p>&copy; 2026 PT Telkom Indonesia Witel Sukabumi. All Rights Reserved.</p>
    </footer>

    
</body>
</html>
