<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\DokumenLamaran;
use App\Models\Logbook;
use App\Models\Sertifikat;
use App\Models\ProfilPelamar;
use App\Models\JadwalInterview;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user            = Auth::user();
        $lamaranTerakhir = Lamaran::where('user_id', $user->id)->latest()->first();
        $profil          = ProfilPelamar::where('user_id', $user->id)->first();

        $jadwal        = null;
        $adaJadwalBaru = false;

        if ($lamaranTerakhir) {
            $jadwal = JadwalInterview::where('lamaran_id', $lamaranTerakhir->id)->first();
            $adaJadwalBaru = JadwalInterview::where('lamaran_id', $lamaranTerakhir->id)
                ->where('sudah_dibaca', false)
                ->exists();
        }

        return view('pelamar.dashboard', compact('user', 'lamaranTerakhir', 'profil', 'adaJadwalBaru', 'jadwal'));
    }

    public function syarat() { return view('pelamar.persyaratan'); }

    public function form()
    {
        $user            = Auth::user();
        $lamaranTerakhir = Lamaran::where('user_id', $user->id)->latest()->first();

        // Boleh daftar kalau belum pernah daftar ATAU lamaran terakhir ditolak
        if ($lamaranTerakhir && $lamaranTerakhir->status !== 'ditolak') {
            return redirect()->route('pelamar.dashboard')
                ->with('error', 'Kamu sudah memiliki lamaran yang sedang diproses.');
        }

        return view('pelamar.form-pendaftaran');
    }

    public function simpanForm(Request $request)
    {
        $user            = Auth::user();
        $lamaranTerakhir = Lamaran::where('user_id', $user->id)->latest()->first();

        // Cek apakah boleh daftar lagi
        if ($lamaranTerakhir && $lamaranTerakhir->status !== 'ditolak') {
            return redirect()->route('pelamar.dashboard')
                ->with('error', 'Kamu sudah memiliki lamaran yang sedang diproses.');
        }

        $request->validate([
            'universitas'     => 'required|string|max:255',
            'durasi_bulan'    => 'required|integer|min:1',
            'cv'              => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
            'transkrip'       => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
        ]);

        $lamaran = Lamaran::create([
            'user_id'      => Auth::id(),
            'universitas'  => $request->universitas,
            'tgl_mulai'    => now()->toDateString(),
            'tgl_selesai'  => now()->addMonths($request->durasi_bulan)->toDateString(),
            'durasi_bulan' => $request->durasi_bulan,
            'status'       => 'pending',
        ]);

        foreach (['cv', 'transkrip', 'surat_pengantar'] as $jenis) {
            $path = $request->file($jenis)->store('dokumen/' . $jenis, 'public');
            DokumenLamaran::create([
                'lamaran_id'    => $lamaran->id,
                'jenis'         => $jenis,
                'path_file'     => $path,
                'original_name' => $request->file($jenis)->getClientOriginalName(),
            ]);
        }

        return redirect()->route('pelamar.dashboard')
            ->with('success', 'Pendaftaran berhasil dikirim!');
    }

    public function logbook()
    {
        $user    = Auth::user();
        $lamaran = Lamaran::where('user_id', $user->id)->latest()->first();

        if (!$lamaran || $lamaran->status !== 'diterima') {
            return redirect()->route('pelamar.dashboard')
                ->with('error', 'Logbook hanya tersedia setelah lamaran diterima.');
        }

        $logbooks = Logbook::where('lamaran_id', $lamaran->id)
            ->orderBy('tanggal', 'desc')->get();

        return view('pelamar.logbook', compact('lamaran', 'logbooks'));
    }

    public function simpanLogbook(Request $request)
    {
        $user    = Auth::user();
        $lamaran = Lamaran::where('user_id', $user->id)->latest()->first();

        $request->validate([
            'judul_kegiatan'     => 'required|string|max:255',
            'deskripsi_kegiatan' => 'required|string|max:2000',
            'link_tugas'         => 'nullable|url',
            'foto'               => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('logbook', 'public');
        }

        Logbook::create([
            'lamaran_id'         => $lamaran->id,
            'tanggal'            => now()->toDateString(),
            'judul_kegiatan'     => $request->judul_kegiatan,
            'deskripsi_kegiatan' => $request->deskripsi_kegiatan,
            'link_tugas'         => $request->link_tugas,
            'foto'               => $fotoPath,
        ]);

        return redirect()->route('pelamar.logbook')
            ->with('success', 'Logbook berhasil ditambahkan!');
    }

    public function hapusLogbook($id)
    {
        Logbook::findOrFail($id)->delete();
        return redirect()->route('pelamar.logbook')
            ->with('success', 'Logbook berhasil dihapus!');
    }

    public function sertifikat()
    {
        $user       = Auth::user();
        $lamaran    = Lamaran::where('user_id', $user->id)->latest()->first();
        $sertifikat = $lamaran ? Sertifikat::where('lamaran_id', $lamaran->id)->first() : null;
        return view('pelamar.sertifikat', compact('lamaran', 'sertifikat'));
    }

    public function downloadSertifikat()
    {
        $user       = Auth::user();
        $lamaran    = Lamaran::where('user_id', $user->id)->latest()->first();
        $sertifikat = Sertifikat::where('lamaran_id', $lamaran->id)->firstOrFail();

        return response()->download(storage_path('app/public/' . $sertifikat->path_pdf));
    }

    public function profil()
    {
        $user   = Auth::user();
        $profil = ProfilPelamar::where('user_id', $user->id)->first();
        return view('pelamar.profil', compact('user', 'profil'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'bio'       => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:100',
            'tiktok'    => 'nullable|string|max:100',
            'linkedin'  => 'nullable|string|max:100',
            'github'    => 'nullable|string|max:100',
            'skills'    => 'nullable|string|max:255',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $profil = ProfilPelamar::firstOrCreate(['user_id' => $user->id]);

        if ($request->hasFile('foto')) {
            $profil->foto = $request->file('foto')->store('foto-profil', 'public');
        }

        $profil->bio       = $request->bio;
        $profil->instagram = $request->instagram;
        $profil->tiktok    = $request->tiktok;
        $profil->linkedin  = $request->linkedin;
        $profil->github    = $request->github;
        $profil->skills    = $request->skills;
        $profil->save();

        return redirect()->route('pelamar.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function interview()
    {
        $user    = Auth::user();
        $lamaran = Lamaran::where('user_id', $user->id)->latest()->first();
        $jadwal  = null;

        if ($lamaran) {
            $jadwal = JadwalInterview::where('lamaran_id', $lamaran->id)->first();
            if ($jadwal && !$jadwal->sudah_dibaca) {
                $jadwal->update(['sudah_dibaca' => true]);
            }
        }

        return view('pelamar.interview', compact('lamaran', 'jadwal'));
    }
}