<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AkunSeeder extends Seeder
{
    public function run(): void
    {
        // Cek apakah user admin sudah ada
        if (!User::where('email', 'admin@example.com')->exists()) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'), // Ganti 'password' dengan password yang lebih kuat
                'level' => 'Admin',
            ]);
        }

        // Cek apakah user super admin sudah ada
        if (!User::where('email', 'superadmin@example.com')->exists()) {
            User::create([
                'name' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'), // Ganti 'password' dengan password yang lebih kuat
                'level' => 'Super Admin',
            ]);
        }
    }
}

