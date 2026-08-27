<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Pelamar - SiMagang Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 font-sans text-gray-800 antialiased min-h-screen flex flex-col justify-between">

    <nav class="bg-white border-b border-gray-200 shadow-sm h-16 flex items-center px-6 justify-between">
        <a href="/" class="flex items-center space-x-2">
            <img src="https://upload.wikimedia.org/wikipedia/commons/b/bb/Telkom_Indonesia_2013.svg" alt="Logo" class="h-7">
            <span class="font-bold text-sm tracking-tight text-gray-900">SiMagang <span class="text-red-600">Telkom</span></span>
        </a>
        <a href="/login" class="text-xs font-bold text-red-600 hover:text-red-700">Sudah punya akun? Masuk</a>
    </nav>

    <main class="flex-grow flex items-center justify-center py-10 px-4">
        <div class="max-w-2xl w-full bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            {{-- Header --}}
            <div class="bg-gradient-to-r from-gray-900 to-red-950 p-6 text-white text-center">
                <h2 class="text-xl font-bold">Pendaftaran Magang</h2>
                <p class="text-xs text-red-200 mt-1">Lengkapi semua data untuk mendaftar program magang</p>
            </div>

            {{-- Step Indicator --}}
            <div class="flex border-b border-gray-100">
                <button onclick="showStep(1)" id="tab-1"
                    class="flex-1 py-3 text-xs font-bold text-center transition tab-btn active-tab">
                    1. Akun
                </button>
                <button onclick="showStep(2)" id="tab-2"
                    class="flex-1 py-3 text-xs font-bold text-center transition tab-btn inactive-tab">
                    2. Profil
                </button>
                <button onclick="showStep(3)" id="tab-3"
                    class="flex-1 py-3 text-xs font-bold text-center transition tab-btn inactive-tab">
                    3. Pendaftaran
                </button>
            </div>

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="p-6" novalidate>
                @csrf

                {{-- Error --}}
                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-4 text-xs">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- STEP 1: DATA AKUN --}}
                <div id="step-1" class="step-content space-y-4">
                    <p class="text-sm font-bold text-gray-700 mb-4">📋 Data Akun</p>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Budi Setiadi"
                            class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="budi@student.univ.ac.id"
                            class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Kata Sandi</label>
                        <input type="password" name="password" placeholder="Minimal 8 karakter"
                            class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Ulangi Kata Sandi</label>
                        <input type="password" name="password_confirmation" placeholder="••••••••"
                            class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                    </div>

                    <button type="button" onclick="showStep(2)"
                        class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-sm transition mt-2">
                        Lanjut →
                    </button>
                </div>

                {{-- STEP 2: DATA PROFIL --}}
                <div id="step-2" class="step-content space-y-4 hidden">
                    <p class="text-sm font-bold text-gray-700 mb-4">👤 Data Profil</p>

                    {{-- Foto Profil --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Foto Profil</label>
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-600 file:font-semibold">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">NIM/NIS</label>
                            <input type="text" name="nim_nis" value="{{ old('nim_nis') }}" placeholder="Nomor Induk"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">No. HP</label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" placeholder="08xxxxxxxxxx"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Institusi</label>
                            <input type="text" name="institusi" value="{{ old('institusi') }}" placeholder="Nama Kampus"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Jurusan</label>
                            <input type="text" name="jurusan" value="{{ old('jurusan') }}" placeholder="Teknik Informatika"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Bio</label>
                        <input type="text" name="bio" value="{{ old('bio') }}" placeholder="Ceritakan sedikit tentang dirimu..."
                            class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Instagram</label>
                            <input type="text" name="instagram" value="{{ old('instagram') }}" placeholder="username"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">TikTok</label>
                            <input type="text" name="tiktok" value="{{ old('tiktok') }}" placeholder="username"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">LinkedIn</label>
                            <input type="text" name="linkedin" value="{{ old('linkedin') }}" placeholder="username"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">GitHub</label>
                            <input type="text" name="github" value="{{ old('github') }}" placeholder="username"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div class="flex gap-3 mt-2">
                        <button type="button" onclick="showStep(1)"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl text-sm transition">
                            ← Kembali
                        </button>
                        <button type="button" onclick="showStep(3)"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-sm transition">
                            Lanjut →
                        </button>
                    </div>
                </div>

                {{-- STEP 3: PENDAFTARAN MAGANG --}}
                <div id="step-3" class="step-content space-y-4 hidden">
                    <p class="text-sm font-bold text-gray-700 mb-4">📄 Pendaftaran Magang</p>

                    @if($lowongans->count() > 0)
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-2">Pilih Lowongan</label>
                            <div class="space-y-2">
                                @foreach($lowongans as $lowongan)
                                    <label class="flex items-start gap-3 p-3 border border-gray-200 rounded-xl cursor-pointer hover:border-red-300 hover:bg-red-50 transition">
                                        <input type="radio" name="lowongan_id" value="{{ $lowongan->id }}" class="mt-0.5 accent-red-600">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">{{ $lowongan->judul }}</p>
                                            <p class="text-xs text-gray-500 mt-0.5">Kuota: {{ $lowongan->kuota }} orang · Tutup: {{ $lowongan->tgl_tutup->format('d M Y') }}</p>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4 text-sm text-yellow-700">
                            ⚠️ Belum ada lowongan yang tersedia saat ini. Kamu tetap bisa mendaftar dan menunggu lowongan dibuka.
                        </div>
                    @endif

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Universitas</label>
                            <input type="text" name="universitas" value="{{ old('universitas') }}" placeholder="Nama Universitas"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Durasi (Bulan)</label>
                            <input type="number" name="durasi_bulan" value="{{ old('durasi_bulan') }}" placeholder="3" min="1"
                                class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Upload CV (PDF/JPG)</label>
                        <input type="file" name="cv" accept=".pdf,.jpg,.jpeg"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-600 file:font-semibold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Upload Transkrip (PDF/JPG)</label>
                        <input type="file" name="transkrip" accept=".pdf,.jpg,.jpeg"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-600 file:font-semibold">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">Upload Surat Pengantar (PDF/JPG)</label>
                        <input type="file" name="surat_pengantar" accept=".pdf,.jpg,.jpeg"
                            class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-600 file:font-semibold">
                    </div>

                    <div class="flex items-start pt-1">
                        <input id="terms" type="checkbox" class="h-4 w-4 text-red-600 border-gray-300 rounded mt-0.5" required>
                        <label for="terms" class="ml-2 block text-xs text-gray-500 leading-relaxed">
                            Saya menyatakan bahwa data yang diisi adalah benar, asli, dan siap mematuhi segala peraturan magang di PT Telkom Indonesia Witel Sukabumi.
                        </label>
                    </div>

                    <div class="flex gap-3 mt-2">
                        <button type="button" onclick="showStep(2)"
                            class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-3 rounded-xl text-sm transition">
                            ← Kembali
                        </button>
                        <button type="submit"
                            class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-sm transition">
                            Daftar Sekarang ✓
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </main>

    <footer class="bg-white py-4 border-t border-gray-200 text-center text-[11px] text-gray-400">
        &copy; 2026 PT Telkom Indonesia Witel Sukabumi. All Rights Reserved.
    </footer>

    <style>
        .active-tab { color: #dc2626; border-bottom: 2px solid #dc2626; }
        .inactive-tab { color: #9ca3af; border-bottom: 2px solid transparent; }
    </style>

    <script>
        function showStep(step) {
            document.querySelectorAll('.step-content').forEach(el => el.classList.add('hidden'));
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('active-tab');
                el.classList.add('inactive-tab');
            });
            document.getElementById('step-' + step).classList.remove('hidden');
            document.getElementById('tab-' + step).classList.add('active-tab');
            document.getElementById('tab-' + step).classList.remove('inactive-tab');
        }
    </script>

</body>
</html>
