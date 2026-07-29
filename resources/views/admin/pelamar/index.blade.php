@extends('layouts.dashboard')

@section('title', 'Daftar Pelamar - SiMagang Telkom')

@section('content')
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Daftar Pelamar 📋</h1>
                <p class="text-gray-600 mt-1">Kelola semua data pelamar magang.</p>
            </div>
            <a href="{{ route('admin.dashboard') }}"
                class="text-sm font-bold text-gray-500 hover:text-red-600 transition">
                ← Dashboard
            </a>
        </div>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-100">
                    <th class="pb-3 font-semibold">Nama</th>
                    <th class="pb-3 font-semibold">Universitas</th>
                    <th class="pb-3 font-semibold">Periode</th>
                    <th class="pb-3 font-semibold">Status</th>
                    <th class="pb-3 font-semibold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($lamarans as $lamaran)
                    <tr class="border-b border-gray-50 last:border-0">
                        <td class="py-3 font-medium">{{ $lamaran->user->name }}</td>
                        <td class="py-3 text-gray-600">{{ $lamaran->universitas }}</td>
                        <td class="py-3 text-gray-600">
                            {{ \Carbon\Carbon::parse($lamaran->tgl_mulai)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($lamaran->tgl_selesai)->format('d M Y') }}
                        </td>
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
                        <td colspan="5" class="py-8 text-center text-gray-400">Belum ada pelamar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
