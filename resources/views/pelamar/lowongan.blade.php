@extends('layouts.dashboard')

@section('title', 'Lowongan - SiMagang Telkom')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h1 class="text-xl font-bold text-gray-900">Lowongan Magang Tersedia</h1>
        <p class="text-gray-500 text-sm mt-0.5">Daftar posisi magang yang sedang dibuka di PT Telkom Indonesia Witel Sukabumi.</p>
    </div>

    @if($lowongans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($lowongans as $lowongan)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-red-200 hover:shadow-md transition">
                    <h2 class="text-lg font-bold text-gray-800">{{ $lowongan->judul }}</h2>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">{{ $lowongan->deskripsi }}</p>

                    <div class="flex items-center gap-4 mt-4 text-xs text-gray-500">
                        <span>Kuota: <strong class="text-gray-700">{{ $lowongan->kuota }} orang</strong></span>
                        <span>Tutup: <strong class="text-gray-700">{{ $lowongan->tgl_tutup->format('d M Y') }}</strong></span>
                    </div>

                    <a href="{{ route('pelamar.form', ['lowongan_id' => $lowongan->id]) }}"
                        class="inline-flex mt-4 bg-red-600 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-700 transition">
                        Daftar Sekarang
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 text-sm text-yellow-700">
            Belum ada lowongan yang tersedia saat ini. Silahkan cek kembali nanti.
        </div>
    @endif

</div>
@endsection