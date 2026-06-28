<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Periksa extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'tgl_periksa',
        'keluhan',
        'catatan_dokter',
        'biaya_periksa',
        'nomor_antrian',
        'status',
    ];


    public function pasien(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pasien')->with('pasien');
    }



    public function jadwal(): BelongsTo
    {
        return $this->belongsTo(JadwalPeriksa::class, 'id_jadwal');
    }

    public function detailPeriksa()
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }

    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'detail_periksas', 'id_periksa', 'id_obat');
    }
}
