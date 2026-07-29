@extends('layouts.dashboard')

@section('title', 'Lowongan Magang - SiMagang Telkom')

@section('content')

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Lowongan Magang 📋</h1>
                <p class="text-gray-600 mt-1">Kelola lowongan magang yang tersedia.</p>
            </div>
            <a href="{{ route('admin.lowongan.create') }}"
                class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                + Buat Lowongan
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if($lowongans->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-4 font-semibold">Judul</th>
                        <th class="px-6 py-4 font-semibold">Kuota</th>
                        <th class="px-6 py-4 font-semibold">Periode</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lowongans as $lowongan)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $lowongan->judul }}</td>
                            <td class="px-6 py-4 text-gray-600">{{ $lowongan->kuota }} orang</td>
                            <td class="px-6 py-4 text-gray-600">
                                {{ $lowongan->tgl_buka->format('d M Y') }} — {{ $lowongan->tgl_tutup->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    {{ $lowongan->status === 'buka' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ ucfirst($lowongan->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <a href="{{ route('admin.lowongan.edit', $lowongan->id) }}"
                                        class="text-blue-600 hover:underline font-medium">Edit</a>
                                    <form action="{{ route('admin.lowongan.destroy', $lowongan->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus lowongan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-medium">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-16">
                <div class="text-5xl mb-4">📭</div>
                <h2 class="text-lg font-bold text-gray-700">Belum Ada Lowongan</h2>
                <p class="text-sm text-gray-400 mt-2">Buat lowongan magang pertama kamu!</p>
                <a href="{{ route('admin.lowongan.create') }}"
                    class="inline-block mt-6 px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                    + Buat Lowongan
                </a>
            </div>
        @endif
    </div>

@endsection