<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\KasMasuk;
use App\Services\PdfService;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $kasMasuks = KasMasuk::with('kategori', 'user')
            ->when($startDate, fn($query) => $query->whereDate('tanggal', '>=', $startDate))
            ->when($endDate, fn($query) => $query->whereDate('tanggal', '<=', $endDate))
            ->orderBy('tanggal', 'desc')
            ->get();

        $kasKeluars = KasKeluar::with('kategori', 'user')
            ->when($startDate, fn($query) => $query->whereDate('tanggal', '>=', $startDate))
            ->when($endDate, fn($query) => $query->whereDate('tanggal', '<=', $endDate))
            ->orderBy('tanggal', 'desc')
            ->get();

        $totalMasuk = $kasMasuks->sum('jumlah');
        // Only count approved kas keluar for saldo akhir calculation
        $kasKeluarsApproved = KasKeluar::where('status', 'approved')
            ->when($startDate, fn($query) => $query->whereDate('tanggal', '>=', $startDate))
            ->when($endDate, fn($query) => $query->whereDate('tanggal', '<=', $endDate))
            ->get();
        $totalKeluar = $kasKeluarsApproved->sum('jumlah');
        $saldoAkhir = $totalMasuk - $totalKeluar;

        return view('laporan.index', compact(
            'kasMasuks',
            'kasKeluars',
            'startDate',
            'endDate',
            'totalMasuk',
            'totalKeluar',
            'saldoAkhir'
        ));
    }

    public function exportPdf(Request $request, string $type)
    {
        if (!in_array($type, ['masuk', 'keluar'])) {
            abort(404);
        }

        try {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            $query = $type === 'masuk' ? KasMasuk::with('kategori', 'user') : KasKeluar::with('kategori', 'user');

            $data = $query
                ->when($type === 'keluar', fn($q) => $q->where('status', 'approved'))
                ->when($startDate, fn($query) => $query->whereDate('tanggal', '>=', $startDate))
                ->when($endDate, fn($query) => $query->whereDate('tanggal', '<=', $endDate))
                ->orderBy('tanggal', 'desc')
                ->get();

            $judul = $type === 'masuk' ? 'Laporan Kas Masuk' : 'Laporan Kas Keluar';
            $total = $data->sum('jumlah');
            $fileName = "laporan-kas-{$type}-" . now()->format('YmdHis') . '.pdf';

            // Render the Blade template to HTML
            $html = view('laporan.pdf', compact('data', 'type', 'startDate', 'endDate', 'judul', 'total'))->render();

            // Create PDF using PdfService
            $pdf = new PdfService();
            $pdf->loadHtml($html)
                ->setPaper('A4', 'portrait')
                ->render();

            // Return PDF download response
            return response($pdf->output(), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        } catch (\Exception $e) {
            \Log::error('PDF Export Error: ' . $e->getMessage(), [
                'type' => $type,
                'exception' => $e
            ]);
            
            return back()->withErrors('Error: Gagal membuat PDF. ' . $e->getMessage());
        }
    }
}
