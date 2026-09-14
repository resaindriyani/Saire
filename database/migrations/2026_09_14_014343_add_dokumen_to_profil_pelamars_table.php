<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profil_pelamars', function (Blueprint $table) {
            $table->string('cv')->nullable()->after('skills');
            $table->string('transkrip')->nullable()->after('cv');
            $table->string('surat_pengantar')->nullable()->after('transkrip');
        });
    }

    public function down(): void
    {
        Schema::table('profil_pelamars', function (Blueprint $table) {
            $table->dropColumn(['cv', 'transkrip', 'surat_pengantar']);
        });
    }
};