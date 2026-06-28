<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoAccountsSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nama' => 'Super Admin',
                'alamat' => 'Jl. Admin',
                'no_hp' => '081234567890',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        $dokter = User::updateOrCreate(
            ['email' => 'dokter@example.com'],
            [
                'nama' => 'Dr. Budi',
                'alamat' => 'Jl. Dokter',
                'no_hp' => '081234567891',
                'password' => Hash::make('dokter123'),
                'role' => 'dokter',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pasien@example.com'],
            [
                'nama' => 'Pasien Satu',
                'alamat' => 'Jl. Pasien',
                'no_hp' => '081234567892',
                'password' => Hash::make('pasien123'),
                'role' => 'pasien',
            ]
        );

        $poli = Poli::where('nama', 'Poli Umum')->first();
        if ($poli && $dokter) {
            Dokter::updateOrCreate(
                ['user_id' => $dokter->id],
                [
                    'user_id' => $dokter->id,
                    'nama' => 'Dr. Budi',
                    'poli_id' => $poli->id,
                    'alamat' => 'Jl. Dokter',
                ]
            );
        }
    }
}
