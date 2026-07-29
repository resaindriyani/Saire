@extends('layouts.dashboard')

@section('title', 'Detail Pelamar - SiMagang Telkom')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Detail Pelamar 👤</h1>
                <p class="text-gray-600 mt-1">{{ $lamaran->user->name }}</p>
            </div>
            <a href="{{ route('admin.pelamar.index') }}"
                class="text-sm font-bold text-gray-500 hover:text-red-600 transition">
                ← Daftar Pelamar
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-medium">
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Badge Status --}}
    <div class="mb-6">
        <span class="px-4 py-2 rounded-full text-xs font-bold uppercase tracking-wider
            {{ $lamaran->status == 'diterima' ? 'bg-green-100 text-green-700' :
               ($lamaran->status == 'ditolak' ? 'bg-red-100 text-red-700' :
               ($lamaran->status == 'selesai' ? 'bg-gray-100 text-gray-700' :
               ($lamaran->status == 'review' ? 'bg-blue-100 text-blue-700' :
               'bg-yellow-100 text-yellow-700'))) }}">
            Status: {{ ucfirst($lamaran->status) }}
        </span>
    </div>

    {{-- Profil Pelamar --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">
        <div class="h-20 bg-gradient-to-r from-gray-900 via-slate-800 to-red-950 relative">
            <div class="absolute -bottom-10 left-8">
                @if($profil && $profil->foto)
                    <img src="{{ asset('storage/' . $profil->foto) }}"
                         class="w-20 h-20 rounded-full object-cover border-4 border-white shadow-lg">
                @else
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-red-400 to-red-600 border-4 border-white shadow-lg flex items-center justify-center">
                        <span class="text-2xl font-bold text-white">{{ strtoupper(substr($lamaran->user->name, 0, 1)) }}</span>
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-14 pb-6 px-8">
            <h2 class="text-lg font-bold text-gray-900">{{ $lamaran->user->name }}</h2>
            <p class="text-sm text-gray-400">{{ $lamaran->user->email }}</p>
            @if($profil && $profil->jurusan)
                <p class="text-xs text-gray-500 mt-0.5">{{ $profil->jurusan }}</p>
            @endif
            @if($profil && $profil->skills)
                <p class="text-xs text-red-500 font-medium mt-0.5">{{ $profil->skills }}</p>
            @endif
            @if($profil && $profil->bio)
                <p class="text-gray-600 text-sm mt-2 leading-relaxed">{{ $profil->bio }}</p>
            @endif

            <div class="flex gap-2 flex-wrap mt-3">
                @if($profil && $profil->instagram)
                    <a href="https://instagram.com/{{ ltrim($profil->instagram, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 text-white text-xs font-semibold hover:opacity-90 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        {{ ltrim($profil->instagram, '@') }}
                    </a>
                @endif
                @if($profil && $profil->tiktok)
                    <a href="https://tiktok.com/@{{ ltrim($profil->tiktok, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-900 text-white text-xs font-semibold hover:bg-gray-700 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.74a4.85 4.85 0 01-1.01-.05z"/></svg>
                        {{ ltrim($profil->tiktok, '@') }}
                    </a>
                @endif
                @if($profil && $profil->linkedin)
                    <a href="https://linkedin.com/in/{{ ltrim($profil->linkedin, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        {{ ltrim($profil->linkedin, '@') }}
                    </a>
                @endif
                @if($profil && $profil->github)
                    <a href="https://github.com/{{ ltrim($profil->github, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-800 text-white text-xs font-semibold hover:bg-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        {{ ltrim($profil->github, '@') }}
                    </a>
                @endif
                @if(!$profil || (!$profil->instagram && !$profil->tiktok && !$profil->linkedin && !$profil->github && !$profil->bio))
                    <p class="text-xs text-gray-400 italic">Belum mengisi profil</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Data Diri --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Data Diri</h2>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-6 text-sm">
            <div>
                <p class="text-gray-400 text-xs">Nama</p>
                <p class="font-bold text-gray-800">{{ $lamaran->user->name }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Email</p>
                <p class="font-bold text-gray-800">{{ $lamaran->user->email }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Universitas</p>
                <p class="font-bold text-gray-800">{{ $lamaran->universitas }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Durasi</p>
                <p class="font-bold text-gray-800">{{ $lamaran->durasi_bulan }} bulan</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Tanggal Mulai</p>
                <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($lamaran->tgl_mulai)->format('d F Y') }}</p>
            </div>
            <div>
                <p class="text-gray-400 text-xs">Tanggal Selesai</p>
                <p class="font-bold text-gray-800">{{ \Carbon\Carbon::parse($lamaran->tgl_selesai)->format('d F Y') }}</p>
            </div>
        </div>
    </div>

    {{-- Jadwal Interview --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-gray-800">Jadwal Interview</h2>
            <a href="{{ route('admin.interview.create', $lamaran->id) }}"
                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-sm transition">
                {{ $lamaran->jadwalInterview ? '✏️ Edit Jadwal' : '📅 Buat Jadwal' }}
            </a>
        </div>

        @if($lamaran->jadwalInterview)
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                    <p class="text-xs text-blue-400 font-semibold uppercase">Waktu</p>
                    <p class="font-bold text-gray-800 mt-1">{{ $lamaran->jadwalInterview->waktu_interview->format('d F Y') }}</p>
                    <p class="text-blue-600 font-semibold text-sm">{{ $lamaran->jadwalInterview->waktu_interview->format('H:i') }} WIB</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 font-semibold uppercase">Tipe</p>
                    <p class="font-bold text-gray-800 mt-1">{{ $lamaran->jadwalInterview->tipe === 'online' ? '💻 Online' : '🏢 Offline' }}</p>
                </div>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                    <p class="text-xs text-gray-400 font-semibold uppercase">Lokasi / Link</p>
                    <p class="font-bold text-gray-800 mt-1 text-sm break-all">{{ $lamaran->jadwalInterview->lokasi_atau_link }}</p>
                </div>
            </div>
            @if($lamaran->jadwalInterview->catatan)
                <div class="mt-3 bg-yellow-50 border border-yellow-100 rounded-xl p-4 text-sm text-gray-600">
                    📋 <span class="font-semibold">Catatan:</span> {{ $lamaran->jadwalInterview->catatan }}
                </div>
            @endif
        @else
            <p class="text-sm text-gray-400 italic">Belum ada jadwal interview untuk pelamar ini.</p>
        @endif
    </div>

    {{-- Dokumen & Logbook --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Dokumen</h2>
            <div class="space-y-3">
                @foreach($lamaran->dokumen as $dok)
                    <div class="flex justify-between items-center border border-gray-100 rounded-xl px-4 py-3 bg-gray-50">
                        <span class="text-sm font-medium text-gray-700 capitalize">
                            {{ str_replace('_', ' ', $dok->jenis) }}
                        </span>
                        <a href="{{ asset('storage/' . $dok->path_file) }}" target="_blank"
                            class="text-sm text-red-600 hover:underline font-bold">Lihat →</a>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Logbook</h2>
            <p class="text-gray-500 text-sm mb-3">Total aktivitas yang dilaporkan:</p>
            <p class="text-4xl font-black text-gray-800 mb-4">
                {{ $lamaran->logbooks->count() }}
                <span class="text-sm font-normal text-gray-400">entri</span>
            </p>
            <a href="{{ route('admin.pelamar.logbook', $lamaran->id) }}"
                class="block text-center w-full bg-gray-900 text-white py-2.5 rounded-xl text-sm font-bold hover:bg-black transition">
                Lihat Detail Logbook →
            </a>
        </div>
    </div>

    {{-- Ubah Status --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Update Status Lamaran</h2>
        <form action="{{ route('admin.pelamar.status', $lamaran->id) }}" method="POST"
            onsubmit="return confirm('Yakin ingin mengubah status pelamar ini?')">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-red-400">
                        @foreach(['pending','review','diterima','ditolak','selesai'] as $s)
                            <option value="{{ $s }}" {{ $lamaran->status === $s ? 'selected' : '' }}>
                                {{ ucfirst($s) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Catatan Admin</label>
                    <textarea name="catatan_admin" rows="2"
                        class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-red-400 resize-none"
                        placeholder="Opsional...">{{ $lamaran->catatan_admin }}</textarea>
                </div>
            </div>
            <button type="submit"
                class="mt-5 bg-red-600 text-white px-8 py-2.5 rounded-xl text-sm font-bold hover:bg-red-700 transition">
                Simpan Perubahan
            </button>
        </form>
    </div>
@endsection
