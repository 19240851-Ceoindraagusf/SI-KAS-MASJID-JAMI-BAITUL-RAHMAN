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

<!-- Grafik Kas Masuk & Keluar per Bulan -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Trend Kas Masuk & Keluar (6 Bulan Terakhir)</h5>
            </div>
            <div class="card-body">
                <canvas id="monthlyChart" height="80"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Distribusi Kas Masuk & Keluar -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Distribusi Kas Masuk per Kategori</h5>
            </div>
            <div class="card-body text-center">
                <canvas id="kasMasukChart" height="100"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Distribusi Kas Keluar per Kategori</h5>
            </div>
            <div class="card-body text-center">
                <canvas id="kasKeluarChart" height="100"></canvas>
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

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data Monthly Chart
    const monthlyData = @json($monthlyData);
    const monthLabels = monthlyData.map(item => item.month);
    const masukData = monthlyData.map(item => item.masuk);
    const keluarData = monthlyData.map(item => item.keluar);

    // Monthly Bar Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [
                {
                    label: 'Kas Masuk',
                    data: masukData,
                    backgroundColor: 'rgba(75, 192, 75, 0.5)',
                    borderColor: 'rgba(75, 192, 75, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                },
                {
                    label: 'Kas Keluar',
                    data: keluarData,
                    backgroundColor: 'rgba(255, 99, 99, 0.5)',
                    borderColor: 'rgba(255, 99, 99, 1)',
                    borderWidth: 1,
                    borderRadius: 5
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });

    // Kas Masuk Pie Chart
    const kasMasukCtx = document.getElementById('kasMasukChart').getContext('2d');
    const kasMasukLabels = @json($kasMasukLabels);
    const kasMasukValues = @json($kasMasukValues);
    
    new Chart(kasMasukCtx, {
        type: 'pie',
        data: {
            labels: kasMasukLabels.length > 0 ? kasMasukLabels : ['Tidak ada data'],
            datasets: [{
                label: 'Kas Masuk',
                data: kasMasukValues.length > 0 ? kasMasukValues : [0],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(75, 192, 75, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 99, 132, 0.8)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 75, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // Kas Keluar Pie Chart
    const kasKeluarCtx = document.getElementById('kasKeluarChart').getContext('2d');
    const kasKeluarLabels = @json($kasKeluarLabels);
    const kasKeluarValues = @json($kasKeluarValues);
    
    new Chart(kasKeluarCtx, {
        type: 'pie',
        data: {
            labels: kasKeluarLabels.length > 0 ? kasKeluarLabels : ['Tidak ada data'],
            datasets: [{
                label: 'Kas Keluar',
                data: kasKeluarValues.length > 0 ? kasKeluarValues : [0],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(255, 159, 64, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 75, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(153, 102, 255, 0.8)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 75, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        font: {
                            size: 12
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
