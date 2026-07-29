@extends('layouts.dashboard')

@section('title', 'Dashboard Admin - SiMagang Telkom')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Admin 👨‍💼</h1>
        <p class="text-gray-600 mt-1">Kelola data pelamar magang Telkom Sukabumi.</p>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 text-center">
            <p class="text-3xl font-extrabold text-gray-800">{{ $totalPelamar }}</p>
            <p class="text-sm text-gray-500 mt-1">Total Pelamar</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-yellow-100 text-center">
            <p class="text-3xl font-extrabold text-yellow-500">{{ $pending }}</p>
            <p class="text-sm text-gray-500 mt-1">Pending</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-green-100 text-center">
            <p class="text-3xl font-extrabold text-green-500">{{ $diterima }}</p>
            <p class="text-sm text-gray-500 mt-1">Diterima</p>
        </div>
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-red-100 text-center">
            <p class="text-3xl font-extrabold text-red-500">{{ $ditolak }}</p>
            <p class="text-sm text-gray-500 mt-1">Ditolak</p>
        </div>
        <a href="{{ route('admin.magang.aktif') }}"
            class="bg-white p-6 rounded-2xl shadow-sm border border-emerald-200 text-center hover:shadow-md transition group">
            <p class="text-3xl font-extrabold text-emerald-500 group-hover:scale-110 transition-transform">{{ $aktif }}</p>
            <p class="text-sm text-gray-500 mt-1">Magang Aktif</p>
        </a>
    </div>

    {{-- Tabel Pelamar Terbaru --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-lg font-bold text-gray-800">Pelamar Terbaru</h2>
            <a href="{{ route('admin.pelamar.index') }}"
                class="text-sm font-bold text-red-600 hover:underline">Lihat Semua →</a>
        </div>
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-100">
                    <th class="pb-3 font-semibold">Nama</th>
                    <th class="pb-3 font-semibold">Universitas</th>
                    <th class="pb-3 font-semibold">Status</th>
                    <th class="pb-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lamaranTerbaru as $lamaran)
                    <tr class="border-b border-gray-50 last:border-0">
                        <td class="py-3 font-medium">{{ $lamaran->user->name }}</td>
                        <td class="py-3 text-gray-600">{{ $lamaran->universitas }}</td>
                        <td class="py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $lamaran->status === 'diterima' ? 'bg-green-100 text-green-700' : '' }}
                                {{ $lamaran->status === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                {{ $lamaran->status === 'ditolak' ? 'bg-red-100 text-red-700' : '' }}
                                {{ $lamaran->status === 'review' ? 'bg-blue-100 text-blue-700' : '' }}
                                {{ $lamaran->status === 'selesai' ? 'bg-gray-100 text-gray-700' : '' }}">
                                {{ ucfirst($lamaran->status) }}
                            </span>
                        </td>
                        <td class="py-3">
                            <a href="{{ route('admin.pelamar.detail', $lamaran->id) }}"
                                class="text-red-600 hover:underline font-medium">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-gray-400">Belum ada pelamar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection