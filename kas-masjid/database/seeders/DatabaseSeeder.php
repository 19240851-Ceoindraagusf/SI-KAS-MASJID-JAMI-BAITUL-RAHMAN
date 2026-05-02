<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin Masjid',
            'email' => 'admin@masjid.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Bendahara User
        User::create([
            'name' => 'Bendahara Masjid',
            'email' => 'bendahara@masjid.com',
            'password' => Hash::make('password'),
            'role' => 'bendahara',
        ]);

        // Create Sample Categories
        Kategori::create([
            'nama_kategori' => 'Zakat Fitrah',
            'deskripsi' => 'Zakat yang dikeluarkan saat hari raya Idul Fitri',
        ]);

        Kategori::create([
            'nama_kategori' => 'Zakat Mal',
            'deskripsi' => 'Zakat harta tahunan',
        ]);

        Kategori::create([
            'nama_kategori' => 'Sumbangan',
            'deskripsi' => 'Sumbangan dari jamaah',
        ]);

        Kategori::create([
            'nama_kategori' => 'Perbaikan Masjid',
            'deskripsi' => 'Dana untuk perbaikan dan renovasi masjid',
        ]);

        Kategori::create([
            'nama_kategori' => 'Operasional',
            'deskripsi' => 'Biaya operasional masjid',
        ]);

        Kategori::create([
            'nama_kategori' => 'Gaji Imam',
            'deskripsi' => 'Gaji untuk imam dan pengurus masjid',
        ]);
    }
}

