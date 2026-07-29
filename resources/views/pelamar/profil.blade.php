@extends('layouts.dashboard')

@section('title', 'Profil - SiMagang Telkom')

@section('content')
<div class="max-w-2xl mx-auto">

    {{-- Card Profil --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden mb-6">

        {{-- Banner --}}
        <div class="h-32 bg-gradient-to-r from-gray-900 via-slate-800 to-red-950 relative">
            {{-- Foto di tengah bawah banner --}}
            <div class="absolute -bottom-12 left-1/2 -translate-x-1/2">
                @if($profil && $profil->foto)
                    <img src="{{ asset('storage/' . $profil->foto) }}"
                        class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-lg">
                @else
                    <div class="w-24 h-24 rounded-full bg-gradient-to-br from-red-400 to-red-600 border-4 border-white shadow-lg flex items-center justify-center">
                        <span class="text-3xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Info -- rata tengah --}}
        <div class="pt-16 pb-6 px-8 text-center">
            <h1 class="text-xl font-bold text-gray-900">{{ $user->name }}</h1>
            <p class="text-sm text-gray-400 mt-0.5">{{ $user->email }}</p>
            @if($profil && $profil->jurusan)
                <p class="text-xs text-gray-500 mt-1">{{ $profil->jurusan }}</p>
            @endif
            @if($profil && $profil->skills)
                <p class="text-xs text-red-500 font-medium mt-1">{{ $profil->skills }}</p>
            @endif
            @if($profil && $profil->bio)
                <p class="text-gray-600 text-sm mt-3 leading-relaxed max-w-sm mx-auto">{{ $profil->bio }}</p>
            @else
                <p class="text-gray-300 text-sm mt-3 italic">Belum ada bio</p>
            @endif

            {{-- Sosmed --}}
            <div class="flex gap-2 flex-wrap justify-center mt-4">
                @if($profil && $profil->instagram)
                    <a href="https://instagram.com/{{ ltrim($profil->instagram, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 text-white text-xs font-semibold hover:opacity-90 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        {{ ltrim($profil->instagram, '@') }}
                    </a>
                @endif
                @if($profil && $profil->tiktok)
                    <a href="https://tiktok.com/@{{ ltrim($profil->tiktok, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-900 text-white text-xs font-semibold hover:bg-gray-700 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.27 6.27 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.18 8.18 0 004.78 1.52V6.74a4.85 4.85 0 01-1.01-.05z"/></svg>
                        {{ ltrim($profil->tiktok, '@') }}
                    </a>
                @endif
                @if($profil && $profil->linkedin)
                    <a href="https://linkedin.com/in/{{ ltrim($profil->linkedin, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-blue-600 text-white text-xs font-semibold hover:bg-blue-700 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        {{ ltrim($profil->linkedin, '@') }}
                    </a>
                @endif
                @if($profil && $profil->github)
                    <a href="https://github.com/{{ ltrim($profil->github, '@') }}" target="_blank"
                        class="flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-800 text-white text-xs font-semibold hover:bg-gray-600 transition">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                        {{ ltrim($profil->github, '@') }}
                    </a>
                @endif
            </div>
        </div>
    </div>

    {{-- Form Edit --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
        <h2 class="text-lg font-bold text-gray-800 mb-6">Edit Profil</h2>

        <form action="{{ route('pelamar.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil</label>
                <div class="flex items-center gap-4">
                    @if($profil && $profil->foto)
                        <img src="{{ asset('storage/' . $profil->foto) }}"
                            class="w-16 h-16 rounded-full object-cover border-2 border-gray-200">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gradient-to-br from-red-400 to-red-600 flex items-center justify-center">
                            <span class="text-xl font-bold text-white">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                        </div>
                    @endif
                    <div class="flex-1">
                        <input type="file" name="foto" accept="image/jpg,image/jpeg,image/png"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 text-sm file:mr-3 file:py-1.5 file:px-4 file:rounded-lg file:border-0 file:bg-red-50 file:text-red-600 file:font-semibold hover:file:bg-red-100 transition">
                        <p class="text-xs text-gray-400 mt-1">JPG/PNG, maks 2MB</p>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Bio</label>
                <input type="text" name="bio" value="{{ $profil->bio ?? '' }}"
                    placeholder="Ceritakan sedikit tentang dirimu..."
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Jurusan</label>
                <input type="text" name="jurusan" value="{{ $profil->jurusan ?? '' }}"
                    placeholder="Contoh: Teknik Informatika"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Skills</label>
                <input type="text" name="skills" value="{{ $profil->skills ?? '' }}"
                    placeholder="Contoh: Laravel, React, UI/UX Design"
                    class="w-full border border-gray-300 rounded-xl px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-400 transition">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">Instagram</label>
                <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-pink-400 transition">
                    <span class="px-3 py-2.5 bg-gradient-to-b from-pink-50 to-purple-50 text-pink-500 text-sm font-bold border-r border-gray-200">@</span>
                    <input type="text" name="instagram" value="{{ ltrim($profil->instagram ?? '', '@') }}"
                        placeholder="username_instagram"
                        class="flex-1 px-4 py-2.5 text-sm focus:outline-none bg-white">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">TikTok</label>
                <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-gray-400 transition">
                    <span class="px-3 py-2.5 bg-gray-50 text-gray-700 text-sm font-bold border-r border-gray-200">@</span>
                    <input type="text" name="tiktok" value="{{ ltrim($profil->tiktok ?? '', '@') }}"
                        placeholder="username_tiktok"
                        class="flex-1 px-4 py-2.5 text-sm focus:outline-none bg-white">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-1">LinkedIn</label>
                <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-blue-400 transition">
                    <span class="px-3 py-2.5 bg-blue-50 text-blue-600 text-xs font-bold border-r border-gray-200">in/</span>
                    <input type="text" name="linkedin" value="{{ ltrim($profil->linkedin ?? '', '@') }}"
                        placeholder="username_linkedin"
                        class="flex-1 px-4 py-2.5 text-sm focus:outline-none bg-white">
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-1">GitHub</label>
                <div class="flex items-center border border-gray-300 rounded-xl overflow-hidden focus-within:ring-2 focus-within:ring-gray-500 transition">
                    <span class="px-3 py-2.5 bg-gray-800 text-white text-xs font-bold border-r border-gray-600">gh/</span>
                    <input type="text" name="github" value="{{ ltrim($profil->github ?? '', '@') }}"
                        placeholder="username_github"
                        class="flex-1 px-4 py-2.5 text-sm focus:outline-none bg-white">
                </div>
            </div>

            <button type="submit"
                class="w-full bg-red-600 text-white py-3 rounded-xl font-bold hover:bg-red-700 transition text-sm">
                Simpan Profil
            </button>
        </form>
    </div>

</div>
@endsection
