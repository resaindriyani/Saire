<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use App\Models\Testimoni;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $totalAlumni    = Lamaran::where('status', 'selesai')->count();
        $pesertaAktif   = Lamaran::where('status', 'diterima')
                            ->whereDate('tgl_mulai', '<=', now())
                            ->whereDate('tgl_selesai', '>=', now())
                            ->count();
        $totalPendaftar = User::where('role', 'pelamar')->count();
        $lowongans      = Lowongan::where('status', 'buka')
                            ->whereDate('tgl_buka', '<=', now())
                            ->whereDate('tgl_tutup', '>=', now())
                            ->latest()->take(3)->get();
        $testimonis     = Testimoni::with('user')
                            ->where('is_approved', true)
                            ->latest()->take(3)->get();

        return view('welcome', compact(
            'totalAlumni', 'pesertaAktif', 'totalPendaftar', 'lowongans', 'testimonis'
        ));
    }
}