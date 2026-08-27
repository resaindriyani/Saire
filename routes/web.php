<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\InterviewController;
use App\Http\Controllers\Admin\LowonganController;
use App\Http\Controllers\Admin\TestimoniController as AdminTestimoniController;
use App\Http\Controllers\Admin\PesanController as AdminPesanController;
use App\Http\Controllers\Pelamar\DashboardController as PelamarDashboard;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

// ==========================================
// 1. RUTE UMUM
// ==========================================
Route::get('/', [HomeController::class, 'index']);
Route::get('/tentang', function () { return view('tentang'); });

Route::get('/kontak', function () { return view('kontak'); });
Route::get('/testimoni', [TestimoniController::class, 'index'])->name('testimoni');
Route::get('/lowongan', [LowonganController::class, 'publik'])->name('lowongan.publik');

// ==========================================
// 2. RUTE AUTHENTIKASI & VERIFIKASI
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
        return redirect()->route('pelamar.dashboard')->with('success', 'Email berhasil diverifikasi!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Link verifikasi baru telah dikirim!');
    })->middleware('throttle:6,1')->name('verification.send');
});

// ==========================================
// 3. RUTE DASHBOARD (Proteksi auth + verified)
// ==========================================
Route::middleware(['auth'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/testimoni/store', [TestimoniController::class, 'store'])->name('testimoni.store');

    Route::get('/notif/pesan', function () {
        $count = (auth()->user()->role === 'admin') 
            ? \App\Models\Pesan::where('pengirim', 'pelamar')->where('sudah_dibaca', false)->count()
            : \App\Models\Pesan::where('user_id', auth()->id())->whereIn('pengirim', ['admin', 'bot'])->where('sudah_dibaca', false)->count();
        return response()->json(['count' => $count]);
    })->name('notif.pesan');

    // ADMIN
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::get('/pelamar', [AdminDashboard::class, 'daftarPelamar'])->name('pelamar.index');
        Route::get('/pelamar/{id}', [AdminDashboard::class, 'detailPelamar'])->name('pelamar.detail');
        Route::post('/pelamar/{id}/status', [AdminDashboard::class, 'ubahStatus'])->name('pelamar.status');
        Route::get('/pelamar/{id}/logbook', [AdminDashboard::class, 'logbookPelamar'])->name('pelamar.logbook');
        Route::get('/magang-aktif', [AdminDashboard::class, 'magangAktif'])->name('magang.aktif');
        Route::get('/pelamar/{lamaran_id}/interview', [InterviewController::class, 'create'])->name('interview.create');
        Route::post('/pelamar/{lamaran_id}/interview', [InterviewController::class, 'store'])->name('interview.store');
        Route::delete('/pelamar/{lamaran_id}/interview', [InterviewController::class, 'destroy'])->name('interview.destroy');
        Route::get('/lowongan', [LowonganController::class, 'index'])->name('lowongan.index');
        Route::get('/lowongan/create', [LowonganController::class, 'create'])->name('lowongan.create');
        Route::post('/lowongan', [LowonganController::class, 'store'])->name('lowongan.store');
        Route::get('/lowongan/{id}/edit', [LowonganController::class, 'edit'])->name('lowongan.edit');
        Route::put('/lowongan/{id}', [LowonganController::class, 'update'])->name('lowongan.update');
        Route::delete('/lowongan/{id}', [LowonganController::class, 'destroy'])->name('lowongan.destroy');
        Route::get('/testimoni', [AdminTestimoniController::class, 'index'])->name('testimoni.index');
        Route::post('/testimoni/{id}/approve', [AdminTestimoniController::class, 'approve'])->name('testimoni.approve');
        Route::delete('/testimoni/{id}', [AdminTestimoniController::class, 'reject'])->name('testimoni.reject');
        Route::get('/pesan', [AdminPesanController::class, 'index'])->name('pesan.index');
        Route::get('/pesan/{user_id}', [AdminPesanController::class, 'show'])->name('pesan.show');
        Route::post('/pesan/{user_id}/reply', [AdminPesanController::class, 'reply'])->name('pesan.reply');
    });

    // PELAMAR
    Route::middleware('role:pelamar')->prefix('pelamar')->name('pelamar.')->group(function () {
        Route::get('/dashboard', [PelamarDashboard::class, 'index'])->name('dashboard');
        Route::get('/syarat', [PelamarDashboard::class, 'syarat'])->name('syarat');
        Route::get('/form-pendaftaran', [PelamarDashboard::class, 'form'])->name('form');
        Route::post('/form-pendaftaran', [PelamarDashboard::class, 'simpanForm'])->name('simpanForm');
        Route::get('/logbook', [PelamarDashboard::class, 'logbook'])->name('logbook');
        Route::post('/logbook', [PelamarDashboard::class, 'simpanLogbook'])->name('logbook.simpan');
        Route::delete('/logbook/{id}', [PelamarDashboard::class, 'hapusLogbook'])->name('logbook.hapus');
        
        // Rute Sertifikat
        Route::get('/sertifikat', [PelamarDashboard::class, 'sertifikat'])->name('sertifikat');
        Route::get('/sertifikat/download', [PelamarDashboard::class, 'downloadSertifikat'])->name('sertifikat.download');
        
        Route::get('/profil', [PelamarDashboard::class, 'profil'])->name('profil');
        Route::post('/profil', [PelamarDashboard::class, 'updateProfil'])->name('profil.update');
        Route::get('/interview', [PelamarDashboard::class, 'interview'])->name('interview');
        
        Route::get('/pesan', [PesanController::class, 'index'])->name('pesan.index');
        Route::post('/pesan', [PesanController::class, 'store'])->name('pesan.store');
    });
});
