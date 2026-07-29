@extends('layouts.dashboard')

@section('title', 'Logbook - SiMagang Telkom')

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Header --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Logbook Harian 📝</h1>
        <p class="text-gray-600 mt-1">Catat dan dokumentasikan kegiatan magang kamu.</p>
    </div>

    {{-- Pesan Berhasil --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 p-4 rounded-xl mb-6 text-sm font-bold">✅ {{ session('success') }}</div>
    @endif

    {{-- Form Tambah Logbook --}}
    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-8">
        <form action="{{ route('pelamar.logbook.simpan') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Judul Kegiatan</label>
                    <input type="text" name="judul_kegiatan" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-red-400 outline-none" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Link Tugas (URL)</label>
                    <input type="url" name="link_tugas" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-red-400 outline-none">
                </div>
            </div>
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Uraian/Penjelasan Detail</label>
                <textarea name="deskripsi_kegiatan" rows="4" class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:ring-2 focus:ring-red-400 outline-none resize-none" required></textarea>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Foto Dokumentasi</label>
                <input type="file" name="foto" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-red-50 file:text-red-700">
            </div>

            <button type="submit" class="bg-red-600 text-white px-8 py-3 rounded-xl text-sm font-bold hover:bg-red-700 transition">Simpan Kegiatan</button>
        </form>
    </div>

    {{-- Daftar Riwayat --}}
    <div class="space-y-4">
        @forelse($logbooks as $log)
            <div class="bg-white border border-gray-100 rounded-2xl p-6 hover:shadow-sm transition">
                <div class="flex justify-between items-start mb-3">
                    <span class="text-[10px] font-bold text-red-600 bg-red-50 px-3 py-1 rounded-full uppercase tracking-widest">
                        {{ \Carbon\Carbon::parse($log->tanggal)->format('d F Y') }}
                    </span>
                    <form action="{{ route('pelamar.logbook.hapus', $log->id) }}" method="POST" onsubmit="return confirm('Hapus?')">
                        @csrf @method('DELETE')
                        <button class="text-gray-400 hover:text-red-600 text-xs font-bold">Hapus</button>
                    </form>
                </div>
                
                <h3 class="text-lg font-black text-gray-900">{{ $log->judul_kegiatan }}</h3>
                <p class="text-gray-600 mt-2 text-sm leading-relaxed bg-gray-50 p-4 rounded-xl border">{{ $log->deskripsi_kegiatan }}</p>
                
                <div class="mt-4 flex gap-4">
                    @if($log->link_tugas)
                        <a href="{{ $log->link_tugas }}" target="_blank" class="text-xs font-bold text-blue-600 hover:underline">🔗 Lihat Tugas</a>
                    @endif
                    @if($log->foto)
                        <a href="{{ asset('storage/' . $log->foto) }}" target="_blank" class="text-xs font-bold text-green-600 hover:underline">📷 Lihat Foto</a>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white rounded-2xl border border-dashed border-gray-300 text-gray-400 text-sm">Belum ada data logbook.</div>
        @endforelse
    </div>
</div>
@endsection
