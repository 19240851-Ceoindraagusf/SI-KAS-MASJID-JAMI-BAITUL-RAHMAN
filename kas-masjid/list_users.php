<?php

require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$users = \App\Models\User::all();

echo "Total Users: " . $users->count() . "\n";
echo "=====================================\n\n";

foreach ($users as $user) {
    echo "ID: " . $user->id . "\n";
    echo "Nama: " . $user->name . "\n";
    echo "Email: " . $user->email . "\n";
    echo "Role: " . $user->role . "\n";
    echo "Created: " . $user->created_at . "\n";
    echo "-------------------------------------\n";
}
