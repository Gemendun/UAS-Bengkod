<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_pasien_can_login_with_plain_text_password(): void
    {
        User::create([
            'nama' => 'Pasien Uji',
            'email' => 'pasien@example.com',
            'password' => 'password123',
            'alamat' => 'Jl. Uji',
            'no_hp' => '081111111111',
            'role' => 'pasien',
        ]);

        $response = $this->post('/login', [
            'email' => 'pasien@example.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('dashboardPasien'));
        $this->assertAuthenticatedAs(User::where('email', 'pasien@example.com')->first());
    }
}
