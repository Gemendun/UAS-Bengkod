<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;

    protected $table = 'dokters';

    protected $fillable = [
        'user_id',
        'nama',
        'poli_id',
        'alamat', // ✅ tambahkan ini
    ];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function poli()
    {
        return $this->belongsTo(Poli::class, 'poli_id');
    }

    public function jadwalPeriksa()
    {
        return $this->hasMany(JadwalPeriksa::class, 'dokter_id');
    }
}
