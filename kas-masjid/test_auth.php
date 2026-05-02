<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$credentials = [
    'email' => 'admin@masjid.com',
    'password' => 'password'
];

// Test Auth::attempt()
$result = \Illuminate\Support\Facades\Auth::attempt($credentials);

echo "Auth::attempt() result: " . ($result ? 'TRUE' : 'FALSE') . "\n";

if ($result) {
    $user = \Illuminate\Support\Facades\Auth::user();
    echo "Authenticated user: " . $user->email . "\n";
    echo "User role: " . $user->role . "\n";
} else {
    echo "Authentication failed\n";
    echo "Checking user directly...\n";
    $user = \App\Models\User::where('email', 'admin@masjid.com')->first();
    if ($user) {
        echo "User exists: " . $user->email . "\n";
        $check = \Illuminate\Support\Facades\Hash::check('password', $user->password);
        echo "Password check: " . ($check ? 'OK' : 'FAILED') . "\n";
    }
}
