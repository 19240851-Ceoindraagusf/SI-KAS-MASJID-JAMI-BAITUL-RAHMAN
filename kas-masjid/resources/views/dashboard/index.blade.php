@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Total Kas Masuk</div>
            <div class="stat-value text-success">
                Rp {{ number_format($totalMasuk, 0, ',', '.') }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Total Kas Keluar</div>
            <div class="stat-value text-danger">
                Rp {{ number_format($totalKeluar, 0, ',', '.') }}
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-label">Saldo Akhir</div>
            <div class="stat-value" style="color: @if($saldo >= 0) #27ae60 @else #e74c3c @endif">
                Rp {{ number_format($saldo, 0, ',', '.') }}
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Ringkasan Aktivitas</h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Selamat datang di Sistem Informasi Kas dan Laporan Keuangan Masjid Jami Baitul Rahman.</p>
                <p class="text-muted">Gunakan menu di sebelah kiri untuk mengelola kas masuk dan kas keluar.</p>
            </div>
        </div>
    </div>
</div>
@endsection
