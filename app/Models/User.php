<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Periksa;
use App\Models\Pasien;
use App\Models\Dokter;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nama',
        'alamat',
        'no_hp',
        'role',
        'email',
        'password',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi.
     *
     * @var array<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe konversi otomatis untuk atribut tertentu.
     *
     * @var array<string,string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel periksa sebagai pasien.
     */
    public function periksaPasien(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_pasien');
    }

    /**
     * Relasi ke tabel periksa sebagai dokter.
     */
    public function periksaDokter(): HasMany
    {
        return $this->hasMany(Periksa::class, 'id_dokter');
    }

    /**
     * Relasi ke data pasien (jika user adalah pasien).
     */
    public function pasien(): HasOne
    {
        return $this->hasOne(Pasien::class, 'user_id');
    }

    /**
     * Relasi ke data dokter (jika user adalah dokter).
     */
    public function dokter(): HasOne
    {
        return $this->hasOne(Dokter::class, 'user_id');
    }
}
