<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateRequestedUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $accounts = [
            [
                'name' => 'Admin Masjid',
                'email' => 'adminmasjid@gmail.com',
                'password' => 'admin123',
                'role' => 'admin',
            ],
            [
                'name' => 'Bendahara Masjid',
                'email' => 'bendaharamasjid@gmail.com',
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
        }
    }
}
