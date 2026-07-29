@extends('layouts.dashboard')

@section('title', 'Chat - ' . $pelamar->name)

@section('content')
<div class="max-w-4xl mx-auto h-[calc(100vh-160px)] flex flex-col">
    
    {{-- Header Chat --}}
    <div class="bg-white p-4 rounded-t-2xl border-b border-gray-100 flex items-center justify-between shadow-sm">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-red-600 flex items-center justify-center text-white font-bold text-sm shadow-md">
                {{ strtoupper(substr($pelamar->name, 0, 1)) }}
            </div>
            <div>
                <h2 class="font-bold text-gray-800">{{ $pelamar->name }}</h2>
                <p class="text-[10px] text-green-500 font-medium">● Online</p>
            </div>
        </div>
        <a href="{{ route('admin.pesan.index') }}" class="text-gray-400 hover:text-red-600">
            <span class="text-lg">✕</span>
        </a>
    </div>

    {{-- Chat Area --}}
    <div id="chat-box" class="flex-1 overflow-y-auto p-6 bg-gray-50 space-y-6">
        @foreach($pesans as $pesan)
            <div class="flex {{ $pesan->pengirim === 'admin' ? 'justify-end' : 'justify-start' }}">
                <div class="max-w-[70%] group">
                    <div class="{{ $pesan->pengirim === 'admin' 
                        ? 'bg-red-600 text-white rounded-2xl rounded-tr-none' 
                        : 'bg-white border border-gray-200 text-gray-800 rounded-2xl rounded-tl-none shadow-sm' }} 
                        px-5 py-3 text-sm leading-relaxed">
                        {{ $pesan->pesan }}
                    </div>
                    <p class="text-[10px] text-gray-400 mt-1 {{ $pesan->pengirim === 'admin' ? 'text-right' : 'text-left' }}">
                        {{ $pesan->created_at->format('H:i') }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Input Area --}}
    <div class="bg-white p-4 rounded-b-2xl border-t border-gray-100">
        <form action="{{ route('admin.pesan.reply', $pelamar->id) }}" method="POST" class="flex gap-2">
            @csrf
            <input type="text" name="pesan" placeholder="Ketik balasan..." 
                   class="flex-1 bg-gray-50 border-none rounded-full px-6 py-3 text-sm focus:ring-2 focus:ring-red-500 outline-none" 
                   autocomplete="off" required>
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white p-3 rounded-full shadow-lg transition transform hover:scale-105">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
            </button>
        </form>
    </div>
</div>

<script>
    const chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;
</script>
@endsection