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
        Schema::table('profil_pelamars', function (Blueprint $table) {
            $table->string('foto')->nullable()->after('user_id');
            $table->text('bio')->nullable()->after('foto');
            $table->string('instagram')->nullable()->after('bio');
            $table->string('tiktok')->nullable()->after('instagram');
            $table->string('github')->nullable()->after('tiktok');
            $table->string('linkedin')->nullable()->after('github');
            $table->string('jurusan')->nullable()->after('linkedin');
            $table->string('skills')->nullable()->after('jurusan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profil_pelamars', function (Blueprint $table) {
            $table->dropColumn([
                'foto', 
                'bio', 
                'instagram', 
                'tiktok', 
                'github', 
                'linkedin', 
                'jurusan', 
                'skills'
            ]);
        });
    }
};