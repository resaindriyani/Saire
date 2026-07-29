<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_pelamars', function (Blueprint $table) {
            $table->string('nim_nis')->nullable()->change();
            $table->string('institusi')->nullable()->change();
            $table->string('jurusan')->nullable()->change();
            $table->string('no_hp')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('profil_pelamars', function (Blueprint $table) {
            $table->string('nim_nis')->nullable(false)->change();
            $table->string('institusi')->nullable(false)->change();
            $table->string('jurusan')->nullable(false)->change();
            $table->string('no_hp')->nullable(false)->change();
        });
    }
};