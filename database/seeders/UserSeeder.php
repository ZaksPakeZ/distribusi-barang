<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Buat admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Ganti dengan password yang aman
            'role' => 'admin', // Atur role untuk admin
        ]);

        // Buat cabang
        $branches = ['cabang1', 'cabang2', 'cabang3', 'cabang4', 'cabang5'];

        foreach ($branches as $branch) {
            User::create([
                'name' => $branch,
                'email' => $branch . '@example.com',
                'password' => bcrypt('password'), // Ganti dengan password yang aman
                'role' => 'branch', // Atur role untuk cabang
            ]);
        }
    }
}
