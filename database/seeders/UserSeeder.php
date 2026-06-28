<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Dummy Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nama' => 'Super Admin',
                'alamat' => 'Jl. Admin No.1',
                'no_hp' => '081234567890',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );
    }
}
