<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Daftarkan AdminSeeder agar dijalankan oleh sistem
        $this->call([
            AdminSeeder::class,
        ]);
    }
}