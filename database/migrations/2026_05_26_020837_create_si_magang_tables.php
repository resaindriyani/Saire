<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Modifikasi tabel users bawaan untuk menambahkan kolom role
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin', 'pelamar'])->default('pelamar')->after('password');
            }
        });

        // 1. TABEL PROFIL_PELAMARS
        Schema::create('profil_pelamars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nim_nis');
            $table->string('institusi');
            $table->string('jurusan');
            $table->string('no_hp');
            $table->timestamps();
        });

        // 2. TABEL LAMARANS
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tgl_mulai');
            $table->date('tgl_selesai');
            $table->integer('durasi_bulan');
            $table->enum('status', ['pending', 'review', 'diterima', 'ditolak', 'selesai'])->default('pending');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });

        // 3. TABEL DOKUMEN_LAMARANS
        Schema::create('dokumen_lamarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('lamarans')->onDelete('cascade');
            $table->enum('jenis', ['cv', 'transkrip', 'surat_pengantar']);
            $table->string('path_file');
            $table->string('original_name');
            $table->timestamps();
        });

        // 4. TABEL LOGBOOKS (DILENGKAPI)
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('lamarans')->onDelete('cascade');
            $table->date('tanggal');
            $table->string('judul_kegiatan');
            $table->text('deskripsi_kegiatan');
            $table->string('link_tugas')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });

        // 5. TABEL KOMENTAR_LOGBOOKS
        Schema::create('komentar_logbooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('logbook_id')->constrained('logbooks')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('komentar');
            $table->timestamps();
        });

        // 6. TABEL SERTIFIKATS
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('lamarans')->onDelete('cascade');
            $table->string('nomor_sertifikat')->unique();
            $table->date('tgl_terbit');
            $table->string('path_pdf');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
        Schema::dropIfExists('komentar_logbooks');
        Schema::dropIfExists('logbooks');
        Schema::dropIfExists('dokumen_lamarans');
        Schema::dropIfExists('lamarans');
        Schema::dropIfExists('profil_pelamars');
        
        if (Schema::hasColumn('users', 'role')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('role');
            });
        }
    }
};