@extends('layouts.app')

@section('title', 'Laporan Keuangan')

@section('content')
<div class="row mb-4">
    <div class="col-md-6">
        <h3>Laporan Keuangan</h3>
        <p class="text-muted">Lihat data kas masuk dan kas keluar. Filter berdasarkan tanggal dan cetak PDF rapi.</p>
    </div>
</div>

<div class="card mb-4 p-4">
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
        <div class="card p-4 h-100">
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
        <div class="card p-4 h-100">
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
        <div class="card p-4 h-100">
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
        <a href="{{ route('laporan.export', ['type' => 'masuk']) }}?start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-outline-dark">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
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
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td><strong>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong></td>
                        <td>{{ $item->user->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Belum ada data kas masuk</td>
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
        <a href="{{ route('laporan.export', ['type' => 'keluar']) }}?start_date={{ $startDate }}&end_date={{ $endDate }}" class="btn btn-outline-dark">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Penginput</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasKeluars as $item)
                    <tr>
                        <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                        <td>{{ $item->kategori->nama_kategori }}</td>
                        <td>{{ $item->keterangan }}</td>
                        <td><strong>Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong></td>
                        <td>{{ ucfirst($item->status) }}</td>
                        <td>{{ $item->user->name }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">Belum ada data kas keluar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
