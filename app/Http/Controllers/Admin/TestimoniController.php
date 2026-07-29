<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimoni;

class TestimoniController extends Controller
{
    public function index()
    {
        $testimonis = Testimoni::with('user')->latest()->get();
        return view('admin.testimoni', compact('testimonis'));
    }

    public function approve($id)
    {
        Testimoni::findOrFail($id)->update(['is_approved' => true]);
        return redirect()->back()->with('success', 'Testimoni berhasil disetujui!');
    }

    public function reject($id)
    {
        Testimoni::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Testimoni berhasil dihapus!');
    }
}