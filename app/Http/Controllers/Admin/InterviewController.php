<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JadwalInterview;
use App\Models\Lamaran;
use Illuminate\Http\Request;

class InterviewController extends Controller
{
    public function create($lamaran_id)
    {
        $lamaran = Lamaran::with(['user', 'jadwalInterview'])->findOrFail($lamaran_id);
        return view('admin.interview.form', compact('lamaran'));
    }

    public function store(Request $request, $lamaran_id)
    {
        $request->validate([
            'waktu_interview'  => 'required|date',
            'lokasi_atau_link' => 'required|string|max:255',
            'tipe'             => 'required|in:offline,online',
            'catatan'          => 'nullable|string|max:500',
        ]);

        $lamaran = Lamaran::findOrFail($lamaran_id);

        JadwalInterview::updateOrCreate(
            ['lamaran_id' => $lamaran->id],
            [
                'waktu_interview'  => $request->waktu_interview,
                'lokasi_atau_link' => $request->lokasi_atau_link,
                'tipe'             => $request->tipe,
                'catatan'          => $request->catatan,
                'sudah_dibaca'     => false,
            ]
        );

        if ($lamaran->status === 'pending') {
            $lamaran->update(['status' => 'review']);
        }

        return redirect()->route('admin.pelamar.detail', $lamaran_id)
            ->with('success', 'Jadwal interview berhasil disimpan!');
    }

    public function destroy($lamaran_id)
    {
        JadwalInterview::where('lamaran_id', $lamaran_id)->firstOrFail()->delete();

        return redirect()->route('admin.pelamar.detail', $lamaran_id)
            ->with('success', 'Jadwal interview berhasil dihapus.');
    }
}