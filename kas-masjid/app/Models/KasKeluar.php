<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KasKeluar extends Model
{
    use HasFactory;

    protected $table = 'kas_keluars';

    protected $fillable = [
        'tanggal',
        'jumlah',
        'keterangan',
        'kategori_id',
        'status',
        'user_id',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
