<?php

namespace Database\Seeders;

use App\Models\KasKeluar;
use App\Models\KasMasuk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Carbon\Carbon;

class ExtendedFinancialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (! Schema::hasColumn('kategoris', 'tipe')) {
            Schema::table('kategoris', function (Blueprint $table) {
                $table->string('tipe')->nullable()->after('nama_kategori');
            });
        }

        $kasMasukCategories = [
            ['nama_kategori' => 'Zakat Fitrah', 'deskripsi' => 'Zakat fitrah jamaah', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Infaq Jumat', 'deskripsi' => 'Infaq rutin jumat', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Sumbangan Pembangunan', 'deskripsi' => 'Donasi pembangunan masjid', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Sedekah Jariyah', 'deskripsi' => 'Sedekah untuk amal jariyah', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Zakat Mal', 'deskripsi' => 'Zakat harta kekayaan', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Hasil Bazaar', 'deskripsi' => 'Pendapatan bazaar dan penjualan', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Sumbangan Perusahaan', 'deskripsi' => 'Donasi dari perusahaan', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Zakat Profesi', 'deskripsi' => 'Zakat dari penghasilan profesi', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Donasi Program', 'deskripsi' => 'Donasi kegiatan sosial dan pendidikan', 'tipe' => 'kas_masuk'],
            ['nama_kategori' => 'Sumbangan Lembaga Amal', 'deskripsi' => 'Donasi lembaga amal', 'tipe' => 'kas_masuk'],
        ];

        $kasKeluarCategories = [
            ['nama_kategori' => 'Gaji & Tunjangan', 'deskripsi' => 'Pembayaran gaji petugas', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Listrik & Air', 'deskripsi' => 'Tagihan listrik dan air', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Alat Shalat & Perlengkapan', 'deskripsi' => 'Pembelian perlengkapan ibadah', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Bahan Kebersihan', 'deskripsi' => 'Belanja alat kebersihan', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Konsumsi Acara', 'deskripsi' => 'Konsumsi untuk acara keagamaan', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Perawatan & Perbaikan', 'deskripsi' => 'Perbaikan fasilitas masjid', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Pengajian & Pelatihan', 'deskripsi' => 'Honor pengajian dan pelatihan', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Biaya Administrasi', 'deskripsi' => 'Biaya pencetakan dan administrasi', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Biaya Amal & Sosial', 'deskripsi' => 'Bantuan sosial dan amal', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Biaya Komunikasi', 'deskripsi' => 'Internet, telepon dan komunikasi', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Transport & Operasional', 'deskripsi' => 'Biaya transport dan operasional harian', 'tipe' => 'kas_keluar'],
            ['nama_kategori' => 'Kebersihan Masjid', 'deskripsi' => 'Layanan kebersihan harian', 'tipe' => 'kas_keluar'],
        ];

        foreach ($kasMasukCategories as $category) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                ['tipe' => $category['tipe'], 'deskripsi' => $category['deskripsi']]
            );
        }

        foreach ($kasKeluarCategories as $category) {
            Kategori::firstOrCreate(
                ['nama_kategori' => $category['nama_kategori']],
                ['tipe' => $category['tipe'], 'deskripsi' => $category['deskripsi']]
            );
        }

        $user = User::where('role', 'bendahara')->first() ?? User::first();

        if (! $user) {
            $this->command->warn('Tidak ada user yang ditemukan untuk membuat transaksi.');
            return;
        }

        $kasMasukData = [
            ['tanggal' => '2026-01-05', 'kategori' => 'Zakat Fitrah', 'jumlah' => 1750000, 'keterangan' => 'Zakat fitrah dari jamaah awal Januari'],
            ['tanggal' => '2026-01-12', 'kategori' => 'Infaq Jumat', 'jumlah' => 850000, 'keterangan' => 'Infaq Jumat minggu pertama'],
            ['tanggal' => '2026-01-20', 'kategori' => 'Sumbangan Pembangunan', 'jumlah' => 5000000, 'keterangan' => 'Sumbangan untuk renovasi pagar masjid'],
            ['tanggal' => '2026-02-03', 'kategori' => 'Sedekah Jariyah', 'jumlah' => 1200000, 'keterangan' => 'Sedekah jariyah dari keluarga pak Hadi'],
            ['tanggal' => '2026-02-14', 'kategori' => 'Zakat Mal', 'jumlah' => 2500000, 'keterangan' => 'Zakat mal dari beberapa donatur'],
            ['tanggal' => '2026-02-22', 'kategori' => 'Hasil Bazaar', 'jumlah' => 3600000, 'keterangan' => 'Hasil bazaar akhir pekan'],
            ['tanggal' => '2026-03-07', 'kategori' => 'Sumbangan Perusahaan', 'jumlah' => 8000000, 'keterangan' => 'Donasi dari CV Maju Bersama'],
            ['tanggal' => '2026-03-18', 'kategori' => 'Zakat Profesi', 'jumlah' => 1500000, 'keterangan' => 'Zakat profesi dari ustadz'],
            ['tanggal' => '2026-03-27', 'kategori' => 'Donasi Program', 'jumlah' => 2200000, 'keterangan' => 'Donasi untuk program santunan'],
            ['tanggal' => '2026-04-09', 'kategori' => 'Sumbangan Lembaga Amal', 'jumlah' => 3000000, 'keterangan' => 'Sumbangan lembaga amal daerah'],
            ['tanggal' => '2026-04-17', 'kategori' => 'Zakat Fitrah', 'jumlah' => 1650000, 'keterangan' => 'Zakat fitrah pelengkap'],
            ['tanggal' => '2026-05-05', 'kategori' => 'Infaq Jumat', 'jumlah' => 900000, 'keterangan' => 'Infaq Jumat bulan Mei'],
            ['tanggal' => '2026-05-21', 'kategori' => 'Sumbangan Pembangunan', 'jumlah' => 4500000, 'keterangan' => 'Donasi pembangunan mushola'],
            ['tanggal' => '2026-06-14', 'kategori' => 'Donasi Program', 'jumlah' => 2700000, 'keterangan' => 'Program buka puasa bersama'],
            ['tanggal' => '2026-07-02', 'kategori' => 'Sedekah Jariyah', 'jumlah' => 1800000, 'keterangan' => 'Sedekah jariyah awal Juli'],
        ];

        $kasKeluarData = [
            ['tanggal' => '2026-01-08', 'kategori' => 'Gaji & Tunjangan', 'jumlah' => 3200000, 'keterangan' => 'Gaji petugas minggu pertama', 'status' => 'approved'],
            ['tanggal' => '2026-01-16', 'kategori' => 'Listrik & Air', 'jumlah' => 780000, 'keterangan' => 'Tagihan listrik Januari', 'status' => 'approved'],
            ['tanggal' => '2026-01-24', 'kategori' => 'Bahan Kebersihan', 'jumlah' => 540000, 'keterangan' => 'Pembelian sabun dan pel', 'status' => 'approved'],
            ['tanggal' => '2026-02-05', 'kategori' => 'Perawatan & Perbaikan', 'jumlah' => 1600000, 'keterangan' => 'Perbaikan lampu dan kipas', 'status' => 'approved'],
            ['tanggal' => '2026-02-13', 'kategori' => 'Konsumsi Acara', 'jumlah' => 4700000, 'keterangan' => 'Konsumsi kajian rutin', 'status' => 'approved'],
            ['tanggal' => '2026-02-25', 'kategori' => 'Biaya Administrasi', 'jumlah' => 380000, 'keterangan' => 'Biaya fotokopi dan dokumen', 'status' => 'approved'],
            ['tanggal' => '2026-03-04', 'kategori' => 'Pengajian & Pelatihan', 'jumlah' => 900000, 'keterangan' => 'Honor ustadz pengajian', 'status' => 'approved'],
            ['tanggal' => '2026-03-15', 'kategori' => 'Biaya Komunikasi', 'jumlah' => 240000, 'keterangan' => 'Pembelian paket internet', 'status' => 'approved'],
            ['tanggal' => '2026-03-22', 'kategori' => 'Transport & Operasional', 'jumlah' => 600000, 'keterangan' => 'Transport petugas operasional', 'status' => 'approved'],
            ['tanggal' => '2026-04-02', 'kategori' => 'Kebersihan Masjid', 'jumlah' => 700000, 'keterangan' => 'Layanan kebersihan bulanan', 'status' => 'approved'],
            ['tanggal' => '2026-04-11', 'kategori' => 'Alat Shalat & Perlengkapan', 'jumlah' => 2100000, 'keterangan' => 'Pembelian mukena dan sarung', 'status' => 'approved'],
            ['tanggal' => '2026-04-27', 'kategori' => 'Biaya Amal & Sosial', 'jumlah' => 2200000, 'keterangan' => 'Bantuan panti asuhan', 'status' => 'approved'],
            ['tanggal' => '2026-05-09', 'kategori' => 'Gaji & Tunjangan', 'jumlah' => 3300000, 'keterangan' => 'Gaji petugas Mei', 'status' => 'approved'],
            ['tanggal' => '2026-06-18', 'kategori' => 'Listrik & Air', 'jumlah' => 810000, 'keterangan' => 'Tagihan listrik Juni', 'status' => 'approved'],
            ['tanggal' => '2026-07-06', 'kategori' => 'Perawatan & Perbaikan', 'jumlah' => 1800000, 'keterangan' => 'Perbaikan saluran air', 'status' => 'approved'],
        ];

        foreach ($kasMasukData as $data) {
            $kategori = Kategori::where('nama_kategori', $data['kategori'])->where('tipe', 'kas_masuk')->first();
            KasMasuk::create([
                'kode_transaksi' => 'KM-' . str_replace('-', '', $data['tanggal']) . '-' . str_pad((string) rand(1, 999), 3, '0', STR_PAD_LEFT),
                'tanggal' => Carbon::parse($data['tanggal']),
                'jumlah' => $data['jumlah'],
                'keterangan' => $data['keterangan'],
                'kategori_id' => $kategori?->id,
                'user_id' => $user->id,
            ]);
        }

        foreach ($kasKeluarData as $data) {
            $kategori = Kategori::where('nama_kategori', $data['kategori'])->where('tipe', 'kas_keluar')->first();
            KasKeluar::create([
                'kode_transaksi' => 'KK-' . str_replace('-', '', $data['tanggal']) . '-' . str_pad((string) rand(1, 999), 3, '0', STR_PAD_LEFT),
                'tanggal' => Carbon::parse($data['tanggal']),
                'jumlah' => $data['jumlah'],
                'keterangan' => $data['keterangan'],
                'kategori_id' => $kategori?->id,
                'status' => $data['status'],
                'bukti_path' => null,
                'user_id' => $user->id,
            ]);
        }

        $this->command->info('✅ Kategori dan transaksi finansial tambahan berhasil dibuat.');
        $this->command->info('📊 Total kategori kas masuk: ' . Kategori::where('tipe', 'kas_masuk')->count());
        $this->command->info('📊 Total kategori kas keluar: ' . Kategori::where('tipe', 'kas_keluar')->count());
        $this->command->info('📊 Total kas masuk: ' . KasMasuk::count());
        $this->command->info('📊 Total kas keluar: ' . KasKeluar::count());
    }
}
