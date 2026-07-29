<?php

namespace App\Http\Controllers\Pelamar;

use App\Http\Controllers\Controller;
use App\Models\Lamaran;
use App\Models\DokumenLamaran;
use Illuminate\Http\Request;

class PelamarController extends Controller
{
    // Halaman syarat pendaftaran
    public function syarat()
    {
        return view('pelamar.syarat');
    }

    // Halaman form pendaftaran
    public function form()
    {
        return view('pelamar.form-pendaftaran');
    }

    // Proses simpan form
    public function simpanForm(Request $request)
    {
        $request->validate([
            'universitas'     => 'required|string|max:255',
            'tgl_mulai'       => 'required|date',
            'tgl_selesai'     => 'required|date|after:tgl_mulai',
            'durasi_bulan'    => 'required|integer|min:1',
            'cv'              => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
            'transkrip'       => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
            'surat_pengantar' => 'required|file|mimes:pdf,jpg,jpeg|max:2048',
        ]);

        $lamaran = Lamaran::create([
            'user_id'      => auth()->id(),
            'universitas'  => $request->universitas,
            'tgl_mulai'    => $request->tgl_mulai,
            'tgl_selesai'  => $request->tgl_selesai,
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
}