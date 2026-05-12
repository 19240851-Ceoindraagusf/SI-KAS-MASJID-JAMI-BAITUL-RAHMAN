<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasjidSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_masjid',
        'alamat',
        'telepon',
        'ketua_masjid',
        'bendahara',
        'logo_path',
        'catatan_laporan',
        'transparansi_publik',
    ];

    protected $casts = [
        'transparansi_publik' => 'boolean',
    ];

    public static function current(): self
    {
        return self::firstOrCreate([], [
            'nama_masjid' => 'Masjid Jami Baitul Rahman',
            'transparansi_publik' => true,
        ]);
    }
}
