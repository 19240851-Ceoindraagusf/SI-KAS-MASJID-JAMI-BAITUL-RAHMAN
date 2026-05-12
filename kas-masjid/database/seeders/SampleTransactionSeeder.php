<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KasMasuk;
use App\Models\KasKeluar;
use App\Models\Kategori;
use App\Models\User;
use Carbon\Carbon;

class SampleTransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get bendahara user
        $bendahara = User::where('role', 'bendahara')->first();

        if (!$bendahara) {
            $this->command->warn('Bendahara user not found!');
            return;
        }

        // Get kategoris
        $kasMasukKategoris = Kategori::where('tipe', 'kas_masuk')->get();
        $kasKeluarKategoris = Kategori::where('tipe', 'kas_keluar')->get();

        if ($kasMasukKategoris->isEmpty() || $kasKeluarKategoris->isEmpty()) {
            $this->command->warn('Categories not found!');
            return;
        }

        // ===== KAS MASUK DATA =====
        $kasMasukData = [
            [
                'tanggal' => Carbon::now()->subDays(25),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Zakat Fitrah')->first()->id,
                'jumlah' => 1500000,
                'keterangan' => 'Zakat fitrah dari jamaah bapak Haji Mahmud',
            ],
            [
                'tanggal' => Carbon::now()->subDays(20),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Infaq')->first()->id,
                'jumlah' => 500000,
                'keterangan' => 'Infaq mingguan dari Ibu Siti Nurhaliza',
            ],
            [
                'tanggal' => Carbon::now()->subDays(18),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Sumbangan Pembangunan')->first()->id,
                'jumlah' => 5000000,
                'keterangan' => 'Sumbangan untuk renovasi masjid 2026',
            ],
            [
                'tanggal' => Carbon::now()->subDays(15),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Sedekah')->first()->id,
                'jumlah' => 250000,
                'keterangan' => 'Sedekah dari Pak Bambang untuk panti asuhan',
            ],
            [
                'tanggal' => Carbon::now()->subDays(12),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Zakat Mal')->first()->id,
                'jumlah' => 2000000,
                'keterangan' => 'Zakat mal dari PT Maju Jaya Mandiri',
            ],
            [
                'tanggal' => Carbon::now()->subDays(10),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Hasil Bazaar & Penjualan')->first()->id,
                'jumlah' => 3500000,
                'keterangan' => 'Hasil bazaar Ramadhan 2026',
            ],
            [
                'tanggal' => Carbon::now()->subDays(8),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Sumbangan Perusahaan')->first()->id,
                'jumlah' => 10000000,
                'keterangan' => 'CSR dari Bank Mandiri untuk pemberdayaan umat',
            ],
            [
                'tanggal' => Carbon::now()->subDays(5),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Zakat Profesi')->first()->id,
                'jumlah' => 1200000,
                'keterangan' => 'Zakat profesi dokter Drg. Ade Setiawan',
            ],
            [
                'tanggal' => Carbon::now()->subDays(3),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Hasil Pesantren Ramadhan')->first()->id,
                'jumlah' => 4000000,
                'keterangan' => 'Hasil pendaftaran pesantren kilat Ramadhan',
            ],
            [
                'tanggal' => Carbon::now()->subDays(1),
                'kategori_id' => $kasMasukKategoris->where('nama_kategori', 'Sumbangan Lembaga Amal')->first()->id,
                'jumlah' => 2500000,
                'keterangan' => 'Donasi dari Yayasan Cinta Kasih Indonesia',
            ],
        ];

        // Create KAS MASUK
        foreach ($kasMasukData as $data) {
            KasMasuk::create([
                'tanggal' => $data['tanggal'],
                'kategori_id' => $data['kategori_id'],
                'jumlah' => $data['jumlah'],
                'keterangan' => $data['keterangan'],
                'user_id' => $bendahara->id,
                'kode_transaksi' => 'KM' . date('YmdHis') . rand(1000, 9999),
            ]);
        }

        // ===== KAS KELUAR DATA =====
        $kasKeluarData = [
            [
                'tanggal' => Carbon::now()->subDays(24),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Gaji & Tunjangan')->first()->id,
                'jumlah' => 3000000,
                'keterangan' => 'Gaji Imam Masjid bulan Mei 2026',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(22),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Listrik & Air')->first()->id,
                'jumlah' => 750000,
                'keterangan' => 'Pembayaran listrik bulan April 2026',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(20),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Alat Shalat & Perlengkapan')->first()->id,
                'jumlah' => 2000000,
                'keterangan' => 'Pembelian 50 sarung shalat dan 30 mukena',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(17),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Bahan Kebersihan')->first()->id,
                'jumlah' => 500000,
                'keterangan' => 'Pembelian sapu, pel, sabun, dan pembersih lantai',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(14),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Konsumsi Acara')->first()->id,
                'jumlah' => 4500000,
                'keterangan' => 'Konsumsi pesantren Ramadhan untuk 150 peserta',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(12),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Perawatan & Perbaikan')->first()->id,
                'jumlah' => 1500000,
                'keterangan' => 'Perbaikan atap masjid bagian selatan',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(9),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Pengajian & Pelatihan')->first()->id,
                'jumlah' => 800000,
                'keterangan' => 'Honor ustadz untuk pengajian tafsir Qur\'an',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(7),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Biaya Administrasi')->first()->id,
                'jumlah' => 350000,
                'keterangan' => 'Biaya fotokopi dokumen dan administrasi',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(4),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Biaya Amal & Sosial')->first()->id,
                'jumlah' => 2000000,
                'keterangan' => 'Bantuan untuk anak yatim dan fakir miskin',
                'status' => 'approved',
            ],
            [
                'tanggal' => Carbon::now()->subDays(2),
                'kategori_id' => $kasKeluarKategoris->where('nama_kategori', 'Biaya Komunikasi')->first()->id,
                'jumlah' => 200000,
                'keterangan' => 'Paket internet dan telepon masjid',
                'status' => 'approved',
            ],
        ];

        // Create KAS KELUAR
        foreach ($kasKeluarData as $data) {
            $status = $data['status'];
            unset($data['status']);

            KasKeluar::create([
                'tanggal' => $data['tanggal'],
                'kategori_id' => $data['kategori_id'],
                'jumlah' => $data['jumlah'],
                'keterangan' => $data['keterangan'],
                'user_id' => $bendahara->id,
                'kode_transaksi' => 'KK' . date('YmdHis') . rand(1000, 9999),
                'status' => $status,
                'bukti_path' => null,
            ]);
        }

        $this->command->info('✅ Sample transactions created successfully!');
        $this->command->info('📊 Total: 10 Kas Masuk + 10 Kas Keluar');
    }
}
