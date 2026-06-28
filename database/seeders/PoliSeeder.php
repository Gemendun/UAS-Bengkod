<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PoliSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('polis')->insert([
            ['nama' => 'Poli Umum'],
            ['nama' => 'Poli Gigi'],
            ['nama' => 'Poli Anak'],
        ]);
    }
}
