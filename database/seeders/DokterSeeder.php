<?php



namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Poli;
use App\Models\Dokter;

class DokterSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil user dokter berdasarkan email dari UserSeeder
        $user = User::where('email', 'dokter@example.com')->first();

        // Ambil poli yang ingin dikaitkan
        $poli = Poli::where('nama', 'Poli Umum')->first();

        if ($user && $poli) {
            Dokter::create([
                'user_id' => $user->id,
                'poli_id' => $poli->id,
            ]);
        }
    }
}
