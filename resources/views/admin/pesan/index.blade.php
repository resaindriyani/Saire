@extends('layouts.dashboard')

@section('title', 'Daftar Pesan - Admin SiMagang')

@section('content')
<div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200">
    <h2 class="text-lg font-bold text-gray-800 mb-6">Pesan Masuk</h2>
    
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-500 uppercase border-b border-gray-100">
                <tr>
                    <th class="px-4 py-3">Nama Pelamar</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr class="border-b border-gray-50 hover:bg-gray-50">
                    <td class="px-4 py-4 font-semibold text-gray-900">{{ $user->name }}</td>
                    <td class="px-4 py-4">
                        @if($user->belum_dibaca > 0)
                            <span class="bg-red-100 text-red-600 text-[10px] px-2 py-1 rounded-full font-bold">{{ $user->belum_dibaca }} Pesan Baru</span>
                        @else
                            <span class="text-gray-400">Tidak ada pesan baru</span>
                        @endif
                    </td>
                    <td class="px-4 py-4">
                        <a href="{{ route('admin.pesan.show', $user->id) }}" class="text-red-600 font-bold hover:underline">Buka Chat</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection