<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

// Update Admin
$admin = User::find(1);
if ($admin) {
    $admin->password = Hash::make('admin123');
    $admin->save();
    echo "✓ Password Admin (admin@masjid.com) diubah menjadi: admin123\n";
}

// Update Bendahara Masjid
$bendahara1 = User::find(2);
if ($bendahara1) {
    $bendahara1->password = Hash::make('bendahara123');
    $bendahara1->save();
    echo "✓ Password Bendahara Masjid (bendahara@masjid.com) diubah menjadi: bendahara123\n";
}

// Update Bendahara Baru
$bendahara2 = User::find(4);
if ($bendahara2) {
    $bendahara2->password = Hash::make('bendahara123');
    $bendahara2->save();
    echo "✓ Password Bendahara Baru (bendahara2@masjid.com) diubah menjadi: bendahara123\n";
}

echo "\n✅ Semua password berhasil diupdate!\n";
