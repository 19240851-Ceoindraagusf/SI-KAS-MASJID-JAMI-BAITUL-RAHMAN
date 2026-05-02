<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = \App\Models\User::where('email', 'admin@masjid.com')->first();

if ($user) {
    echo "User found!\n";
    echo "Email: " . $user->email . "\n";
    echo "Name: " . $user->name . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Password hash starts with: " . substr($user->password, 0, 10) . "\n";
    
    // Test password
    if (\Illuminate\Support\Facades\Hash::check('password', $user->password)) {
        echo "Password verification: SUCCESS\n";
    } else {
        echo "Password verification: FAILED\n";
    }
} else {
    echo "User not found in database\n";
}
