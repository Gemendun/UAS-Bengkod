<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Periksa;
use App\Models\User;

class PeriksaSeeder extends Seeder
{
    public function run(): void
    {
        $pasien = User::where('role', 'pasien')->first();
        $dokter = User::where('role', 'dokter')->first();

        if ($pasien && $dokter) {
            Periksa::insert([
                [
                    'id_pasien' => $pasien->id,
                    'id_dokter' => $dokter->id,
                    'tgl_periksa' => now(),
                    'catatan' => 'Demam dan sakit kepala',
                    'biaya_periksa' => 50000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id_pasien' => $pasien->id,
                    'id_dokter' => $dokter->id,
                    'tgl_periksa' => now()->subDays(2),
                    'catatan' => 'Sakit maag',
                    'biaya_periksa' => 45000,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}
