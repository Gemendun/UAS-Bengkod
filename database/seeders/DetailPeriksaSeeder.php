<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailPeriksa;
use App\Models\Periksa;
use App\Models\Obat;

class DetailPeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $periksa = Periksa::first();
        $obat1 = Obat::where('nama_obat', 'Paracetamol')->first();
        $obat2 = Obat::where('nama_obat', 'Antasida')->first();

        if ($periksa && $obat1 && $obat2) {
            DetailPeriksa::insert([
                [
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat1->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat2->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
