<?php

namespace Tests\Feature;

use App\Models\Dokter;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PasienJadwalPeriksaTest extends TestCase
{
    use RefreshDatabase;

    public function test_jadwal_dokter_yang_dibuat_tersedia_untuk_pasien(): void
    {
        $poli = Poli::create(['nama' => 'Umum']);

        $dokterUser = User::create([
            'nama' => 'Dr. Budi',
            'email' => 'dr.budi@example.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jl. Sehat',
            'no_hp' => '081234567890',
            'role' => 'dokter',
        ]);

        $dokter = Dokter::create([
            'user_id' => $dokterUser->id,
            'nama' => 'Dr. Budi',
            'poli_id' => $poli->id,
            'alamat' => 'Jl. Sehat',
        ]);

        $this->actingAs($dokterUser);

        $this->post(route('jadwal.store'), [
            'hari' => 'Senin',
            'jam_mulai' => '09:00',
            'jam_selesai' => '11:00',
        ])->assertSessionHas('success');

        $jadwal = JadwalPeriksa::where('dokter_id', $dokter->id)->first();

        $this->assertNotNull($jadwal);
        $this->assertTrue((bool) $jadwal->is_aktif);

        $pasienUser = User::create([
            'nama' => 'Pasien Satu',
            'email' => 'pasien1@example.com',
            'password' => bcrypt('password'),
            'alamat' => 'Jl. Pasien',
            'no_hp' => '081234567891',
            'role' => 'pasien',
        ]);

        $this->actingAs($pasienUser);

        $response = $this->get(route('periksaPasien'));

        $response->assertOk();
        $response->assertViewHas('jadwalDokters', function ($jadwalDokters) use ($jadwal) {
            return $jadwalDokters->contains('id', $jadwal->id);
        });
    }
}
