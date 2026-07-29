@extends('layouts.dashboard')

@section('title', 'Jadwal Interview - SiMagang Telkom')

@section('content')

    <div class="mb-6">
        <a href="{{ route('pelamar.dashboard') }}"
            class="text-sm text-gray-500 hover:text-red-600 font-medium">← Kembali ke Dashboard</a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">

        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">📅</div>
            <div>
                <h1 class="text-xl font-bold text-gray-900">Jadwal Interview</h1>
                <p class="text-sm text-gray-500 mt-0.5">Informasi jadwal interview magang kamu</p>
            </div>
        </div>

        @if($jadwal)
            <div class="space-y-4">

                <div class="flex items-start gap-4 p-5 bg-blue-50 border border-blue-100 rounded-xl">
                    <div class="text-2xl">🕐</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-blue-400">Waktu Interview</p>
                        <p class="text-lg font-bold text-gray-800 mt-0.5">
                            {{ $jadwal->waktu_interview->translatedFormat('l, d F Y') }}
                        </p>
                        <p class="text-base font-semibold text-blue-600">
                            {{ $jadwal->waktu_interview->format('H:i') }} WIB
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 bg-gray-50 border border-gray-100 rounded-xl">
                    <div class="text-2xl">{{ $jadwal->tipe === 'online' ? '💻' : '🏢' }}</div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">Tipe Interview</p>
                        <p class="text-base font-bold text-gray-800 mt-0.5">
                            {{ $jadwal->tipe === 'online' ? 'Online (Video Call)' : 'Offline (Tatap Muka)' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-start gap-4 p-5 bg-gray-50 border border-gray-100 rounded-xl">
                    <div class="text-2xl">📍</div>
                    <div class="flex-1">
                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">
                            {{ $jadwal->tipe === 'online' ? 'Link Meeting' : 'Lokasi' }}
                        </p>
                        @if($jadwal->tipe === 'online' && str_starts_with($jadwal->lokasi_atau_link, 'http'))
                            <a href="{{ $jadwal->lokasi_atau_link }}" target="_blank"
                                class="text-base font-bold text-blue-600 hover:underline mt-0.5 break-all block">
                                {{ $jadwal->lokasi_atau_link }}
                            </a>
                            <a href="{{ $jadwal->lokasi_atau_link }}" target="_blank"
                                class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl text-sm transition">
                                🔗 Buka Link Meeting
                            </a>
                        @else
                            <p class="text-base font-bold text-gray-800 mt-0.5">{{ $jadwal->lokasi_atau_link }}</p>
                        @endif
                    </div>
                </div>

                @if($jadwal->catatan)
                    <div class="flex items-start gap-4 p-5 bg-yellow-50 border border-yellow-100 rounded-xl">
                        <div class="text-2xl">📋</div>
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-yellow-500">Catatan dari Admin</p>
                            <p class="text-sm text-gray-700 mt-1 leading-relaxed">{{ $jadwal->catatan }}</p>
                        </div>
                    </div>
                @endif

                <div class="mt-6 p-5 bg-green-50 border border-green-100 rounded-xl">
                    <p class="text-sm font-bold text-green-700 mb-2">💡 Tips Interview</p>
                    <ul class="text-sm text-green-700 space-y-1">
                        <li>• Hadir tepat waktu atau 5-10 menit lebih awal</li>
                        <li>• Berpakaian rapi dan profesional</li>
                        <li>• Siapkan dokumen pendukung (CV, transkrip, dll)</li>
                        <li>• Pelajari profil PT Telkom Indonesia sebelum interview</li>
                    </ul>
                </div>

            </div>
        @else
            <div class="text-center py-16">
                <div class="text-5xl mb-4">📭</div>
                <h2 class="text-lg font-bold text-gray-700">Belum Ada Jadwal Interview</h2>
                <p class="text-sm text-gray-400 mt-2">Jadwal interview akan muncul di sini setelah admin menjadwalkannya.</p>
                <a href="{{ route('pelamar.dashboard') }}"
                    class="inline-block mt-6 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                    Kembali ke Dashboard
                </a>
            </div>
        @endif
    </div>

@endsection
