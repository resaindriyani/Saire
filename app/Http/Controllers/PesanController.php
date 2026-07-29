<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PesanController extends Controller
{
    public function index()
    {
        $pesans = Pesan::where('user_id', Auth::id())
            ->orderBy('created_at', 'asc')
            ->get();

        // Tandai pesan admin/bot sudah dibaca
        Pesan::where('user_id', Auth::id())
            ->whereIn('pengirim', ['admin', 'bot'])
            ->where('sudah_dibaca', false)
            ->update(['sudah_dibaca' => true]);

        return view('pelamar.pesan', compact('pesans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string|max:1000',
        ]);

        // Simpan pesan pelamar
        Pesan::create([
            'user_id'  => Auth::id(),
            'pengirim' => 'pelamar',
            'pesan'    => $request->pesan,
        ]);

        // Cek apakah ada pesan manual dari admin sebelumnya
        $adaPesanAdmin = Pesan::where('user_id', Auth::id())
            ->where('pengirim', 'admin')
            ->exists();

        // Kalau belum ada pesan manual admin, kirim balasan bot
        if (!$adaPesanAdmin) {
            $balasanBot = $this->balasBotOtomatis($request->pesan);
            Pesan::create([
                'user_id'  => Auth::id(),
                'pengirim' => 'bot',
                'pesan'    => $balasanBot,
            ]);
        }

        // Gunakan URL langsung bukan route name
        return redirect('/pelamar/pesan');
    }

    private function balasBotOtomatis($pesan)
    {
        $pesan = strtolower($pesan);

        if (str_contains($pesan, 'jadwal') || str_contains($pesan, 'interview')) {
            return 'Halo! Jadwal interview kamu bisa dilihat di menu Interview di dashboard. Jika belum ada jadwal, admin akan segera menghubungi kamu. 📅';
        }

        if (str_contains($pesan, 'status') || str_contains($pesan, 'lamaran')) {
            return 'Halo! Status lamaran kamu bisa dilihat langsung di dashboard utama. Jika ada pertanyaan lebih lanjut, tim kami akan segera membantu. ✅';
        }

        if (str_contains($pesan, 'dokumen') || str_contains($pesan, 'berkas')) {
            return 'Halo! Dokumen yang diperlukan adalah CV, Transkrip Nilai, dan Surat Pengantar dari kampus. Pastikan semua sudah diupload di form pendaftaran. 📄';
        }

        if (str_contains($pesan, 'sertifikat')) {
            return 'Halo! Sertifikat akan tersedia di menu Sertifikat setelah status magang kamu berubah menjadi Selesai. 🎓';
        }

        if (str_contains($pesan, 'halo') || str_contains($pesan, 'hai') || str_contains($pesan, 'hello')) {
            return 'Halo! Selamat datang di SiMagang Telkom. Ada yang bisa kami bantu? 😊';
        }

        if (str_contains($pesan, 'terima kasih') || str_contains($pesan, 'makasih')) {
            return 'Sama-sama! Jika ada pertanyaan lain, jangan ragu untuk menghubungi kami. 😊';
        }

        return 'Halo! Terima kasih sudah menghubungi SiMagang Telkom. Pesan kamu sudah kami terima dan tim kami akan segera membalas. Jam operasional: Senin-Jumat 08.00-16.30 WIB. 🕐';
    }
}