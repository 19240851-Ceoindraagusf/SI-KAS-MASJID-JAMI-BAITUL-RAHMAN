<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\KasKeluar;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMasuk = KasMasuk::sum('jumlah');
        $totalKeluar = KasKeluar::sum('jumlah');
        $saldo = $totalMasuk - $totalKeluar;

        return view('dashboard.index', compact('totalMasuk', 'totalKeluar', 'saldo'));
    }
}
