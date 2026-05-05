@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .dashboard-header {
        margin-bottom: 30px;
    }

    .dashboard-header h1 {
        font-size: 2rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 5px;
    }

    .dashboard-header p {
        color: #64748b;
        margin: 0;
    }

    .stat-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #4f46e5;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: -50px;
        width: 100px;
        height: 100px;
        background: rgba(79, 70, 229, 0.05);
        border-radius: 50%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .stat-card.income {
        border-left-color: #10b981;
    }

    .stat-card.income::before {
        background: rgba(16, 185, 129, 0.05);
    }

    .stat-card.expense {
        border-left-color: #ef4444;
    }

    .stat-card.expense::before {
        background: rgba(239, 68, 68, 0.05);
    }

    .stat-card.balance {
        border-left-color: #3b82f6;
    }

    .stat-card.balance::before {
        background: rgba(59, 130, 246, 0.05);
    }

    .stat-label {
        font-size: 0.85rem;
        color: #64748b;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
        position: relative;
        z-index: 1;
    }

    .stat-change {
        font-size: 0.85rem;
        color: #64748b;
        position: relative;
        z-index: 1;
    }

    .stat-change.positive {
        color: #10b981;
    }

    .stat-change.negative {
        color: #ef4444;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .chart-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .chart-card h5 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .chart-card h5 i {
        color: #4f46e5;
        font-size: 1.3rem;
    }

    .activity-card {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .activity-card h5 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 20px;
    }

    .activity-message {
        background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
        border-left: 4px solid #4f46e5;
        padding: 20px;
        border-radius: 8px;
        margin-bottom: 15px;
    }

    .activity-message p {
        margin: 0;
        color: #475569;
        line-height: 1.6;
    }

    .activity-message strong {
        color: #1e293b;
    }

    @media (max-width: 768px) {
        .stat-cards {
            grid-template-columns: 1fr;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-header h1 {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header">
    <h1><i class="bi bi-speedometer2"></i> Dashboard</h1>
    <p>Ringkasan keuangan dan statistik Masjid Jami Baitul Rahman</p>
</div>

<!-- Stat Cards -->
<div class="stat-cards">
    <!-- Kas Masuk Card -->
    <div class="stat-card income">
        <div class="stat-label">
            <i class="bi bi-arrow-down-circle"></i>
            Total Kas Masuk
        </div>
        <div class="stat-value text-success">
            Rp {{ number_format($totalMasuk, 0, ',', '.') }}
        </div>
        <div class="stat-change positive">
            <i class="bi bi-check-circle"></i> Pemasukan bulan ini
        </div>
    </div>

    <!-- Kas Keluar Card -->
    <div class="stat-card expense">
        <div class="stat-label">
            <i class="bi bi-arrow-up-circle"></i>
            Total Kas Keluar
        </div>
        <div class="stat-value text-danger">
            Rp {{ number_format($totalKeluar, 0, ',', '.') }}
        </div>
        <div class="stat-change negative">
            <i class="bi bi-exclamation-circle"></i> Pengeluaran bulan ini
        </div>
    </div>

    <!-- Saldo Akhir Card -->
    <div class="stat-card balance">
        <div class="stat-label">
            <i class="bi bi-wallet2"></i>
            Saldo Akhir
        </div>
        <div class="stat-value" style="color: @if($saldo >= 0) #10b981 @else #ef4444 @endif">
            Rp {{ number_format($saldo, 0, ',', '.') }}
        </div>
        <div class="stat-change @if($saldo >= 0) positive @else negative @endif">
            <i class="bi @if($saldo >= 0) bi-arrow-up @else bi-arrow-down @endif"></i>
            @if($saldo >= 0) Saldo Positif @else Saldo Negatif @endif
        </div>
    </div>
</div>

<!-- Charts -->
<div class="charts-grid">
    <!-- Monthly Trend Chart -->
    <div class="chart-card">
        <h5>
            <i class="bi bi-graph-up"></i>
            Tren Kas (6 Bulan Terakhir)
        </h5>
        <canvas id="monthlyChart" height="80"></canvas>
    </div>

    <!-- Income Distribution -->
    <div class="chart-card">
        <h5>
            <i class="bi bi-pie-chart"></i>
            Distribusi Kas Masuk
        </h5>
        <canvas id="kasMasukChart" height="80"></canvas>
    </div>

    <!-- Expense Distribution -->
    <div class="chart-card">
        <h5>
            <i class="bi bi-pie-chart"></i>
            Distribusi Kas Keluar
        </h5>
        <canvas id="kasKeluarChart" height="80"></canvas>
    </div>
</div>

<!-- Activity Summary -->
<div class="activity-card">
    <h5>
        <i class="bi bi-info-circle"></i>
        Informasi Sistem
    </h5>
    
    <div class="activity-message">
        <p>
            <strong><i class="bi bi-check-lg"></i> Sistem Beroperasi Normal</strong>
        </p>
        <p style="margin-top: 8px;">
            Selamat datang di Sistem Informasi Kas Masjid Jami Baitul Rahman. Dashboard ini menampilkan ringkasan keuangan terkini yang membantu Anda memantau aliran kas masjid.
        </p>
    </div>

    <div class="activity-message" style="border-left-color: #3b82f6;">
        <p>
            <strong><i class="bi bi-lightbulb"></i> Tips Penggunaan</strong>
        </p>
        <p style="margin-top: 8px;">
            Gunakan menu di sebelah kiri untuk mengelola kas masuk, kas keluar, dan melihat laporan keuangan lengkap. Setiap transaksi tercatat dengan detail tanggal, kategori, dan keterangan.
        </p>
    </div>
</div>

<!-- Chart.js Library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Color scheme
    const colors = {
        primary: 'rgba(79, 70, 229, 0.8)',
        primaryLight: 'rgba(79, 70, 229, 0.1)',
        success: 'rgba(16, 185, 129, 0.8)',
        successLight: 'rgba(16, 185, 129, 0.1)',
        danger: 'rgba(239, 68, 68, 0.8)',
        dangerLight: 'rgba(239, 68, 68, 0.1)',
        warning: 'rgba(245, 158, 11, 0.8)',
        info: 'rgba(59, 130, 246, 0.8)',
    };

    // Monthly Chart
    const monthlyData = @json($monthlyData);
    const monthLabels = monthlyData.map(item => item.month);
    const masukData = monthlyData.map(item => item.masuk);
    const keluarData = monthlyData.map(item => item.keluar);

    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: monthLabels,
            datasets: [
                {
                    label: 'Kas Masuk',
                    data: masukData,
                    backgroundColor: colors.success,
                    borderColor: colors.success,
                    borderWidth: 0,
                    borderRadius: 6,
                    borderSkipped: false,
                },
                {
                    label: 'Kas Keluar',
                    data: keluarData,
                    backgroundColor: colors.danger,
                    borderColor: colors.danger,
                    borderWidth: 0,
                    borderRadius: 6,
                    borderSkipped: false,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        boxWidth: 12,
                        padding: 15,
                        font: { weight: '600' },
                        color: '#1e293b'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    borderRadius: 6,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(203, 213, 225, 0.2)' },
                    ticks: {
                        color: '#64748b',
                        callback: function(value) {
                            return 'Rp ' + (value / 1000000).toFixed(0) + 'M';
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#64748b' }
                }
            }
        }
    });

    // Kas Masuk Pie Chart
    const kasMasukCtx = document.getElementById('kasMasukChart').getContext('2d');
    const kasMasukLabels = @json($kasMasukLabels);
    const kasMasukValues = @json($kasMasukValues);
    const kasMasukColors = [
        'rgba(79, 70, 229, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(245, 158, 11, 0.8)',
        'rgba(59, 130, 246, 0.8)',
        'rgba(168, 85, 247, 0.8)',
        'rgba(236, 72, 153, 0.8)'
    ];

    new Chart(kasMasukCtx, {
        type: 'doughnut',
        data: {
            labels: kasMasukLabels.length > 0 ? kasMasukLabels : ['Tidak ada data'],
            datasets: [{
                data: kasMasukValues.length > 0 ? kasMasukValues : [0],
                backgroundColor: kasMasukColors.slice(0, kasMasukValues.length),
                borderColor: '#fff',
                borderWidth: 2,
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
                        font: { size: 12, weight: '500' },
                        color: '#64748b',
                        boxWidth: 10,
                        boxHeight: 10,
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.toLocaleString('id-ID');
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
        type: 'doughnut',
        data: {
            labels: kasKeluarLabels.length > 0 ? kasKeluarLabels : ['Tidak ada data'],
            datasets: [{
                data: kasKeluarValues.length > 0 ? kasKeluarValues : [0],
                backgroundColor: kasMasukColors.slice(0, kasKeluarValues.length),
                borderColor: '#fff',
                borderWidth: 2,
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
                        font: { size: 12, weight: '500' },
                        color: '#64748b',
                        boxWidth: 10,
                        boxHeight: 10,
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#fff',
                    bodyColor: '#fff',
                    padding: 12,
                    callbacks: {
                        label: function(context) {
                            return 'Rp ' + context.parsed.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection
