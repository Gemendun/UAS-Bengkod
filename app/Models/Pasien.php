<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'no_rm',
        'nama',
        'no_ktp',
        'alamat',
        'no_hp',
    ];

    /**
     * Relasi ke tabel users
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
