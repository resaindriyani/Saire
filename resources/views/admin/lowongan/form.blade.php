@extends('layouts.dashboard')

@section('title', ($lowongan ? 'Edit' : 'Buat') . ' Lowongan - SiMagang Telkom')

@section('content')

    <div class="mb-6">
        <a href="{{ route('admin.lowongan.index') }}"
            class="text-sm text-gray-500 hover:text-red-600 font-medium">← Kembali ke Lowongan</a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">

        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center text-2xl">📋</div>
            <div>
                <h1 class="text-xl font-bold text-gray-900">{{ $lowongan ? 'Edit' : 'Buat' }} Lowongan</h1>
                <p class="text-sm text-gray-500 mt-0.5">{{ $lowongan ? 'Perbarui informasi lowongan' : 'Isi form berikut untuk membuat lowongan baru' }}</p>
            </div>
        </div>

        <form action="{{ $lowongan ? route('admin.lowongan.update', $lowongan->id) : route('admin.lowongan.store') }}"
            method="POST" class="space-y-6">
            @csrf
            @if($lowongan) @method('PUT') @endif

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Lowongan</label>
                <input type="text" name="judul" value="{{ $lowongan->judul ?? '' }}"
                    placeholder="Contoh: Frontend Developer Intern"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 @error('judul') border-red-400 @enderror">
                @error('judul') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="5"
                    placeholder="Jelaskan posisi, tugas, dan kualifikasi yang dibutuhkan..."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 resize-none @error('deskripsi') border-red-400 @enderror">{{ $lowongan->deskripsi ?? '' }}</textarea>
                @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kuota Peserta</label>
                <input type="number" name="kuota" value="{{ $lowongan->kuota ?? '' }}" min="1"
                    placeholder="Contoh: 5"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 @error('kuota') border-red-400 @enderror">
                @error('kuota') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Buka</label>
                    <input type="date" name="tgl_buka"
                        value="{{ $lowongan ? $lowongan->tgl_buka->format('Y-m-d') : '' }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 @error('tgl_buka') border-red-400 @enderror">
                    @error('tgl_buka') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Tutup</label>
                    <input type="date" name="tgl_tutup"
                        value="{{ $lowongan ? $lowongan->tgl_tutup->format('Y-m-d') : '' }}"
                        class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 @error('tgl_tutup') border-red-400 @enderror">
                    @error('tgl_tutup') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="buka"
                            {{ (!$lowongan || $lowongan->status === 'buka') ? 'checked' : '' }}
                            class="accent-red-600">
                        <span class="text-sm font-medium text-gray-700">🟢 Buka</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="status" value="tutup"
                            {{ ($lowongan && $lowongan->status === 'tutup') ? 'checked' : '' }}
                            class="accent-red-600">
                        <span class="text-sm font-medium text-gray-700">🔴 Tutup</span>
                    </label>
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                    💾 Simpan Lowongan
                </button>
                <a href="{{ route('admin.lowongan.index') }}"
                    class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-sm transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

@endsection