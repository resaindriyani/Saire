@extends('layouts.dashboard')

@section('title', 'Sertifikat - SiMagang Telkom')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Sertifikat Magang 🎓</h1>
        <p class="text-gray-600 mt-1">Sertifikat akan tersedia setelah masa magang selesai.</p>
    </div>

    @if($sertifikat)
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 text-center">
            <div class="text-6xl mb-4">🎓</div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Selamat!</h2>
            <p class="text-gray-600 text-sm mb-6">Sertifikat magang kamu sudah tersedia.</p>

            <div class="bg-gray-50 rounded-xl p-6 mb-6 text-left max-w-sm mx-auto">
                <div class="mb-3">
                    <p class="text-xs text-gray-500">Nomor Sertifikat</p>
                    <p class="font-bold text-gray-800">{{ $sertifikat->nomor_sertifikat }}</p>
                </div>
                <div>
                    <p class="text-xs text-gray-500">Tanggal Terbit</p>
                    <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($sertifikat->tgl_terbit)->format('d F Y') }}</p>
                </div>
            </div>

            <a href="{{ route('pelamar.sertifikat.download') }}"
                class="bg-red-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-red-700 transition inline-block">
                Download Sertifikat PDF
            </a>
        </div>
    @else
        <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-200 text-center">
            <div class="text-6xl mb-4">⏳</div>
            <h2 class="text-xl font-bold text-gray-800 mb-2">Sertifikat Belum Tersedia</h2>
            <p class="text-gray-500 text-sm">Sertifikat akan diterbitkan oleh admin setelah masa magang selesai.</p>
        </div>
    @endif
@endsection
