<?php

namespace Database\Seeders;

use App\Models\KasKeluar;
use App\Models\KasMasuk;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class RequestedMosqueCashSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'adminmasjid@gmail.com'],
            [
                'name' => 'Admin Masjid',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $bendahara = User::updateOrCreate(
            ['email' => 'bendaharamasjid@gmail.com'],
            [
                'name' => 'Bendahara Masjid',
                'password' => Hash::make('bendahara123'),
                'role' => 'bendahara',
                'email_verified_at' => now(),
            ]
        );

        $categories = [
            ['kas_masuk', 'Infaq Jumat', 'Infaq jamaah setelah shalat Jumat'],
            ['kas_masuk', 'Infaq Subuh', 'Infaq jamaah pada kegiatan subuh'],
            ['kas_masuk', 'Sedekah Harian', 'Sedekah harian melalui kotak amal'],
            ['kas_masuk', 'Zakat Fitrah', 'Penerimaan zakat fitrah jamaah'],
            ['kas_masuk', 'Zakat Mal', 'Penerimaan zakat harta'],
            ['kas_masuk', 'Zakat Profesi', 'Penerimaan zakat penghasilan'],
            ['kas_masuk', 'Wakaf Pembangunan', 'Dana wakaf untuk pembangunan masjid'],
            ['kas_masuk', 'Donasi Renovasi', 'Donasi khusus renovasi fasilitas masjid'],
            ['kas_masuk', 'Donasi Anak Yatim', 'Dana santunan anak yatim'],
            ['kas_masuk', 'Sumbangan Perusahaan', 'CSR atau donasi dari perusahaan'],
            ['kas_masuk', 'Sumbangan Jamaah', 'Sumbangan umum dari jamaah'],
            ['kas_masuk', 'Hasil Bazaar', 'Pendapatan bazaar masjid'],
            ['kas_masuk', 'Sewa Aula', 'Pendapatan penyewaan aula masjid'],
            ['kas_masuk', 'Donasi Ramadhan', 'Donasi kegiatan Ramadhan'],
            ['kas_masuk', 'Infak Pendidikan TPA', 'Infak untuk kegiatan TPA'],
            ['kas_keluar', 'Listrik dan Air', 'Pembayaran tagihan listrik dan air'],
            ['kas_keluar', 'Honor Imam', 'Honor imam masjid'],
            ['kas_keluar', 'Honor Muadzin', 'Honor muadzin masjid'],
            ['kas_keluar', 'Honor Guru TPA', 'Honor pengajar TPA'],
            ['kas_keluar', 'Kebersihan Masjid', 'Belanja alat dan jasa kebersihan'],
            ['kas_keluar', 'Perawatan Bangunan', 'Perawatan rutin bangunan masjid'],
            ['kas_keluar', 'Perbaikan Sound System', 'Perbaikan audio dan pengeras suara'],
            ['kas_keluar', 'Konsumsi Pengajian', 'Konsumsi kegiatan kajian dan pengajian'],
            ['kas_keluar', 'Santunan Sosial', 'Bantuan sosial kepada jamaah dan warga'],
            ['kas_keluar', 'Alat Shalat', 'Pembelian sajadah, sarung, mukena, dan Al-Quran'],
            ['kas_keluar', 'Administrasi Kantor', 'ATK, fotokopi, dan kebutuhan administrasi'],
            ['kas_keluar', 'Internet dan Komunikasi', 'Biaya internet dan komunikasi masjid'],
            ['kas_keluar', 'Kegiatan Ramadhan', 'Biaya kegiatan Ramadhan'],
            ['kas_keluar', 'Operasional Keamanan', 'Biaya keamanan dan operasional lingkungan'],
            ['kas_keluar', 'Perlengkapan Acara', 'Perlengkapan kegiatan dan acara masjid'],
        ];

        foreach ($categories as [$tipe, $nama, $deskripsi]) {
            Kategori::updateOrCreate(
                ['tipe' => $tipe, 'nama_kategori' => $nama],
                ['deskripsi' => $deskripsi]
            );
        }

        $kasMasuk = [
            ['KM-REQ-20260105-001', '2026-01-05', 'Infaq Jumat', 1250000, 'Infaq Jumat pekan pertama Januari'],
            ['KM-REQ-20260118-002', '2026-01-18', 'Sedekah Harian', 735000, 'Rekap sedekah harian pertengahan Januari'],
            ['KM-REQ-20260202-003', '2026-02-02', 'Sumbangan Jamaah', 2100000, 'Sumbangan jamaah untuk operasional masjid'],
            ['KM-REQ-20260214-004', '2026-02-14', 'Zakat Profesi', 1850000, 'Zakat profesi jamaah bulan Februari'],
            ['KM-REQ-20260306-005', '2026-03-06', 'Donasi Ramadhan', 4500000, 'Donasi awal program Ramadhan'],
            ['KM-REQ-20260320-006', '2026-03-20', 'Zakat Fitrah', 6200000, 'Penerimaan zakat fitrah Ramadhan'],
            ['KM-REQ-20260403-007', '2026-04-03', 'Zakat Mal', 3750000, 'Zakat mal dari donatur tetap'],
            ['KM-REQ-20260417-008', '2026-04-17', 'Wakaf Pembangunan', 8000000, 'Wakaf pembangunan tempat wudhu'],
            ['KM-REQ-20260501-009', '2026-05-01', 'Hasil Bazaar', 2950000, 'Hasil bazaar makanan jamaah'],
            ['KM-REQ-20260515-010', '2026-05-15', 'Sewa Aula', 1500000, 'Sewa aula untuk akad nikah'],
            ['KM-REQ-20260605-011', '2026-06-05', 'Sumbangan Perusahaan', 7000000, 'Donasi CSR perusahaan sekitar masjid'],
            ['KM-REQ-20260619-012', '2026-06-19', 'Donasi Anak Yatim', 3300000, 'Donasi santunan anak yatim'],
            ['KM-REQ-20260703-013', '2026-07-03', 'Infak Pendidikan TPA', 980000, 'Infak wali santri TPA bulan Juli'],
            ['KM-REQ-20260712-014', '2026-07-12', 'Infaq Subuh', 640000, 'Infaq subuh berjamaah'],
            ['KM-REQ-20260725-015', '2026-07-25', 'Donasi Renovasi', 5200000, 'Donasi renovasi plafon masjid'],
        ];

        $kasKeluar = [
            ['KK-REQ-20260107-001', '2026-01-07', 'Listrik dan Air', 890000, 'Tagihan listrik dan air Januari'],
            ['KK-REQ-20260122-002', '2026-01-22', 'Kebersihan Masjid', 560000, 'Belanja cairan pembersih dan alat pel'],
            ['KK-REQ-20260205-003', '2026-02-05', 'Honor Imam', 1500000, 'Honor imam bulan Februari'],
            ['KK-REQ-20260221-004', '2026-02-21', 'Administrasi Kantor', 420000, 'ATK dan fotokopi dokumen masjid'],
            ['KK-REQ-20260308-005', '2026-03-08', 'Konsumsi Pengajian', 1250000, 'Konsumsi kajian menjelang Ramadhan'],
            ['KK-REQ-20260325-006', '2026-03-25', 'Kegiatan Ramadhan', 2750000, 'Biaya buka puasa bersama'],
            ['KK-REQ-20260406-007', '2026-04-06', 'Santunan Sosial', 3000000, 'Santunan warga kurang mampu'],
            ['KK-REQ-20260422-008', '2026-04-22', 'Alat Shalat', 1850000, 'Pembelian mukena dan sajadah'],
            ['KK-REQ-20260507-009', '2026-05-07', 'Honor Muadzin', 900000, 'Honor muadzin bulan Mei'],
            ['KK-REQ-20260524-010', '2026-05-24', 'Perawatan Bangunan', 2400000, 'Perawatan atap dan pengecatan ringan'],
            ['KK-REQ-20260609-011', '2026-06-09', 'Internet dan Komunikasi', 350000, 'Pembayaran internet sekretariat'],
            ['KK-REQ-20260623-012', '2026-06-23', 'Perbaikan Sound System', 1750000, 'Servis amplifier dan mikrofon'],
            ['KK-REQ-20260705-013', '2026-07-05', 'Honor Guru TPA', 1200000, 'Honor guru TPA bulan Juli'],
            ['KK-REQ-20260716-014', '2026-07-16', 'Operasional Keamanan', 680000, 'Operasional keamanan lingkungan masjid'],
            ['KK-REQ-20260728-015', '2026-07-28', 'Perlengkapan Acara', 1450000, 'Sewa tenda dan kursi pengajian'],
        ];

        foreach ($kasMasuk as [$kode, $tanggal, $kategoriNama, $jumlah, $keterangan]) {
            $kategori = Kategori::where('tipe', 'kas_masuk')->where('nama_kategori', $kategoriNama)->firstOrFail();

            KasMasuk::updateOrCreate(
                ['kode_transaksi' => $kode],
                [
                    'tanggal' => $tanggal,
                    'jumlah' => $jumlah,
                    'keterangan' => $keterangan,
                    'kategori_id' => $kategori->id,
                    'user_id' => $bendahara->id,
                ]
            );
        }

        foreach ($kasKeluar as [$kode, $tanggal, $kategoriNama, $jumlah, $keterangan]) {
            $kategori = Kategori::where('tipe', 'kas_keluar')->where('nama_kategori', $kategoriNama)->firstOrFail();

            KasKeluar::updateOrCreate(
                ['kode_transaksi' => $kode],
                [
                    'tanggal' => $tanggal,
                    'jumlah' => $jumlah,
                    'keterangan' => $keterangan,
                    'kategori_id' => $kategori->id,
                    'status' => 'approved',
                    'bukti_path' => null,
                    'user_id' => $bendahara->id,
                ]
            );
        }
    }
}
