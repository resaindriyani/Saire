<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lamaran_id')->constrained('lamarans')->onDelete('cascade');
            $table->dateTime('waktu_interview');
            $table->string('lokasi_atau_link');
            $table->enum('tipe', ['offline', 'online'])->default('offline');
            $table->text('catatan')->nullable();
            $table->boolean('sudah_dibaca')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_interviews');
    }
};