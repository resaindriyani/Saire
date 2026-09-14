@extends('layouts.dashboard')

@section('title', 'Dashboard - SiMagang Telkom')

@section('content')

    {{-- Notifikasi Profil Belum Lengkap --}}
    @if(!$profilLengkap)
    <div class="relative bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-2xl p-6 mb-6">
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="text-4xl">⚠️</div>
                <div>
                    <h2 class="text-lg font-extrabold text-amber-800">Lengkapi Profil Kamu Dulu</h2>
                    <p class="text-amber-700 text-sm mt-0.5">Silahkan lengkapi profil sebelum melamar magang.</p>
                </div>
            </div>
            <a href="{{ route('pelamar.profil') }}"
                class="bg-amber-600 text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-amber-700 transition whitespace-nowrap">
                Lengkapi Sekarang
            </a>
        </div>
    </div>
    @endif

    {{-- Notifikasi Jadwal Interview Baru --}}
    @if($adaJadwalBaru)
    <div id="notif-interview" class="relative bg-gradient-to-r from-blue-500 to-indigo-600 text-white p-6 rounded-2xl shadow-lg mb-6 overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        <div class="relative z-10 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div class="text-4xl animate-bounce">📅</div>
                <div>
                    <h2 class="text-lg font-extrabold">Jadwal Interview Tersedia!</h2>
                    <p class="text-blue-100 text-sm mt-0.5">Admin telah menjadwalkan interview untukmu. Cek sekarang!</p>
                </div>
            </div>
            <div class="flex items-center gap-3 ml-4">
                <a href="{{ route('pelamar.interview') }}"
                    class="px-4 py-2 bg-white text-blue-600 font-bold rounded-xl text-sm hover:bg-blue-50 transition whitespace-nowrap">
                    Lihat Jadwal
                </a>
                <button onclick="document.getElementById('notif-interview').style.display='none'"
                    class="text-white/70 hover:text-white text-xl font-bold">✕</button>
            </div>
        </div>
    </div>
    @endif

    {{-- Notifikasi Status Lamaran --}}
    @if($lamaranTerakhir)
        @if($lamaranTerakhir->status === 'ditolak')
        <div class="relative bg-gradient-to-r from-red-50 to-rose-50 border border-red-200 rounded-2xl p-6 mb-6 overflow-hidden">
            <div class="flex items-start gap-4">
                <div class="text-4xl">😔</div>
                <div class="flex-1">
                    <h2 class="text-lg font-extrabold text-red-700 mb-1">Mohon Maaf, {{ $user->name }}</h2>
                    <p class="text-red-600 text-sm leading-relaxed">
                        Kami menyampaikan permohonan maaf yang sebesar-besarnya. Setelah melalui proses seleksi,
                        lamaran magang Anda di <strong>PT Telkom Indonesia Witel Sukabumi</strong> belum dapat kami terima
                        pada periode ini. Terima kasih atas minat dan kepercayaan Anda kepada kami.
                    </p>
                    @if($lamaranTerakhir->catatan_admin)
                        <div class="mt-3 bg-white border border-red-100 rounded-xl px-4 py-3 text-sm text-gray-600">
                            💬 <span class="font-semibold">Catatan:</span> {{ $lamaranTerakhir->catatan_admin }}
                        </div>
                    @endif
                    <p class="text-xs text-red-400 mt-3 mb-4">Anda dapat mencoba mendaftar kembali di periode berikutnya.</p>
                    <a href="{{ route('pelamar.form') }}"
                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                        📝 Daftar Ulang Magang
                    </a>
                </div>
            </div>
        </div>
        @endif

        @if($lamaranTerakhir->status === 'diterima')
        <div id="notif-diterima" class="relative bg-gradient-to-r from-green-500 to-emerald-600 text-white p-6 rounded-2xl shadow-lg mb-6 overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="text-4xl animate-bounce">🎉</div>
                    <div>
                        <h2 class="text-lg font-extrabold">Selamat, {{ $user->name }}!</h2>
                        <p class="text-green-100 text-sm mt-0.5">Lamaran magang kamu di Telkom Sukabumi telah <strong>diterima</strong>. Selamat bergabung!</p>
                    </div>
                </div>
                <button onclick="document.getElementById('notif-diterima').style.display='none'"
                    class="text-white/70 hover:text-white text-xl font-bold ml-4">✕</button>
            </div>
        </div>
        @endif
    @endif

    {{-- Header --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="flex items-center gap-4">
            @if(isset($profil) && $profil && $profil->foto)
                <img src="{{ asset('storage/' . $profil->foto) }}"
                    class="w-14 h-14 rounded-xl object-cover border border-gray-200">
            @else
                <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">
                    <span class="text-xl font-bold text-red-500">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                </div>
            @endif
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Halo, {{ $user->name }}! 👋</h1>
                <p class="text-gray-500 text-sm mt-0.5">Selamat datang di Dashboard SiMagang Telkom.</p>
            </div>
        </div>
    </div>

    {{-- Status Lamaran --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Status Lamaran</h2>

        @if($lamaranTerakhir)
            <div class="flex items-center justify-between p-5 rounded-xl border
                {{ $lamaranTerakhir->status === 'diterima' ? 'bg-green-50 border-green-100' : '' }}
                {{ $lamaranTerakhir->status === 'pending' ? 'bg-yellow-50 border-yellow-100' : '' }}
                {{ $lamaranTerakhir->status === 'review' ? 'bg-blue-50 border-blue-100' : '' }}
                {{ $lamaranTerakhir->status === 'ditolak' ? 'bg-red-50 border-red-100' : '' }}
                {{ $lamaranTerakhir->status === 'selesai' ? 'bg-gray-50 border-gray-100' : '' }}">
                <div>
                    <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Status</p>
                    <p class="text-lg font-bold text-gray-800 mt-0.5">{{ ucfirst($lamaranTerakhir->status) }}</p>
                    @if($lamaranTerakhir->status !== 'ditolak' && $lamaranTerakhir->status !== 'diterima' && $lamaranTerakhir->catatan_admin)
                        <p class="text-sm text-gray-500 mt-1">💬 {{ $lamaranTerakhir->catatan_admin }}</p>
                    @endif
                </div>
                <div class="text-3xl">
                    @if($lamaranTerakhir->status === 'diterima') ✅
                    @elseif($lamaranTerakhir->status === 'pending') ⏳
                    @elseif($lamaranTerakhir->status === 'review') 🔍
                    @elseif($lamaranTerakhir->status === 'ditolak') ❌
                    @elseif($lamaranTerakhir->status === 'selesai') 🎓
                    @endif
                </div>
            </div>

            <div class="mt-4 grid grid-cols-3 gap-3 text-sm">
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs">Universitas</p>
                    <p class="font-semibold text-gray-800 mt-0.5 text-xs">{{ $lamaranTerakhir->universitas }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs">Durasi</p>
                    <p class="font-semibold text-gray-800 mt-0.5 text-xs">{{ $lamaranTerakhir->durasi_bulan }} Bulan</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-gray-400 text-xs">Status</p>
                    <p class="font-semibold text-gray-800 mt-0.5 text-xs">{{ ucfirst($lamaranTerakhir->status) }}</p>
                </div>
            </div>
        @else
            <div class="flex items-center justify-between p-5 rounded-xl bg-red-50 border border-red-100">
                <div>
                    <p class="font-bold text-red-800">Belum Mendaftar</p>
                    <p class="text-sm text-red-600 mt-0.5">Silakan lengkapi data pendaftaran magang kamu.</p>
                </div>
                @if($profilLengkap)
                    <a href="{{ route('pelamar.form') }}"
                        class="bg-red-600 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-700 transition whitespace-nowrap">
                        Daftar Sekarang
                    </a>
                @else
                    <span class="bg-gray-200 text-gray-400 px-5 py-2 rounded-xl text-sm font-bold whitespace-nowrap cursor-not-allowed">
                        Lengkapi Profil Dulu
                    </span>
                @endif
            </div>
        @endif
    </div>

    {{-- Menu Fitur --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('pelamar.pesan.index') }}"
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-red-200 hover:shadow-md transition group">
            <div class="text-3xl mb-3">✉️</div>
            <h3 class="font-bold text-gray-800 group-hover:text-red-600 transition">Pesan</h3>
            <p class="text-xs text-gray-500 mt-1">Chat dengan admin</p>
        </a>

        <a href="{{ route('pelamar.interview') }}"
            class="relative bg-white p-6 rounded-2xl shadow-sm border {{ $adaJadwalBaru ? 'border-blue-300 ring-2 ring-blue-200' : 'border-gray-200' }} hover:border-blue-300 hover:shadow-md transition group">
            @if($adaJadwalBaru)
                <span class="absolute top-3 right-3 w-2.5 h-2.5 bg-blue-500 rounded-full animate-pulse"></span>
            @endif
            <div class="text-3xl mb-3">📅</div>
            <h3 class="font-bold text-gray-800 group-hover:text-blue-600 transition">Interview</h3>
            <p class="text-xs text-gray-500 mt-1">Lihat jadwal interview kamu</p>
        </a>

        <a href="{{ route('pelamar.logbook') }}"
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-red-200 hover:shadow-md transition group">
            <div class="text-3xl mb-3">📝</div>
            <h3 class="font-bold text-gray-800 group-hover:text-red-600 transition">Logbook</h3>
            <p class="text-xs text-gray-500 mt-1">Catat kegiatan magang harian</p>
        </a>

        <a href="{{ route('pelamar.sertifikat') }}"
            class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-red-200 hover:shadow-md transition group">
            <div class="text-3xl mb-3">🎓</div>
            <h3 class="font-bold text-gray-800 group-hover:text-red-600 transition">Sertifikat</h3>
            <p class="text-xs text-gray-500 mt-1">Download sertifikat magang</p>
        </a>
    </div>

@endsection