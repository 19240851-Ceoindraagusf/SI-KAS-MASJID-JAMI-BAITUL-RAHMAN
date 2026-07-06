<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    \DB::connection()->getPdo();
    echo "DB OK\n";
} catch (Exception $e) {
    echo "DB ERR: " . $e->getMessage() . "\n";
}

echo "KasMasuk count: " . \App\Models\KasMasuk::count() . "\n";
echo "Max KasMasuk jumlah: " . \App\Models\KasMasuk::max('jumlah') . "\n";
print_r(\App\Models\KasMasuk::orderBy('id','desc')->take(5)->get()->toArray());

echo "KasKeluar count: " . \App\Models\KasKeluar::count() . "\n";
echo "Max KasKeluar jumlah: " . \App\Models\KasKeluar::max('jumlah') . "\n";
print_r(\App\Models\KasKeluar::orderBy('id','desc')->take(5)->get()->toArray());
