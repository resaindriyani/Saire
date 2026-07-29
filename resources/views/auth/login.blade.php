<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SiMagang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">
        
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-red-600">SiMagang</h1>
            <p class="text-gray-500 text-sm mt-1">Sistem Informasi Magang Telkom Sukabumi</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-600 p-3 rounded-lg mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        @if (session('success'))
            <div class="bg-green-50 border border-green-200 text-green-600 p-3 rounded-lg mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-semibold mb-1 text-gray-700">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent"
                    placeholder="email@example.com" required>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold mb-1 text-gray-700">Password</label>
                <input type="password" name="password"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 focus:border-transparent"
                    placeholder="••••••••" required>
            </div>

            <button type="submit"
                class="w-full bg-red-600 text-white py-2.5 rounded-lg hover:bg-red-700 transition font-bold text-sm">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-red-600 hover:underline font-semibold">Daftar di sini</a>
        </p>
    </div>
</body>
</html>