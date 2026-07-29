<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimoniController extends Controller
{
    // Halaman publik testimoni
    public function index()
    {
        $testimonis = Testimoni::with('user')
            ->where('is_approved', true)
            ->latest()
            ->get();
        return view('testimoni', compact('testimonis'));
    }

    // Pelamar kirim testimoni
    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string|max:500',
        ]);

        // Cek apakah sudah pernah kirim
        $sudahAda = Testimoni::where('user_id', Auth::id())->exists();
        if ($sudahAda) {
            return redirect()->back()->with('error', 'Kamu sudah pernah mengirim testimoni!');
        }

        Testimoni::create([
            'user_id'     => Auth::id(),
            'pesan'       => $request->pesan,
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Testimoni berhasil dikirim! Menunggu persetujuan admin.');
    }
}