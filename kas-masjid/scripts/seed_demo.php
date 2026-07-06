<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Kategori;
use App\Models\KasMasuk;
use App\Models\KasKeluar;

// Create demo user
$user = User::firstOrCreate(
    ['email' => 'demo.bendahara@example.test'],
    ['name' => 'Demo Bendahara', 'password' => Hash::make('secret'), 'role' => 'bendahara']
);

// Create kategori
$kIn = Kategori::firstOrCreate(['tipe' => 'kas_masuk', 'nama_kategori' => 'Sumbangan']);
$kOut = Kategori::firstOrCreate(['tipe' => 'kas_keluar', 'nama_kategori' => 'Operasional']);

// Create transactions
$masuk = KasMasuk::create([
    'kode_transaksi' => null,
    'tanggal' => now()->toDateString(),
    'jumlah' => 70000,
    'keterangan' => 'Demo kas masuk',
    'kategori_id' => $kIn->id,
    'user_id' => $user->id,
]);

$keluar = KasKeluar::create([
    'kode_transaksi' => null,
    'tanggal' => now()->toDateString(),
    'jumlah' => 30000,
    'keterangan' => 'Demo kas keluar',
    'kategori_id' => $kOut->id,
    'status' => 'approved',
    'user_id' => $user->id,
]);

echo "Created user: {$user->id} {$user->email}\n";
echo "Kategori masuk: {$kIn->id} - {$kIn->nama_kategori}\n";
echo "Kategori keluar: {$kOut->id} - {$kOut->nama_kategori}\n";

echo "KasMasuk: {$masuk->id} | jumlah={$masuk->jumlah}\n";
echo "KasKeluar: {$keluar->id} | jumlah={$keluar->jumlah}\n";

// Demonstrate sanitization behavior
$examples = [
    '70000.00',
    'Rp 70.000',
    '70.000',
    '70,000.00',
    '70.000,00',
];

foreach ($examples as $ex) {
    $preg = preg_replace('/[^\\d]/', '', (string) $ex);
    $onlyDigits = preg_replace('/[^\\d]/', '', $ex);

    // naive thousands removal then decimal normalization
    $normalized = $ex;
    // remove currency symbol and spaces
    $normalized = preg_replace('/[^0-9.,-]/u', '', $normalized);
    // if contains both dot and comma, assume dot thousands and comma decimal
    if (strpos($normalized, '.') !== false && strpos($normalized, ',') !== false) {
        $normalized = str_replace('.', '', $normalized);
        $normalized = str_replace(',', '.', $normalized);
    } else if (strpos($normalized, ',') !== false && strpos($normalized, '.') === false) {
        // comma used as decimal separator in id locale
        $normalized = str_replace(',', '.', $normalized);
    } else {
        // remove dots as thousands separator
        $normalized = str_replace('.', '', $normalized);
    }

    $floatVal = is_numeric($normalized) ? (float) $normalized : null;

    echo "Example: '{$ex}' => preg_digits='{$preg}', normalized='{$normalized}', float=" . ($floatVal ?? 'null') . "\n";
}
