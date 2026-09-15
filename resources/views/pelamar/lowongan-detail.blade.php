@extends('layouts.dashboard')

@section('title', $lowongan->judul . ' - SiMagang Telkom')

@section('content')
<div class="max-w-3xl mx-auto">

    <div class="mb-6">
        <a href="{{ route('pelamar.lowongan') }}" class="text-sm text-gray-500 hover:text-red-600 font-medium">
            &larr; Kembali ke Lowongan
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 p-4 rounded-xl mb-6 text-sm font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">{{ $lowongan->judul }}</h1>

        <div class="flex items-center gap-4 mt-3 text-sm text-gray-500">
            <span>Kuota: <strong class="text-gray-700">{{ $lowongan->kuota }} orang</strong></span>
            <span>Durasi: <strong class="text-gray-700">{{ $lowongan->durasi_bulan }} bulan</strong></span>
            <span>Tutup: <strong class="text-gray-700">{{ $lowongan->tgl_tutup->format('d M Y') }}</strong></span>
        </div>

        <div class="mt-6 pt-6 border-t border-gray-100">
            <h2 class="text-sm font-bold text-gray-700 mb-2">Deskripsi Posisi</h2>
            <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $lowongan->deskripsi }}</p>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100">
            @if($lamaranAktif)
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-4">
                    <p class="text-sm font-bold text-blue-700">
                        Kamu sudah melamar posisi ini.
                    </p>
                    <p class="text-xs text-blue-500 mt-1">Status saat ini: <strong>{{ ucfirst($lamaranAktif->status) }}</strong></p>
                </div>

                @if($lamaranAktif->status === 'pending')
                    <form action="{{ route('pelamar.batalLamaran', $lowongan->id) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin membatalkan lamaran ini?')">
                        @csrf
                        <button type="submit"
                            class="bg-white border border-red-300 text-red-600 px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-red-50 transition">
                            Batalkan Lamaran
                        </button>
                    </form>
                @endif
            @else
                <button type="button" onclick="document.getElementById('modal-konfirmasi').classList.remove('hidden')"
                    class="bg-red-600 text-white px-6 py-2.5 rounded-xl text-sm font-bold hover:bg-red-700 transition">
                    Daftar Sekarang
                </button>
            @endif
        </div>
    </div>
</div>

{{-- Modal Konfirmasi --}}
<div id="modal-konfirmasi" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-xl">
        <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Pendaftaran</h3>
        <p class="text-sm text-gray-500 mb-6">
            Yakin ingin melamar posisi <strong>{{ $lowongan->judul }}</strong>? Dokumen (CV, Transkrip, Surat Pengantar) dari profil kamu akan digunakan.
        </p>
        <form method="POST" action="{{ route('pelamar.lamar', $lowongan->id) }}">
            @csrf
            <div class="flex gap-3">
                <button type="button" onclick="document.getElementById('modal-konfirmasi').classList.add('hidden')"
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 rounded-xl text-sm transition">
                    Batal
                </button>
                <button type="submit"
                    class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl text-sm transition">
                    Ya, Lamar Sekarang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection