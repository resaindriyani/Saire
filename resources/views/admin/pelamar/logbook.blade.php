@extends('layouts.dashboard')

@section('title', 'Logbook Pelamar - SiMagang Telkom')

@section('content')
    {{-- Header Section --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Logbook: {{ $lamaran->user->name }} 📝</h1>
                <p class="text-gray-600 mt-1">Riwayat kegiatan harian pelamar selama masa magang.</p>
            </div>
            {{-- PERBAIKAN: Gunakan 'admin.pelamar.detail' sesuai dengan route di web.php --}}
            <a href="{{ route('admin.pelamar.detail', $lamaran->id) }}"
                class="text-sm font-bold text-gray-500 hover:text-red-600 transition duration-200">
                ← Kembali ke Detail
            </a>
        </div>
    </div>

    {{-- Logbook List --}}
    <div class="space-y-4">
        @forelse($lamaran->logbooks->sortByDesc('tanggal') as $log)
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:border-red-200 transition-all duration-300">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="inline-block px-3 py-1 rounded-lg bg-red-50 text-red-600 text-xs font-bold uppercase tracking-wider mb-3">
                            {{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}
                        </span>
                        <h3 class="font-bold text-gray-900 mb-1">{{ $log->judul_kegiatan }}</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            {{ $log->deskripsi_kegiatan }}
                        </p>
                        <div class="flex gap-4 mt-3">
                            @if($log->link_tugas)
                                <a href="{{ $log->link_tugas }}" target="_blank" class="text-sm text-blue-600 hover:underline font-semibold">Lihat Tugas</a>
                            @endif
                            @if($log->foto)
                                <a href="{{ asset('storage/' . $log->foto) }}" target="_blank" class="text-sm text-green-600 hover:underline font-semibold">Lihat Foto</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            {{-- Empty State --}}
            <div class="bg-white p-12 rounded-2xl shadow-sm border border-gray-200 text-center">
                <div class="text-6xl mb-4">📭</div>
                <h3 class="text-lg font-bold text-gray-800">Belum ada entri logbook</h3>
                <p class="text-gray-500 text-sm mt-1">Pelamar belum mengisi riwayat kegiatan hariannya.</p>
            </div>
        @endforelse
    </div>
@endsection
