<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Kategori;

echo "Total Kategori: " . Kategori::count() . "\n";
echo "Kategori Kas Masuk: " . Kategori::where('tipe', 'kas_masuk')->count() . "\n";
echo "Kategori Kas Keluar: " . Kategori::where('tipe', 'kas_keluar')->count() . "\n\n";

echo "=== Kategori Kas Masuk ===\n";
Kategori::where('tipe', 'kas_masuk')->get()->each(function($k) {
    echo "- {$k->nama_kategori}\n";
});

echo "\n=== Kategori Kas Keluar ===\n";
Kategori::where('tipe', 'kas_keluar')->get()->each(function($k) {
    echo "- {$k->nama_kategori}\n";
});
