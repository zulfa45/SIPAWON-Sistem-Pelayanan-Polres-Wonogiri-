<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => bcrypt('11223344'),
            'role' => 'admin',
        ]);

        \App\Models\KategoriBerita::create([
            'nama' => 'Berita Umum',
            'slug' => 'berita-umum',
        ]);
    }
}
