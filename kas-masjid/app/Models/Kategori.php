<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kategori',
        'deskripsi',
    ];

    /**
     * Get the kas masuk records for this category.
     */
    public function kasMasuks(): HasMany
    {
        return $this->hasMany(KasMasuk::class);
    }

    /**
     * Get the kas keluar records for this category.
     */
    public function kasKeluars(): HasMany
    {
        return $this->hasMany(KasKeluar::class);
    }
}
