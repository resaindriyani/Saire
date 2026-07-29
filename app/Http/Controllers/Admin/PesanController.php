<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use App\Models\User;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    // Daftar semua user yang punya pesan
    public function index()
    {
        $users = User::where('role', 'pelamar')
            ->whereHas('pesans')
            ->withCount(['pesans as belum_dibaca' => function ($q) {
                $q->where('pengirim', 'pelamar')->where('sudah_dibaca', false);
            }])
            ->get();

        return view('admin.pesan.index', compact('users'));
    }

    // Percakapan dengan satu user
    public function show($user_id)
    {
        $pelamar = User::findOrFail($user_id);
        $pesans  = Pesan::where('user_id', $user_id)
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandai pesan pelamar sudah dibaca
        Pesan::where('user_id', $user_id)
            ->where('pengirim', 'pelamar')
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return view('admin.pesan.show', compact('pelamar', 'pesans'));
    }

    // Admin balas pesan
    public function reply(Request $request, $user_id)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        Pesan::create([
            'user_id'  => $user_id,
            'pengirim' => 'admin',
            'pesan'    => $request->pesan,
        ]);

        return redirect()->route('admin.pesan.show', $user_id)
            ->with('success', 'Pesan berhasil dikirim!');
    }
}