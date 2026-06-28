<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ObatSeeder::class,
            PeriksaSeeder::class,
            DetailPeriksaSeeder::class,
            PoliSeeder::class,
            DokterSeeder::class,
        ]);
    }
}
