@extends('layouts.dashboard')

@section('title', 'Lowongan - SiMagang Telkom')

@section('content')
<div class="max-w-4xl mx-auto">

    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200 mb-6">
        <h1 class="text-xl font-bold text-gray-900">Lowongan Magang Tersedia</h1>
        <p class="text-gray-500 text-sm mt-0.5">Daftar posisi magang yang sedang dibuka di PT Telkom Indonesia Witel Sukabumi.</p>
    </div>

    @if($lowongans->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($lowongans as $lowongan)
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 hover:border-red-200 hover:shadow-md transition">
                    <h2 class="text-lg font-bold text-gray-800">{{ $lowongan->judul }}</h2>
                    <p class="text-sm text-gray-500 mt-2 leading-relaxed">{{ $lowongan->deskripsi }}</p>

                    <div class="flex items-center gap-4 mt-4 text-xs text-gray-500">
                        <span>Kuota: <strong class="text-gray-700">{{ $lowongan->kuota }} orang</strong></span>
                        <span>Tutup: <strong class="text-gray-700">{{ $lowongan->tgl_tutup->format('d M Y') }}</strong></span>
                    </div>

                    <a href="{{ route('pelamar.lowongan.show', $lowongan->id) }}"
                        class="inline-flex mt-4 bg-red-600 text-white px-5 py-2 rounded-xl text-sm font-bold hover:bg-red-700 transition">
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="bg-yellow-50 border border-yellow-200 rounded-2xl p-6 text-sm text-yellow-700">
            Belum ada lowongan yang tersedia saat ini. Silahkan cek kembali nanti.
        </div>
    @endif

</div>
    {{-- Modal Konfirmasi --}}
    <div id="modal-konfirmasi" class="hidden fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl p-6 max-w-sm w-full shadow-xl">
            <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi Pendaftaran</h3>
            <p class="text-sm text-gray-500 mb-6">
                Yakin ingin melamar posisi <strong id="modal-judul-lowongan"></strong>? Dokumen (CV, Transkrip, Surat Pengantar) dari profil kamu akan digunakan.
            </p>
            <form id="form-lamar" method="POST" action="">
                @csrf
                <div class="flex gap-3">
                    <button type="button" onclick="tutupModal()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 rounded-xl text-sm transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-2.5 rounded-xl text-sm transition">
                        Ya, Lamar Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const baseLamarUrl = "{{ route('pelamar.lamar', ['id' => '__ID__']) }}";
        function konfirmasiLamar(id, judul) {
            document.getElementById('modal-judul-lowongan').textContent = judul;
            document.getElementById('form-lamar').action = baseLamarUrl.replace('__ID__', id);
            document.getElementById('modal-konfirmasi').classList.remove('hidden');
        }

        function tutupModal() {
            document.getElementById('modal-konfirmasi').classList.add('hidden');
        }
    </script>
@endsection