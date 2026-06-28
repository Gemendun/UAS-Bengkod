<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Obat>
 */
class ObatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_obat' => fake()->word(),
            'kemasan' => fake()->randomElement(['Tablet', 'Kapsul', 'Sirup']),
            'harga' => fake()->numberBetween(5000, 100000),
        ];
    }
}
