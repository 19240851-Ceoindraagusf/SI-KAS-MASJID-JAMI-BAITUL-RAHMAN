@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('styles')
<style>
    @media print {
        body {
            display: block;
            margin: 0;
            padding: 0;
            background-color: white;
        }
        .sidebar, .navbar-custom, .btn, form, .d-flex.gap-2 {
            display: none !important;
        }
        .main-content {
            margin-left: 0 !important;
            width: 100% !important;
        }
        .container-fluid {
            padding: 20px !important;
        }
        .card {
            page-break-inside: avoid;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
        }
        .print-header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .print-meta {
            font-size: 12px;
            color: #666;
            text-align: center;
            margin-bottom: 15px;
        }
    }

    .quick-filter {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 16px;
    }

    .quick-filter .btn {
        min-height: 38px;
    }

    .summary-card {
        border-left: 4px solid #0f766e !important;
    }
</style>
@endsection

@section('content')
<div class="row mb-4">
    <div class="col-md-8">
        <h3>Laporan Keuangan</h3>
        <p class="text-muted">Lihat data kas masuk dan kas keluar. Filter berdasarkan tanggal dan cetak PDF rapi.</p>
    </div>
    <div class="col-md-4 text-end">
        <button type="button" class="btn btn-outline-secondary" onclick="window.print()">
            <i class="bi bi-printer"></i> Print
        </button>
    </div>
</div>

<div class="card mb-4 p-4">
    <div class="quick-filter">
        <a href="{{ route('laporan.index', ['period' => 'this_month']) }}" class="btn btn-outline-secondary">
            <i class="bi bi-calendar-month"></i> Bulan Ini
        </a>
        <a href="{{ route('laporan.index', ['period' => 'last_month']) }}" class="btn btn-outline-secondary">
            <i class="bi bi-calendar2-minus"></i> Bulan Lalu
        </a>
        <a href="{{ route('laporan.index', ['period' => 'this_year']) }}" class="btn btn-outline-secondary">
            <i class="bi bi-calendar3"></i> Tahun Ini
        </a>
        <a href="{{ route('laporan.export', ['type' => 'gabungan']) }}?start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-primary" target="_blank">
            <i class="bi bi-file-earmark-pdf"></i> PDF Gabungan
        </a>
    </div>
    <form action="{{ route('laporan.index') }}" method="GET" class="row gy-3 align-items-end">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $startDate) }}">
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">Tanggal Akhir</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $endDate) }}">
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">Terapkan Filter</button>
            <a href="{{ route('laporan.index') }}" class="btn btn-outline-secondary">Reset</a>
        </div>
    </form>
</div>

<div class="row row-cols-1 row-cols-xl-3 g-4 mb-4">
    <div class="col">
        <div class="card p-4 h-100 summary-card">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h6 class="mb-1">Total Kas Masuk</h6>
                    <small class="text-muted">Jumlah pemasukan</small>
                </div>
                <span class="badge bg-success fs-6">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card p-4 h-100 summary-card" style="border-left-color: #dc2626 !important;">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h6 class="mb-1">Total Kas Keluar</h6>
                    <small class="text-muted">Jumlah pengeluaran</small>
                </div>
                <span class="badge bg-danger fs-6">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card p-4 h-100 summary-card" style="border-left-color: #0f766e !important;">
            <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                    <h6 class="mb-1">Saldo Akhir</h6>
                    <small class="text-muted">Total kas masuk - kas keluar</small>
                </div>
                <span class="badge bg-primary fs-6">Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<div class="card mb-4 p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0">Laporan Kas Masuk</h5>
            <small class="text-muted">Tanggal: {{ $startDate ?: 'Semua' }} → {{ $endDate ?: 'Semua' }}</small>
        </div>
        <div class="gap-2" style="display: flex; gap: 10px;">
            <a href="{{ route('laporan.export', ['type' => 'masuk']) }}?start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-outline-dark" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
            <button type="button" class="btn btn-outline-secondary" onclick="printTable('table-masuk')">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table id="table-masuk" class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Penginput</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasMasuks as $item)
                    <tr>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->kode_transaksi ?: 'KM-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td><strong>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong></td>
                        <td>{{ $item->user->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada data kas masuk</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card p-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h5 class="mb-0">Laporan Kas Keluar</h5>
            <small class="text-muted">Tanggal: {{ $startDate ?: 'Semua' }} → {{ $endDate ?: 'Semua' }}</small>
        </div>
        <div class="gap-2" style="display: flex; gap: 10px;">
            <a href="{{ route('laporan.export', ['type' => 'keluar']) }}?start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-outline-dark" target="_blank">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </a>
            <button type="button" class="btn btn-outline-secondary" onclick="printTable('table-keluar')">
                <i class="bi bi-printer"></i> Print
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table id="table-keluar" class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Bukti</th>
                    <th>Penginput</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasKeluars as $item)
                    <tr>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->kode_transaksi ?: 'KK-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td><strong>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong></td>
                        <td>{{ ucfirst($item->status) }}</td>
                        <td>
                            @if ($item->bukti_path)
                                <a href="{{ asset('storage/' . $item->bukti_path) }}" target="_blank">Ada</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $item->user->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">Belum ada data kas keluar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function printTable(tableId) {
        const printWindow = window.open('', '', 'height=600,width=800');
        const element = document.getElementById(tableId);
        
        // Get table title and metadata
        const card = element.closest('.card');
        const title = card.querySelector('h5').textContent;
        const meta = card.querySelector('small').textContent;
        
        let htmlContent = `
            <!DOCTYPE html>
            <html>
            <head>
                <title>${title}</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                        color: #333;
                    }
                    .print-header {
                        text-align: center;
                        margin-bottom: 20px;
                        border-bottom: 2px solid #333;
                        padding-bottom: 10px;
                    }
                    .print-header h2 {
                        margin: 0;
                        font-size: 18px;
                    }
                    .print-meta {
                        font-size: 12px;
                        color: #666;
                        margin-top: 5px;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-top: 20px;
                    }
                    th, td {
                        border: 1px solid #ddd;
                        padding: 8px;
                        text-align: left;
                        font-size: 12px;
                    }
                    th {
                        background-color: #f2f2f2;
                        font-weight: bold;
                    }
                    .text-right {
                        text-align: right;
                    }
                    @media print {
                        body {
                            margin: 0;
                            padding: 10px;
                        }
                    }
                </style>
            </head>
            <body>
                <div class="print-header">
                    <h2>${title}</h2>
                    <div class="print-meta">${meta}</div>
                    <div class="print-meta">Dicetak pada: ${new Date().toLocaleString('id-ID')}</div>
                </div>
                ${element.outerHTML}
            </body>
            </html>
        `;
        
        printWindow.document.write(htmlContent);
        printWindow.document.close();
        printWindow.print();
    }
</script>
@endsection
