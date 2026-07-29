@extends('layouts.dashboard')

@section('title', 'Pesan - SiMagang Telkom')

@section('content')

<div class="flex flex-col h-full" style="height: calc(100vh - 140px);">

    {{-- Header --}}
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-200 mb-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                <span class="text-white font-bold text-sm">T</span>
            </div>
            <div>
                <p class="font-bold text-gray-900 text-sm">SiMagang Telkom</p>
                <p class="text-xs text-green-500 font-semibold">● Online</p>
            </div>
        </div>
    </div>

    {{-- Chat Area --}}
    <div class="flex-1 bg-white rounded-2xl shadow-sm border border-gray-200 flex flex-col overflow-hidden">

        {{-- Messages --}}
        <div id="chat-box" class="flex-1 overflow-y-auto p-6 space-y-4">
            @if($pesans->count() === 0)
                <div class="text-center py-12">
                    <div class="text-5xl mb-3">💬</div>
                    <p class="text-gray-400 text-sm">Belum ada pesan. Mulai percakapan!</p>
                </div>
            @endif

            @foreach($pesans as $pesan)
                @if($pesan->pengirim === 'pelamar')
                    {{-- Pesan dari pelamar (kanan) --}}
                    <div class="flex justify-end">
                        <div class="max-w-xs lg:max-w-md">
                            <div class="bg-red-600 text-white px-4 py-3 rounded-2xl rounded-tr-sm text-sm leading-relaxed shadow-sm">
                                {{ $pesan->pesan }}
                            </div>
                            <p class="text-xs text-gray-400 mt-1 text-right">{{ $pesan->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                @else
                    {{-- Pesan dari admin (kiri) --}}
                    <div class="flex justify-start gap-3">
                        <div class="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center bg-gray-100">
                            <span class="text-xs">👨‍💼</span>
                        </div>
                        <div class="max-w-xs lg:max-w-md">
                            <p class="text-xs text-gray-400 mb-1">Admin Telkom</p>
                            <div class="bg-gray-100 text-gray-800 px-4 py-3 rounded-2xl rounded-tl-sm text-sm leading-relaxed shadow-sm">
                                {{ $pesan->pesan }}
                            </div>
                            <p class="text-xs text-gray-400 mt-1">{{ $pesan->created_at->format('H:i') }}</p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        {{-- Input --}}
        <div class="border-t border-gray-100 p-4 bg-gray-50">
            <form action="{{ route('pelamar.pesan.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="pesan" placeholder="Ketik pesan..."
                    class="flex-1 border border-gray-200 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-500"
                    autocomplete="off" required>
                <button type="submit"
                    class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-sm transition">
                    Kirim
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    // Auto scroll ke bawah
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>

@endsection