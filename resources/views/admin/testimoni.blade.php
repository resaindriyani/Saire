@extends('layouts.dashboard')

@section('title', 'Testimoni - SiMagang Telkom')

@section('content')

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Testimoni 💬</h1>
        <p class="text-gray-600 mt-1">Kelola dan setujui testimoni dari peserta magang.</p>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden">
        @if($testimonis->count() > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-gray-500 border-b border-gray-100 bg-gray-50">
                        <th class="px-6 py-4 font-semibold">Nama</th>
                        <th class="px-6 py-4 font-semibold">Pesan</th>
                        <th class="px-6 py-4 font-semibold">Tanggal</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($testimonis as $testimoni)
                        <tr class="border-b border-gray-50 last:border-0 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 font-medium text-gray-800">{{ $testimoni->user->name }}</td>
                            <td class="px-6 py-4 text-gray-600 max-w-xs">
                                <p class="line-clamp-2">{{ $testimoni->pesan }}</p>
                            </td>
                            <td class="px-6 py-4 text-gray-500">{{ $testimoni->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4">
                                @if($testimoni->is_approved)
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Disetujui</span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">Menunggu</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @if(!$testimoni->is_approved)
                                        <form action="{{ route('admin.testimoni.approve', $testimoni->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="text-green-600 hover:underline font-medium">✅ Setujui</button>
                                        </form>
                                    @endif
                                    <form action="{{ route('admin.testimoni.reject', $testimoni->id) }}" method="POST"
                                        onsubmit="return confirm('Hapus testimoni ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline font-medium">🗑️ Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="text-center py-16">
                <div class="text-5xl mb-4">💬</div>
                <h2 class="text-lg font-bold text-gray-700">Belum Ada Testimoni</h2>
                <p class="text-sm text-gray-400 mt-2">Belum ada testimoni yang masuk.</p>
            </div>
        @endif
    </div>

@endsection