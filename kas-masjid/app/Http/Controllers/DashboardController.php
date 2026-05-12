<?php

namespace App\Http\Controllers;

use App\Models\KasMasuk;
use App\Models\KasKeluar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMasuk = KasMasuk::sum('jumlah');
        // Only count approved kas keluar for saldo calculation
        $totalKeluar = KasKeluar::where('status', 'approved')->sum('jumlah');
        $saldo = $totalMasuk - $totalKeluar;
        $startOfMonth = now()->startOfMonth()->toDateString();
        $endOfMonth = now()->endOfMonth()->toDateString();

        $masukBulanIni = KasMasuk::whereBetween('tanggal', [$startOfMonth, $endOfMonth])->sum('jumlah');
        $keluarBulanIni = KasKeluar::where('status', 'approved')
            ->whereBetween('tanggal', [$startOfMonth, $endOfMonth])
            ->sum('jumlah');
        $saldoBulanIni = $masukBulanIni - $keluarBulanIni;
        $pendingApprovalCount = KasKeluar::where('status', 'pending')->count();
        $pendingApprovalTotal = KasKeluar::where('status', 'pending')->sum('jumlah');

        $recentMasuks = KasMasuk::with('kategori', 'user')
            ->latest('tanggal')
            ->latest('id')
            ->limit(5)
            ->get()
            ->map(fn ($item) => [
                'type' => 'masuk',
                'tanggal' => $item->tanggal,
                'kategori' => $item->kategori->nama_kategori ?? '-',
                'keterangan' => $item->keterangan,
                'jumlah' => $item->jumlah,
                'status' => 'approved',
                'user' => $item->user->name ?? '-',
            ]);

        $recentKeluars = KasKeluar::with('kategori', 'user')
            ->latest('tanggal')
            ->latest('id')
            ->limit(5)
            ->get()
            ->map(fn ($item) => [
                'type' => 'keluar',
                'tanggal' => $item->tanggal,
                'kategori' => $item->kategori->nama_kategori ?? '-',
                'keterangan' => $item->keterangan,
                'jumlah' => $item->jumlah,
                'status' => $item->status,
                'user' => $item->user->name ?? '-',
            ]);

        $recentTransactions = $recentMasuks
            ->merge($recentKeluars)
            ->sortByDesc(fn ($item) => $item['tanggal']->timestamp)
            ->take(6)
            ->values();

        $pendingApprovals = KasKeluar::with('kategori', 'user')
            ->where('status', 'pending')
            ->latest('tanggal')
            ->latest('id')
            ->limit(5)
            ->get();

        // Data untuk Chart - Kas Masuk & Keluar per Kategori
        $kasMasukByKategori = KasMasuk::with('kategori')
            ->select('kategori_id', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori_id')
            ->get();

        $kasKeluarByKategori = KasKeluar::with('kategori')
            ->where('status', 'approved')
            ->select('kategori_id', DB::raw('SUM(jumlah) as total'))
            ->groupBy('kategori_id')
            ->get();

        // Data untuk Chart - Kas Masuk & Keluar per Bulan (last 6 months)
        $monthlyData = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthKey = $date->format('Y-m');
            
            $masuk = KasMasuk::whereMonth('tanggal', $date->month)
                ->whereYear('tanggal', $date->year)
                ->sum('jumlah');
            
            $keluar = KasKeluar::where('status', 'approved')
                ->whereMonth('tanggal', $date->month)
                ->whereYear('tanggal', $date->year)
                ->sum('jumlah');
            
            $monthlyData[] = [
                'month' => $date->format('M Y'),
                'masuk' => $masuk ?: 0,
                'keluar' => $keluar ?: 0,
            ];
        }

        // Data untuk Pie Chart - Distribusi Kas Masuk
        $kasMasukLabels = $kasMasukByKategori->pluck('kategori.nama_kategori')->toArray();
        $kasMasukValues = $kasMasukByKategori->pluck('total')->toArray();

        // Data untuk Pie Chart - Distribusi Kas Keluar
        $kasKeluarLabels = $kasKeluarByKategori->pluck('kategori.nama_kategori')->toArray();
        $kasKeluarValues = $kasKeluarByKategori->pluck('total')->toArray();

        return view('dashboard.index', compact(
            'totalMasuk', 
            'totalKeluar', 
            'saldo',
            'kasMasukLabels',
            'kasMasukValues',
            'kasKeluarLabels',
            'kasKeluarValues',
            'monthlyData',
            'masukBulanIni',
            'keluarBulanIni',
            'saldoBulanIni',
            'pendingApprovalCount',
            'pendingApprovalTotal',
            'recentTransactions',
            'pendingApprovals'
        ));
    }
}
