<?php

namespace App\Http\Controllers;

use App\Models\KasKeluar;
use App\Models\KasMasuk;
use App\Models\MasjidSetting;
use App\Services\PdfService;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        [$startDate, $endDate] = $this->resolvePeriod($request);

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
        if (!in_array($type, ['masuk', 'keluar', 'gabungan'])) {
            abort(404);
        }

        try {
            [$startDate, $endDate] = $this->resolvePeriod($request);
            $setting = MasjidSetting::current();

            if ($type === 'gabungan') {
                $kasMasuks = KasMasuk::with('kategori', 'user')
                    ->when($startDate, fn($query) => $query->whereDate('tanggal', '>=', $startDate))
                    ->when($endDate, fn($query) => $query->whereDate('tanggal', '<=', $endDate))
                    ->orderBy('tanggal', 'asc')
                    ->get();

                $kasKeluars = KasKeluar::with('kategori', 'user')
                    ->where('status', 'approved')
                    ->when($startDate, fn($query) => $query->whereDate('tanggal', '>=', $startDate))
                    ->when($endDate, fn($query) => $query->whereDate('tanggal', '<=', $endDate))
                    ->orderBy('tanggal', 'asc')
                    ->get();

                $totalMasuk = $kasMasuks->sum('jumlah');
                $totalKeluar = $kasKeluars->sum('jumlah');
                $saldoAkhir = $totalMasuk - $totalKeluar;
                $judul = 'Laporan Keuangan Gabungan';
                $fileName = 'laporan-keuangan-gabungan-' . now()->format('YmdHis') . '.pdf';
                $data = collect();
                $total = $saldoAkhir;

                $html = view('laporan.pdf', compact(
                    'data',
                    'type',
                    'startDate',
                    'endDate',
                    'judul',
                    'total',
                    'setting',
                    'kasMasuks',
                    'kasKeluars',
                    'totalMasuk',
                    'totalKeluar',
                    'saldoAkhir'
                ))->render();

                $pdf = new PdfService();
                $pdf->loadHtml($html)
                    ->setPaper('A4', 'portrait')
                    ->render();

                return response($pdf->output(), 200)
                    ->header('Content-Type', 'application/pdf')
                    ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
            }

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
            $html = view('laporan.pdf', compact('data', 'type', 'startDate', 'endDate', 'judul', 'total', 'setting'))->render();

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

    private function resolvePeriod(Request $request): array
    {
        $period = $request->input('period');

        return match ($period) {
            'this_month' => [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()],
            'last_month' => [now()->subMonthNoOverflow()->startOfMonth()->toDateString(), now()->subMonthNoOverflow()->endOfMonth()->toDateString()],
            'this_year' => [now()->startOfYear()->toDateString(), now()->endOfYear()->toDateString()],
            default => [$request->input('start_date'), $request->input('end_date')],
        };
    }
}
