<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Periksa;
use App\Models\Obat;

class DetailPeriksaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_periksa' => Periksa::inRandomOrder()->first()?->id ?? Periksa::factory(),
            'id_obat' => Obat::inRandomOrder()->first()?->id ?? Obat::factory(),
        ];
    }
}
