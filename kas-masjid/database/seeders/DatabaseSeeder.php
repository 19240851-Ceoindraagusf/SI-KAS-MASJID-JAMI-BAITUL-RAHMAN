<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key checks for truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        
        // Delete existing kategoris to avoid conflicts
        Kategori::truncate();
        
        // Enable foreign key checks back
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Create Admin User (if not exists)
        User::firstOrCreate(
            ['email' => 'admin@masjid.com'],
            [
                'name' => 'Admin Masjid',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ]
        );

        // Create Bendahara User (if not exists)
        User::firstOrCreate(
            ['email' => 'bendahara@masjid.com'],
            [
                'name' => 'Bendahara Masjid',
                'password' => Hash::make('password'),
                'role' => 'bendahara',
            ]
        );

        // ===== KATEGORI KAS MASUK =====
        // Zakat Categories
        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Zakat Fitrah',
            'deskripsi' => 'Zakat yang dikeluarkan saat hari raya Idul Fitri oleh jamaah',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Zakat Mal',
            'deskripsi' => 'Zakat harta tahunan dari pengusaha dan pemilik modal',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Zakat Profesi',
            'deskripsi' => 'Zakat dari penghasilan profesi dan gaji',
        ]);

        // Voluntary Contribution Categories
        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Infaq',
            'deskripsi' => 'Sumbangan infaq sukarela dari jamaah',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sedekah',
            'deskripsi' => 'Sedekah tunai dari jamaah',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Hibah & Wakaf',
            'deskripsi' => 'Hibah dan wakaf dari individu atau organisasi',
        ]);

        // Special Occasion & Activity Categories
        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sumbangan Idul Adha',
            'deskripsi' => 'Sumbangan khusus pada perayaan Idul Adha',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sumbangan Tahun Baru',
            'deskripsi' => 'Sumbangan awal tahun dari jamaah',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sumbangan Pembangunan',
            'deskripsi' => 'Dana untuk pembangunan dan renovasi masjid',
        ]);

        // Personal & Corporate Donations
        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sumbangan Perseorangan',
            'deskripsi' => 'Donasi dari individu jamaah',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sumbangan Perusahaan',
            'deskripsi' => 'Donasi dari perusahaan dan korporat',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sumbangan Lembaga Amal',
            'deskripsi' => 'Sumbangan dari lembaga kemanusiaan atau amal',
        ]);

        // Event & Activity Revenue
        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Hasil Bazaar & Penjualan',
            'deskripsi' => 'Pendapatan dari bazaar, penjualan barang dan makanan',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Hasil Pesantren Ramadhan',
            'deskripsi' => 'Pendapatan dari kegiatan pesantren kilat',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Pendapatan Kegiatan',
            'deskripsi' => 'Pendapatan dari kegiatan dan acara masjid lainnya',
        ]);

        // Other Income
        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Bunga Bank & Investasi',
            'deskripsi' => 'Bunga dari tabungan dan hasil investasi',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Sewa Fasilitas',
            'deskripsi' => 'Pendapatan dari penyewaan ruang atau fasilitas masjid',
        ]);

        Kategori::create([
            'tipe' => 'kas_masuk',
            'nama_kategori' => 'Lain-lain',
            'deskripsi' => 'Pendapatan lain yang tidak masuk kategori di atas',
        ]);

        // ===== KATEGORI KAS KELUAR =====
        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Gaji & Tunjangan',
            'deskripsi' => 'Gaji untuk imam, muaddin, dan pengelola masjid',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Listrik & Air',
            'deskripsi' => 'Biaya listrik dan air untuk masjid',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Perawatan & Perbaikan',
            'deskripsi' => 'Biaya perbaikan dan perawatan bangunan masjid',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Alat Shalat & Perlengkapan',
            'deskripsi' => 'Pembelian mukena, sarung, Al-Quran, dan perlengkapan ibadah',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Bahan Kebersihan',
            'deskripsi' => 'Biaya sapu, pel, sabun, dan bahan kebersihan lainnya',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Konsumsi Acara',
            'deskripsi' => 'Biaya makanan dan minuman untuk acara masjid',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Biaya Komunikasi',
            'deskripsi' => 'Biaya telepon, internet, dan komunikasi lainnya',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Biaya Administrasi',
            'deskripsi' => 'Biaya fotokopi, administrasi, dan kantor lainnya',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Pengajian & Pelatihan',
            'deskripsi' => 'Biaya honor pembimbing pengajian dan pelatihan',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Renovasi & Pembangunan',
            'deskripsi' => 'Dana besar untuk renovasi dan pembangunan masjid',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Asuransi & Perizinan',
            'deskripsi' => 'Biaya asuransi bangunan dan perizinan',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Biaya Amal & Sosial',
            'deskripsi' => 'Biaya membantu fakir miskin dan kegiatan sosial',
        ]);

        Kategori::create([
            'tipe' => 'kas_keluar',
            'nama_kategori' => 'Lain-lain',
            'deskripsi' => 'Pengeluaran lain yang tidak masuk kategori di atas',
        ]);
    }
}

