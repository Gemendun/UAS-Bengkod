<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = ['nama_obat', 'kemasan', 'harga', 'stok', 'stok_minimum'];

    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }

    /**
     * Cek apakah stok habis
     */
    public function isHabis(): bool
    {
        return $this->stok <= 0;
    }

    /**
     * Cek apakah stok menipis (di bawah stok_minimum)
     */
    public function isMenuipis(): bool
    {
        return $this->stok > 0 && $this->stok <= $this->stok_minimum;
    }
}
