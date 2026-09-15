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

        $profilLengkap = $profil
            && $profil->foto
            && $profil->nim_nis
            && $profil->no_hp
            && $profil->institusi
            && $profil->jurusan;

        $jadwal        = null;
        $adaJadwalBaru = false;

        if ($lamaranTerakhir) {
            $jadwal = JadwalInterview::where('lamaran_id', $lamaranTerakhir->id)->first();
            $adaJadwalBaru = JadwalInterview::where('lamaran_id', $lamaranTerakhir->id)
                ->where('sudah_dibaca', false)
                ->exists();
        }

        return view('pelamar.dashboard', compact('user', 'lamaranTerakhir', 'profil', 'adaJadwalBaru', 'jadwal', 'profilLengkap'));
    }

    public function syarat() { return view('pelamar.persyaratan'); }

    public function form(Request $request)
    {
        $user            = Auth::user();
        $lamaranTerakhir = Lamaran::where('user_id', $user->id)->latest()->first();

        if ($lamaranTerakhir && $lamaranTerakhir->status !== 'ditolak') {
            return redirect()->route('pelamar.dashboard')
                ->with('error', 'Kamu sudah memiliki lamaran yang sedang diproses.');
        }

        $lowongans = \App\Models\Lowongan::where('status', 'buka')
            ->whereDate('tgl_tutup', '>=', now())
            ->orderBy('tgl_tutup', 'asc')
            ->get();

        $lowonganTerpilih = $request->query('lowongan_id');

        return view('pelamar.form-pendaftaran', compact('lowongans', 'lowonganTerpilih'));
    }

    public function simpanForm(Request $request)
    {
        $user            = Auth::user();
        $lamaranTerakhir = Lamaran::where('user_id', $user->id)->latest()->first();

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
            'tgl_selesai'  => now()->addMonths((int) $request->durasi_bulan)->toDateString(),
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
        $user   = Auth::user();
        $profil = ProfilPelamar::firstOrCreate(['user_id' => $user->id]);

        $request->validate([
            'foto'            => ($profil->foto ? 'nullable' : 'required') . '|image|mimes:jpg,jpeg,png|max:2048',
            'nim_nis'         => 'required|string|max:50',
            'no_hp'           => 'required|string|max:20',
            'institusi'       => 'required|string|max:255',
            'jurusan'         => 'required|string|max:255',
            'bio'             => 'nullable|string|max:255',
            'instagram'       => 'nullable|string|max:100',
            'tiktok'          => 'nullable|string|max:100',
            'linkedin'        => 'nullable|string|max:100',
            'github'          => 'nullable|string|max:100',
            'skills'          => 'nullable|string|max:255',
            'cv'              => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'transkrip'       => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
            'surat_pengantar' => 'nullable|file|mimes:pdf,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $profil->foto = $request->file('foto')->store('foto-profil', 'public');
        }

        if ($request->hasFile('cv')) {
            $profil->cv = $request->file('cv')->store('dokumen/cv', 'public');
        }

        if ($request->hasFile('transkrip')) {
            $profil->transkrip = $request->file('transkrip')->store('dokumen/transkrip', 'public');
        }

        if ($request->hasFile('surat_pengantar')) {
            $profil->surat_pengantar = $request->file('surat_pengantar')->store('dokumen/surat_pengantar', 'public');
        }

        $profil->nim_nis   = $request->nim_nis;
        $profil->no_hp     = $request->no_hp;
        $profil->institusi = $request->institusi;
        $profil->jurusan   = $request->jurusan;
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

    public function lamar(Request $request, $lowonganId)
    {
        $user            = Auth::user();
        $lamaranTerakhir = Lamaran::where('user_id', $user->id)->latest()->first();

        if ($lamaranTerakhir && $lamaranTerakhir->status !== 'ditolak') {
            return redirect()->route('pelamar.dashboard')
                ->with('error', 'Kamu sudah memiliki lamaran yang sedang diproses.');
        }

        $profil = ProfilPelamar::where('user_id', $user->id)->first();

        if (!$profil || !$profil->cv || !$profil->transkrip || !$profil->surat_pengantar) {
            return redirect()->route('pelamar.profil')
                ->with('error', 'Lengkapi dokumen (CV, Transkrip, Surat Pengantar) di halaman Profil terlebih dahulu sebelum melamar.');
        }

        if (!$profil->institusi) {
            return redirect()->route('pelamar.profil')
                ->with('error', 'Lengkapi data Universitas di halaman Profil terlebih dahulu sebelum melamar.');
        }

        $lowongan = \App\Models\Lowongan::findOrFail($lowonganId);

        $lamaran = Lamaran::create([
            'user_id'      => $user->id,
            'lowongan_id'  => $lowongan->id,
            'universitas'  => $profil->institusi,
            'tgl_mulai'    => now()->toDateString(),
            'tgl_selesai'  => now()->addMonths($lowongan->durasi_bulan)->toDateString(),
            'durasi_bulan' => $lowongan->durasi_bulan,
            'status'       => 'pending',
        ]);

        $dokumenMap = [
            'cv'              => $profil->cv,
            'transkrip'       => $profil->transkrip,
            'surat_pengantar' => $profil->surat_pengantar,
        ];

        foreach ($dokumenMap as $jenis => $path) {
            DokumenLamaran::create([
                'lamaran_id'    => $lamaran->id,
                'jenis'         => $jenis,
                'path_file'     => $path,
                'original_name' => basename($path),
            ]);
        }

        return redirect()->route('pelamar.lowongan.show', $lowongan->id)
            ->with('success', 'Lamaran berhasil dikirim!');
    }

    public function showLowongan($id)
    {
        $lowongan = \App\Models\Lowongan::findOrFail($id);
        $user     = Auth::user();

        $lamaranAktif = Lamaran::where('user_id', $user->id)
            ->where('lowongan_id', $id)
            ->whereIn('status', ['pending', 'review', 'diterima'])
            ->latest()
            ->first();

        return view('pelamar.lowongan-detail', compact('lowongan', 'lamaranAktif'));
    }

    public function batalLamaran($id)
    {
        $user    = Auth::user();
        $lamaran = Lamaran::where('user_id', $user->id)
            ->where('lowongan_id', $id)
            ->where('status', 'pending')
            ->first();

        if (!$lamaran) {
            return back()->with('error', 'Lamaran tidak ditemukan atau tidak bisa dibatalkan.');
        }

        $lamaran->delete();

        return redirect()->route('pelamar.lowongan.show', $id)
            ->with('success', 'Lamaran berhasil dibatalkan.');
    }

    public function lowongan()
    {
        $lowongans = \App\Models\Lowongan::where('status', 'buka')
            ->whereDate('tgl_tutup', '>=', now())
            ->orderBy('tgl_tutup', 'asc')
            ->get();

        return view('pelamar.lowongan', compact('lowongans'));
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