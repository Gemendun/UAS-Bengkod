<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Obat;

class ObatSeeder extends Seeder
{
    public function run(): void
    {
        Obat::insert([
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Tablet 500mg',
                'harga' => 5000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Kapsul 250mg',
                'harga' => 8000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_obat' => 'Antasida',
                'kemasan' => 'Sirup 60ml',
                'harga' => 10000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
