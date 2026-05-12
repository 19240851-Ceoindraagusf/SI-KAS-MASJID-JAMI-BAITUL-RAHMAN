<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class TransactionCodeGenerator
{
    /**
     * @param class-string<Model> $modelClass
     */
    public static function generate(string $prefix, string $modelClass): string
    {
        $period = now()->format('Ym');
        $base = "{$prefix}-{$period}";
        $lastCode = $modelClass::where('kode_transaksi', 'like', "{$base}-%")
            ->orderByDesc('kode_transaksi')
            ->value('kode_transaksi');

        $nextNumber = 1;

        if ($lastCode) {
            $lastNumber = (int) substr($lastCode, -4);
            $nextNumber = $lastNumber + 1;
        }

        return $base . '-' . str_pad((string) $nextNumber, 4, '0', STR_PAD_LEFT);
    }
}
