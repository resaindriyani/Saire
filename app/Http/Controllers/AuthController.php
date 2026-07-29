<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ProfilPelamar;
use App\Models\Lamaran;
use App\Models\DokumenLamaran;
use App\Models\Lowongan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('pelamar.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang kamu masukkan salah.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        $lowongans = Lowongan::where('status', 'buka')
            ->whereDate('tgl_buka', '<=', now())
            ->whereDate('tgl_tutup', '>=', now())
            ->get();
        return view('auth.register', compact('lowongans'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users',
            'password'         => 'required|string|min:8|confirmed',
            'nim_nis'          => 'nullable|string|max:50',
            'institusi'        => 'nullable|string|max:255',
            'jurusan'          => 'nullable|string|max:255',
            'no_hp'            => 'nullable|string|max:20',
            'bio'              => 'nullable|string|max:255',
            'instagram'        => 'nullable|string|max:100',
            'tiktok'           => 'nullable|string|max:100',
            'linkedin'         => 'nullable|string|max:100',
            'github'           => 'nullable|string|max:100',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lowongan_id'      => 'nullable|exists:lowongans,id',
            'universitas'      => 'nullable|string|max:255',
            'durasi_bulan'     => 'nullable|integer|min:1',
            'cv'               => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'transkrip'        => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'surat_pengantar'  => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
        ]);

        // Buat user
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'pelamar',
        ]);

        // Simpan profil
        $profil = ProfilPelamar::create([
            'user_id'   => $user->id,
            'nim_nis'   => $request->nim_nis ?? '-',
            'institusi' => $request->institusi ?? '-',
            'jurusan'   => $request->jurusan ?? '-',
            'no_hp'     => $request->no_hp ?? '-',
            'bio'       => $request->bio,
            'instagram' => $request->instagram,
            'tiktok'    => $request->tiktok,
            'linkedin'  => $request->linkedin,
            'github'    => $request->github,
        ]);

        // Upload foto profil
        if ($request->hasFile('foto')) {
            $profil->foto = $request->file('foto')->store('foto-profil', 'public');
            $profil->save();
        }

        // Simpan lamaran jika ada CV
        if ($request->hasFile('cv')) {
            $lamaran = Lamaran::create([
                'user_id'      => $user->id,
                'universitas'  => $request->universitas ?? $request->institusi ?? '-',
                'tgl_mulai'    => now()->toDateString(),
                'tgl_selesai'  => now()->addMonths($request->durasi_bulan ?? 3)->toDateString(),
                'durasi_bulan' => $request->durasi_bulan ?? 3,
                'status'       => 'pending',
            ]);

            foreach (['cv', 'transkrip', 'surat_pengantar'] as $jenis) {
                if ($request->hasFile($jenis)) {
                    $path = $request->file($jenis)->store('dokumen/' . $jenis, 'public');
                    DokumenLamaran::create([
                        'lamaran_id'    => $lamaran->id,
                        'jenis'         => $jenis,
                        'path_file'     => $path,
                        'original_name' => $request->file($jenis)->getClientOriginalName(),
                    ]);
                }
            }
        }

        event(new Registered($user));
        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('verification.notice');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}