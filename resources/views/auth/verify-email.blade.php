<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - SiMagang Telkom</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-sm border border-gray-200 text-center">
        <div class="text-5xl mb-6">✉️</div>
        
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Verifikasi Email Anda</h2>
        
        <p class="text-gray-600 text-sm mb-6">
            Terima kasih telah mendaftar! Sebelum memulai, silakan verifikasi alamat email Anda dengan mengklik tautan yang baru saja kami kirimkan ke email Anda.
        </p>

        @if (session('message'))
            <div class="mb-4 text-sm text-green-600 font-medium">
                Link verifikasi baru telah dikirim ke alamat email Anda.
            </div>
        @endif

        <form action="{{ route('verification.send') }}" method="POST">
            @csrf
            <button type="submit" 
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-3 rounded-xl transition duration-200">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        <div class="mt-6 border-t pt-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="text-sm text-gray-500 hover:text-red-600 transition">
                    Keluar / Log Out
                </button>
            </form>
        </div>
    </div>

</body>
</html>