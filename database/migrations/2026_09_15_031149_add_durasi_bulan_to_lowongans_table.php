<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->unsignedInteger('durasi_bulan')->default(3)->after('kuota');
        });
    }

    public function down(): void
    {
        Schema::table('lowongans', function (Blueprint $table) {
            $table->dropColumn('durasi_bulan');
        });
    }
};