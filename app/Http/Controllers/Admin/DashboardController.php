<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\Sertifikat;
use App\Models\ProfilPelamar;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPelamar   = Lamaran::count();
        $pending        = Lamaran::where('status', 'pending')->count();
        $diterima       = Lamaran::where('status', 'diterima')->count();
        $ditolak        = Lamaran::where('status', 'ditolak')->count();
        $aktif          = Lamaran::where('status', 'diterima')
                            ->whereDate('tgl_mulai', '<=', now())
                            ->whereDate('tgl_selesai', '>=', now())
                            ->count();
        $lamaranTerbaru = Lamaran::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalPelamar', 'pending', 'diterima', 'ditolak', 'aktif', 'lamaranTerbaru'
        ));
    }

    public function magangAktif()
    {
        $lamarans = Lamaran::with(['user', 'dokumen'])
            ->where('status', 'diterima')
            ->whereDate('tgl_mulai', '<=', now())
            ->whereDate('tgl_selesai', '>=', now())
            ->latest()
            ->get();
        return view('admin.magang-aktif', compact('lamarans'));
    }

    public function daftarPelamar()
    {
        $lamarans = Lamaran::with(['user', 'dokumen'])->latest()->get();
        return view('admin.pelamar.index', compact('lamarans'));
    }

    public function detailPelamar($id)
    {
        $lamaran    = Lamaran::with(['user', 'dokumen', 'logbooks', 'jadwalInterview'])->findOrFail($id);
        $sertifikat = Sertifikat::where('lamaran_id', $id)->first();
        $profil     = ProfilPelamar::where('user_id', $lamaran->user_id)->first();
        return view('admin.pelamar.detail', compact('lamaran', 'sertifikat', 'profil'));
    }

    public function ubahStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,review,diterima,ditolak,selesai',
        ]);

        $lamaran = Lamaran::findOrFail($id);
        $lamaran->update([
            'status'        => $request->status,
            'catatan_admin' => $request->catatan_admin,
        ]);

        if ($request->status === 'selesai') {
            $this->generateSertifikat($lamaran);
        }

        return redirect()->route('admin.pelamar.detail', $id)
            ->with('success', 'Status berhasil diubah!');
    }

    private function generateSertifikat(Lamaran $lamaran)
    {
        $existing = Sertifikat::where('lamaran_id', $lamaran->id)->first();
        if ($existing) return;

        $nomorSertifikat = 'CERT-TLK-' . date('Y') . '-' . str_pad($lamaran->id, 4, '0', STR_PAD_LEFT);

        $pdf = Pdf::loadView('admin.sertifikat-template', [
            'lamaran'         => $lamaran,
            'nomorSertifikat' => $nomorSertifikat,
            'tglTerbit'       => now()->format('d F Y'),
        ])->setPaper('a4', 'landscape');

        $filename = 'sertifikat_' . $lamaran->id . '.pdf';
        $path     = 'sertifikat/' . $filename;

        \Storage::disk('public')->put($path, $pdf->output());

        Sertifikat::create([
            'lamaran_id'       => $lamaran->id,
            'nomor_sertifikat' => $nomorSertifikat,
            'tgl_terbit'       => now(),
            'path_pdf'         => $path,
        ]);
    }

    public function logbookPelamar($id)
    {
        $lamaran = Lamaran::with(['user', 'logbooks'])->findOrFail($id);
        return view('admin.pelamar.logbook', compact('lamaran'));
    }
}