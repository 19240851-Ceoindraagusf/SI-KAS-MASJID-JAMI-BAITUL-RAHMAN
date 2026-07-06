<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$admin = User::where('email','admin@example.test')->first();
if($admin){
    $admin->password = Hash::make('admin123');
    $admin->save();
    echo "admin: updated\n";
} else {
    echo "admin: not found\n";
}

$bend = User::where('email','bendahara@example.test')->first();
if($bend){
    $bend->password = Hash::make('bendahara123');
    $bend->save();
    echo "bendahara: updated\n";
} else {
    echo "bendahara: not found\n";
}

// show updated_at for quick verification
if(isset($admin) && $admin){ echo "admin updated_at: ".$admin->updated_at->toDateTimeString()."\n"; }
if(isset($bend) && $bend){ echo "bendahara updated_at: ".$bend->updated_at->toDateTimeString()."\n"; }
