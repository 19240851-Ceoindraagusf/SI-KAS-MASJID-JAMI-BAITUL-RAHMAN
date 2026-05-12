<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\KasMasuk;
use App\Models\MasjidSetting;

class TransparansiController extends Controller
{
    public function index()
    {
        $setting = MasjidSetting::current();

        if (! $setting->transparansi_publik) {
            abort(404);
        }

        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        $totalMasuk = KasMasuk::sum('jumlah');
        $totalKeluar = KasKeluar::where('status', 'approved')->sum('jumlah');
        $saldo = $totalMasuk - $totalKeluar;

        $masukBulanIni = KasMasuk::whereBetween('tanggal', [$startOfMonth, $endOfMonth])->sum('jumlah');
        $keluarBulanIni = KasKeluar::where('status', 'approved')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->sum('jumlah');

        $recentMasuks = KasMasuk::with('kategori')
            ->latest('tanggal')
            ->limit(5)
            ->get();

        $recentKeluars = KasKeluar::with('kategori')
            ->where('status', 'approved')
            ->latest('tanggal')
            ->limit(5)
            ->get();

        return view('public.transparansi', compact(
            'setting',
            'totalMasuk',
            'totalKeluar',
            'saldo',
            'masukBulanIni',
            'keluarBulanIni',
            'recentMasuks',
            'recentKeluars'
        ));
    }
}
