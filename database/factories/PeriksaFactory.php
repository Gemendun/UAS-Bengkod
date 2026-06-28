<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class PeriksaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'id_pasien' => User::where('role', 'pasien')->inRandomOrder()->first()?->id ?? User::factory(),
            'id_dokter' => User::where('role', 'dokter')->inRandomOrder()->first()?->id ?? User::factory(),
            'tgl_periksa' => fake()->dateTimeBetween('-1 year', 'now'),
            'catatan' => fake()->sentence(),
            'biaya_periksa' => fake()->numberBetween(50000, 200000),
        ];
    }
}

