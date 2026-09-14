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
            <img src="{{ asset('logo-simagang.png') }}" alt="Logo" class="h-10">
        </a>
        <a href="/login" class="text-xs font-bold text-red-600 hover:text-red-700">Sudah punya akun? Masuk</a>
    </nav>

    <main class="flex-grow flex items-center justify-center py-10 px-4">
        <div class="max-w-md w-full bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">

            <div class="bg-gradient-to-r from-gray-900 to-red-950 p-6 text-white text-center">
                <h2 class="text-xl font-bold">Daftar Akun Pelamar</h2>
                <p class="text-xs text-red-200 mt-1">Buat akun untuk mulai mendaftar program magang</p>
            </div>

            <form action="{{ route('register') }}" method="POST" class="p-6 space-y-4" novalidate>
                @csrf

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl text-xs">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                @endif

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Alamat Email <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email-input" value="{{ old('email') }}" placeholder="budi@student.univ.ac.id"
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password-input" placeholder="Minimal 8 karakter"
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-700 uppercase tracking-wider mb-1">
                        Ulangi Kata Sandi <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password-confirm-input" placeholder="••••••••"
                        class="w-full px-3 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-red-500 focus:bg-white transition-all">
                </div>

                <div id="form-error" class="hidden bg-red-50 border border-red-200 text-red-700 p-3 rounded-xl text-xs"></div>

                <button type="submit" onclick="return validateForm()"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl text-sm transition mt-2">
                    Daftar Sekarang
                </button>
            </form>
        </div>
    </main>

    <footer class="bg-white py-4 border-t border-gray-200 text-center text-[11px] text-gray-400">
        &copy; 2026 PT Telkom Indonesia Witel Sukabumi. All Rights Reserved.
    </footer>

    <script>
        function validateForm() {
            const email = document.getElementById('email-input').value.trim();
            const password = document.getElementById('password-input').value;
            const confirm = document.getElementById('password-confirm-input').value;
            const errBox = document.getElementById('form-error');
            let errors = [];

            if (!email) errors.push('Email wajib diisi');
            else if (!email.includes('@')) errors.push('Format email tidak valid');

            if (!password || password.length < 8) errors.push('Kata sandi minimal 8 karakter');
            if (password !== confirm) errors.push('Kata sandi tidak cocok');

            if (errors.length > 0) {
                errBox.innerHTML = errors.map(e => `<p>• ${e}</p>`).join('');
                errBox.classList.remove('hidden');
                return false;
            }
            errBox.classList.add('hidden');
            return true;
        }
    </script>

</body>
</html>