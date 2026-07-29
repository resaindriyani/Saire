@extends('layouts.dashboard')

@section('title', 'Magang Aktif - SiMagang Telkom')

@section('content')

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Magang Aktif 🟢</h1>
                <p class="text-gray-600 mt-1">Peserta magang yang sedang berjalan saat ini.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
                class="text-sm font-bold text-gray-500 hover:text-red-600 transition">← Dashboard</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if($lamarans->count() > 0)
            <div class="p-6 border-b border-gray-100 bg-emerald-50">
                <p class="text-sm font-semibold text-emerald-700">
                    🟢 <strong>{{ $lamarans->count() }} peserta</strong> sedang aktif magang hari ini
                </p>
            </div>
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Universitas</th>
                        <th class="px-6 py-4 font-semibold">Mulai</th>
                        <th class="px-6 py-4 font-semibold">Selesai</th>
                        <th class="px-6 py-4 font-semibold">Sisa Hari</th>
                        <th class="px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lamarans as $lamaran)
                        @php
                            $sisaHari = (int) now()->diffInDays($lamaran->tgl_selesai, false);
                        @endphp
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $lamaran->user->name }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $lamaran->universitas }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($lamaran->tgl_mulai)->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ \Carbon\Carbon::parse($lamaran->tgl_selesai)->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $sisaHari <= 7 ? 'bg-red-100 text-red-600' : ($sisaHari <= 30 ? 'bg-yellow-100 text-yellow-600' : 'bg-green-100 text-green-600') }}">
                                    {{ $sisaHari }} hari
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.pelamar.detail', $lamaran->id) }}"
                                    class="text-red-600 hover:underline font-medium">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-16">
                <div class="text-5xl mb-4">📭</div>
                <h2 class="text-lg font-bold text-gray-700">Tidak Ada Magang Aktif</h2>
                <p class="text-sm text-gray-400 mt-2">Belum ada peserta yang sedang aktif magang hari ini.</p>
            </div>
        @endif
    </div>

@endsection
