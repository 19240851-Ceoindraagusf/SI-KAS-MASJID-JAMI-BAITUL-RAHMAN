<?php

require __DIR__ . '/../../vendor/autoload.php';

$app = require_once __DIR__ . '/../../bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$accounts = [
    [
        'email' => 'adminmasjid@gmail.com',
        'name' => 'Admin Masjid',
        'password' => 'admin123',
        'role' => 'admin',
    ],
    [
        'email' => 'bendaharamasjid@gmail.com',
        'name' => 'Bendahara Masjid',
        'password' => 'bendahara123',
        'role' => 'bendahara',
    ],
];

foreach ($accounts as $account) {
    $user = User::where('email', $account['email'])->first();
    if (! $user) {
        $user = new User();
        $user->email = $account['email'];
    }

    $user->name = $account['name'];
    $user->password = Hash::make($account['password']);
    $user->role = $account['role'];
    $user->email_verified_at = now();
    $user->save();

    echo $account['email'] . ' => restored' . PHP_EOL;
}
