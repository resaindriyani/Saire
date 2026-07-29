<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat Pendaftaran Magang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 p-8">
    <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow border border-gray-100">
        <h2 class="text-2xl font-bold mb-4 text-gray-800">Syarat Pendaftaran Magang</h2>
        <p class="text-gray-600 mb-6">Pastikan Anda telah memenuhi kriteria berikut sebelum melanjutkan:</p>
        
        <ul class="list-decimal ml-5 space-y-2 mb-8 text-gray-700">
            <li>Mahasiswa aktif minimal semester 5.</li>
            <li>Memiliki CV terbaru dalam format PDF.</li>
            <li>Membawa surat pengantar magang dari kampus.</li>
            <li>Pas foto formal ukuran 3x4.</li>
        </ul>

        <div class="flex gap-4">
            <a href="{{ route('pelamar.dashboard') }}" class="text-gray-500 hover:text-gray-800 font-bold px-4 py-2">Kembali</a>
            <a href="{{ route('pelamar.form') }}" class="bg-red-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-red-700 transition">Lanjut Isi Form</a>
        </div>
    </div>
</body>
</html>