@extends('layouts.dashboard')

@section('title', 'Jadwal Interview - ' . $lamaran->user->name)

@section('content')

    <div class="mb-6">
        <a href="{{ route('admin.pelamar.detail', $lamaran->id) }}"
            class="text-sm text-gray-500 hover:text-red-600 font-medium">← Kembali ke Detail Pelamar</a>
    </div>

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">

        <div class="flex items-center gap-4 mb-8 pb-6 border-b border-gray-100">
            <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center text-2xl">📅</div>
            <div>
                <h1 class="text-xl font-bold text-gray-900">
                    {{ $lamaran->jadwalInterview ? 'Edit' : 'Buat' }} Jadwal Interview
                </h1>
                <p class="text-sm text-gray-500 mt-0.5">Pelamar: <strong>{{ $lamaran->user->name }}</strong> — {{ $lamaran->universitas }}</p>
            </div>
        </div>

        @if($lamaran->jadwalInterview)
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 mb-6 text-sm text-blue-700">
                ℹ️ Jadwal interview sudah ada. Simpan form ini untuk <strong>memperbarui</strong> jadwal.
            </div>
        @endif

        <form action="{{ route('admin.interview.store', $lamaran->id) }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal & Waktu Interview</label>
                <input type="datetime-local" name="waktu_interview"
                    value="{{ $lamaran->jadwalInterview ? $lamaran->jadwalInterview->waktu_interview->format('Y-m-d\TH:i') : '' }}"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 @error('waktu_interview') border-red-400 @enderror">
                @error('waktu_interview')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Interview</label>
                <div class="flex gap-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipe" value="offline"
                            {{ (!$lamaran->jadwalInterview || $lamaran->jadwalInterview->tipe === 'offline') ? 'checked' : '' }}
                            class="accent-red-600">
                        <span class="text-sm font-medium text-gray-700">🏢 Offline (Tatap Muka)</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="tipe" value="online"
                            {{ ($lamaran->jadwalInterview && $lamaran->jadwalInterview->tipe === 'online') ? 'checked' : '' }}
                            class="accent-red-600">
                        <span class="text-sm font-medium text-gray-700">💻 Online (Video Call)</span>
                    </label>
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi / Link Interview</label>
                <input type="text" name="lokasi_atau_link" id="input-lokasi"
                    value="{{ $lamaran->jadwalInterview ? $lamaran->jadwalInterview->lokasi_atau_link : '' }}"
                    placeholder="Contoh: Ruang Rapat Lt. 2 / https://meet.google.com/xxx"
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 @error('lokasi_atau_link') border-red-400 @enderror">
                @error('lokasi_atau_link')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan (Opsional)</label>
                <textarea name="catatan" rows="3"
                    placeholder="Contoh: Harap membawa dokumen asli, berpakaian formal, dll."
                    class="w-full border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-red-500 resize-none">{{ $lamaran->jadwalInterview ? $lamaran->jadwalInterview->catatan : '' }}</textarea>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                    💾 Simpan Jadwal
                </button>
                <a href="{{ route('admin.pelamar.detail', $lamaran->id) }}"
                    class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold rounded-xl text-sm transition">
                    Batal
                </a>

                @if($lamaran->jadwalInterview)
                    <form action="{{ route('admin.interview.destroy', $lamaran->id) }}" method="POST" class="ml-auto"
                        onsubmit="return confirm('Hapus jadwal interview ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-6 py-3 bg-red-50 hover:bg-red-100 text-red-600 font-bold rounded-xl text-sm transition border border-red-200">
                            🗑️ Hapus Jadwal
                        </button>
                    </form>
                @endif
            </div>
        </form>
    </div>

    <script>
        document.querySelectorAll('input[name="tipe"]').forEach(radio => {
            radio.addEventListener('change', function () {
                const input = document.getElementById('input-lokasi');
                if (this.value === 'online') {
                    input.placeholder = 'Contoh: https://meet.google.com/xxx-yyy-zzz';
                } else {
                    input.placeholder = 'Contoh: Ruang Rapat Lt. 2, Gedung Telkom Sukabumi';
                }
            });
        });
    </script>

@endsection
