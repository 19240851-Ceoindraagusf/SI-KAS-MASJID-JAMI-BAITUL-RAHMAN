<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Kategori;
use App\Models\KasMasuk;
use App\Models\KasKeluar;

echo "Seeding full demo data...\n";

// 1) Users
$admin = User::updateOrCreate(
    ['email' => 'admin@masjid.local'],
    ['name' => 'Administrator', 'password' => Hash::make('admin123'), 'role' => 'admin']
);

$bendahara = User::updateOrCreate(
    ['email' => 'bendahara@masjid.local'],
    ['name' => 'Bendahara', 'password' => Hash::make('bendahara123'), 'role' => 'bendahara']
);

echo "Users: admin={$admin->email}, bendahara={$bendahara->email}\n";

// 2) Categories (various)
$kategoriMasuk = ['Sumbangan', 'Iuran Anggota', 'Wakaf', 'Donasi Kegiatan', 'Penjualan Barang'];
$kategoriKeluar = ['Operasional', 'Gaji', 'Pemeliharaan', 'Acara', 'Donasi Keluar'];

$kmIds = [];
$kkIds = [];

foreach ($kategoriMasuk as $k) {
    $cat = Kategori::firstOrCreate(['tipe' => 'kas_masuk', 'nama_kategori' => $k]);
    $kmIds[] = $cat->id;
}

foreach ($kategoriKeluar as $k) {
    $cat = Kategori::firstOrCreate(['tipe' => 'kas_keluar', 'nama_kategori' => $k]);
    $kkIds[] = $cat->id;
}

echo "Created categories: masuk=" . count($kmIds) . ", keluar=" . count($kkIds) . "\n";

// Helper: random date between two dates
function randomDateBetween($start, $end) {
    $min = strtotime($start);
    $max = strtotime($end);
    $val = rand($min, $max);
    return date('Y-m-d', $val);
}

// 3) Seed 20 KasMasuk and 20 KasKeluar between 2026-01-01 and 2026-07-31
$start = '2026-01-01';
$end = '2026-07-31';

$descriptionsMasuk = [
    'Sumbangan warga',
    'Iuran anggota bulanan',
    'Wakaf pembangunan',
    'Donasi kegiatan sosial',
    'Penjualan katering acara',
    'Sumbangan acara kebaktian',
];

$descriptionsKeluar = [
    'Biaya listrik dan air',
    'Gaji petugas kebersihan',
    'Pemeliharaan bangunan',
    'Konsumsi kegiatan masjid',
    'Bantuan sosial dan zakat',
    'Penyelenggaraan acara keagamaan',
];

for ($i = 0; $i < 20; $i++) {
    $date = randomDateBetween($start, $end);
    $amount = rand(50000, 2000000); // between 50k and 2M
    $kId = $kmIds[array_rand($kmIds)];
    $userId = (rand(0,1) === 0) ? $admin->id : $bendahara->id;
    $description = $descriptionsMasuk[array_rand($descriptionsMasuk)] . ' ' . date('F Y', strtotime($date));

    KasMasuk::create([
        'kode_transaksi' => null,
        'tanggal' => $date,
        'jumlah' => $amount,
        'keterangan' => $description,
        'kategori_id' => $kId,
        'user_id' => $userId,
    ]);
}

for ($i = 0; $i < 20; $i++) {
    $date = randomDateBetween($start, $end);
    $amount = rand(20000, 1500000); // between 20k and 1.5M
    $kId = $kkIds[array_rand($kkIds)];
    $userId = (rand(0,1) === 0) ? $admin->id : $bendahara->id;
    $status = (rand(0,4) === 0) ? 'pending' : 'approved'; // ~20% pending
    $description = $descriptionsKeluar[array_rand($descriptionsKeluar)] . ' ' . date('F Y', strtotime($date));

    KasKeluar::create([
        'kode_transaksi' => null,
        'tanggal' => $date,
        'jumlah' => $amount,
        'keterangan' => $description,
        'kategori_id' => $kId,
        'status' => $status,
        'user_id' => $userId,
    ]);
}

echo "Seeding completed.\n";

// Summary counts
echo "Total KasMasuk: " . KasMasuk::count() . "\n";
echo "Total KasKeluar: " . KasKeluar::count() . "\n";

echo "Done.\n";
