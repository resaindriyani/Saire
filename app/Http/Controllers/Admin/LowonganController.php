<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    // Halaman publik
    public function publik()
    {
        $lowongans = Lowongan::where('status', 'buka')
            ->whereDate('tgl_buka', '<=', now())
            ->whereDate('tgl_tutup', '>=', now())
            ->latest()->get();
        return view('lowongan', compact('lowongans'));
    }

    // Admin - list semua
    public function index()
    {
        $lowongans = Lowongan::latest()->get();
        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('admin.lowongan.form', ['lowongan' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota'     => 'required|integer|min:1',
            'tgl_buka'  => 'required|date',
            'tgl_tutup' => 'required|date|after:tgl_buka',
            'status'    => 'required|in:buka,tutup',
        ]);

        Lowongan::create($request->all());

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil dibuat!');
    }

    public function edit($id)
    {
        $lowongan = Lowongan::findOrFail($id);
        return view('admin.lowongan.form', compact('lowongan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'kuota'     => 'required|integer|min:1',
            'tgl_buka'  => 'required|date',
            'tgl_tutup' => 'required|date|after:tgl_buka',
            'status'    => 'required|in:buka,tutup',
        ]);

        Lowongan::findOrFail($id)->update($request->all());

        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Lowongan::findOrFail($id)->delete();
        return redirect()->route('admin.lowongan.index')
            ->with('success', 'Lowongan berhasil dihapus!');
    }
}