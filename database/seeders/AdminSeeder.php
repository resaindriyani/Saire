<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Membuat akun Admin default untuk SiMagang
        User::create([
            'name' => 'Admin HRD Telkom Sukabumi',
            'email' => 'admin@simagang.test',
            'password' => Hash::make('password123'), // Password untuk login
            'role' => 'admin',
        ]);
    }
}