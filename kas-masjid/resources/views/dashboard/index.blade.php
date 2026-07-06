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
        border-left: 4px solid #0f766e;
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
        border-left-color: #0f766e;
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
        color: #0f766e;
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
        background: linear-gradient(135deg, #f8fbfa 0%, #ecfdf5 100%);
        border-left: 4px solid #0f766e;
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

    .insight-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 30px;
    }

    .insight-card {
        background: #ffffff;
        border: 1px solid rgba(148, 163, 184, 0.18);
        border-radius: 8px;
        padding: 18px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
    }

    .insight-card .label {
        color: #64748b;
        font-size: 0.78rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: 8px;
    }

    .insight-card .value {
        color: #0f172a;
        font-size: 1.25rem;
        font-weight: 800;
        line-height: 1.25;
    }

    .insight-card .note {
        color: #64748b;
        font-size: 0.86rem;
        margin-top: 8px;
    }

    .work-grid {
        display: grid;
        grid-template-columns: minmax(0, 1.15fr) minmax(320px, 0.85fr);
        gap: 20px;
        margin-bottom: 30px;
    }

    .work-card {
        background: #ffffff;
        border: 1px solid rgba(148, 163, 184, 0.18);
        border-radius: 8px;
        padding: 22px;
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.07);
    }

    .work-card h5 {
        color: #0f172a;
        font-size: 1rem;
        font-weight: 750;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .transaction-list {
        display: grid;
        gap: 10px;
    }

    .transaction-item {
        display: grid;
        grid-template-columns: 40px minmax(0, 1fr) auto;
        gap: 12px;
        align-items: center;
        padding: 12px;
        border: 1px solid #e6eeeb;
        border-radius: 8px;
        background: #fbfdfc;
    }

    .transaction-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .transaction-icon.income {
        background: #ecfdf5;
        color: #047857;
    }

    .transaction-icon.expense {
        background: #fef2f2;
        color: #b91c1c;
    }

    .transaction-title {
        color: #0f172a;
        font-weight: 700;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .transaction-meta {
        color: #64748b;
        font-size: 0.84rem;
        margin-top: 2px;
    }

    .transaction-amount {
        font-weight: 800;
        white-space: nowrap;
        text-align: right;
    }

    .transaction-amount.income {
        color: #16a34a;
    }

    .transaction-amount.expense {
        color: #dc2626;
    }

    @media (max-width: 768px) {
        .stat-cards {
            grid-template-columns: 1fr;
        }

        .charts-grid {
            grid-template-columns: 1fr;
        }

        .insight-grid,
        .work-grid {
            grid-template-columns: 1fr;
        }

        .dashboard-header h1 {
            font-size: 1.5rem;
        }
    }

    /* PROFESSIONAL POLISH */
    .dashboard-header {
        background: linear-gradient(135deg, #0f2f2b 0%, #0f766e 100%);
        color: white;
        border-radius: 8px;
        padding: 24px;
        box-shadow: 0 18px 38px rgba(15, 23, 42, 0.14);
    }

    .dashboard-header h1 {
        color: white;
        font-size: 1.75rem;
    }

    .dashboard-header .dashboard-copy {
        min-width: 0;
    }

    .dashboard-header p {
        color: rgba(255, 255, 255, 0.78);
    }

    .dashboard-header > div:first-child {
        width: 76px;
        height: 76px;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.12);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.18);
    }

    .dashboard-header img,
    .dashboard-header svg {
        width: 58px;
        height: 58px;
        object-fit: contain;
        filter: drop-shadow(0 6px 16px rgba(0, 0, 0, 0.2)) !important;
    }

    .dashboard-header i {
        color: #ffffff;
    }

    .stat-cards {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .stat-card {
        border-left: 0;
        padding: 24px;
    }

    .stat-card.balance {
        background: linear-gradient(135deg, #ffffff 0%, #ecfdf5 100%);
        border: 1px solid rgba(15, 118, 110, 0.18) !important;
    }

    .stat-card::before {
        right: 20px;
        top: 20px;
        width: 44px;
        height: 44px;
        border-radius: 8px;
    }

    .stat-card.income::before {
        background: rgba(22, 163, 74, 0.1);
    }

    .stat-card.expense::before {
        background: rgba(220, 38, 38, 0.1);
    }

    .stat-card.balance::before {
        background: rgba(15, 118, 110, 0.1);
    }

    .stat-label {
        letter-spacing: 0.08em;
        font-size: 0.76rem;
    }

    .stat-value {
        font-size: 1.65rem;
    }

    .charts-grid {
        grid-template-columns: minmax(0, 1.3fr) minmax(280px, 0.85fr);
        align-items: stretch;
    }

    .chart-card h5,
    .activity-card h5 {
        color: #0f172a;
        font-size: 1rem;
    }

    .chart-card h5 i {
        color: #0f766e;
    }

    .activity-message {
        background: #f8fbfa;
        border-left-color: #0f766e;
    }

    @media (max-width: 1100px) {
        .stat-cards,
        .charts-grid {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-header {
            align-items: flex-start !important;
            padding: 20px;
        }

        .transaction-item {
            grid-template-columns: 36px minmax(0, 1fr);
        }

        .transaction-amount {
            grid-column: 2;
            text-align: left;
        }
    }
</style>
@endsection

@section('content')
<!-- Dashboard Header -->
<div class="dashboard-header" style="display: flex; align-items: center; gap: 20px;">
    <div style="flex-shrink: 0;">
        <x-masjid-logo :setting="$masjidSetting" :size="58" />
    </div>
    <div class="dashboard-copy">
        <h1 style="margin: 0;">{{ $masjidSetting->nama_masjid }}</h1>
        <p style="margin: 5px 0 0 0;">Ringkasan keuangan dan statistik kas masjid</p>
        @if ($masjidSetting->alamat)
            <p style="margin: 4px 0 0 0;"><i class="bi bi-geo-alt"></i> {{ $masjidSetting->alamat }}</p>
        @endif
    </div>
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

<!-- Monthly Insights -->
<div class="insight-grid">
    <div class="insight-card">
        <div class="label">Kas Masuk Bulan Ini</div>
        <div class="value text-success">Rp {{ number_format($masukBulanIni, 0, ',', '.') }}</div>
        <div class="note">Total pemasukan periode {{ now()->translatedFormat('F Y') }}</div>
    </div>
    <div class="insight-card">
        <div class="label">Kas Keluar Bulan Ini</div>
        <div class="value text-danger">Rp {{ number_format($keluarBulanIni, 0, ',', '.') }}</div>
        <div class="note">Hanya pengeluaran yang sudah approved</div>
    </div>
    <div class="insight-card">
        <div class="label">Saldo Bulan Ini</div>
        <div class="value" style="color: {{ $saldoBulanIni >= 0 ? '#16a34a' : '#dc2626' }}">
            Rp {{ number_format($saldoBulanIni, 0, ',', '.') }}
        </div>
        <div class="note">Kas masuk dikurangi kas keluar bulan ini</div>
    </div>
    <div class="insight-card">
        <div class="label">Menunggu Approval</div>
        <div class="value" style="color: #d97706;">{{ $pendingApprovalCount }} transaksi</div>
        <div class="note">Total Rp {{ number_format($pendingApprovalTotal, 0, ',', '.') }}</div>
    </div>
</div>

<!-- Operational Overview -->
<div class="work-grid">
    <div class="work-card">
        <h5>
            <i class="bi bi-clock-history"></i>
            Transaksi Terbaru
        </h5>
        <div class="transaction-list">
            @forelse ($recentTransactions as $transaction)
                <div class="transaction-item">
                    <div class="transaction-icon {{ $transaction['type'] === 'masuk' ? 'income' : 'expense' }}">
                        <i class="bi {{ $transaction['type'] === 'masuk' ? 'bi-arrow-down-circle' : 'bi-arrow-up-circle' }}"></i>
                    </div>
                    <div>
                        <div class="transaction-title">{{ Str::limit($transaction['keterangan'], 44) }}</div>
                        <div class="transaction-meta">
                            {{ $transaction['tanggal']->format('d/m/Y') }} · {{ $transaction['kategori'] }} · {{ $transaction['user'] }}
                        </div>
                    </div>
                    <div class="transaction-amount {{ $transaction['type'] === 'masuk' ? 'income' : 'expense' }}">
                        {{ $transaction['type'] === 'masuk' ? '+' : '-' }} Rp {{ number_format($transaction['jumlah'], 0, ',', '.') }}
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding: 34px 18px !important;">
                    <i class="bi bi-inbox"></i>
                    <p>Belum ada transaksi</p>
                </div>
            @endforelse
        </div>
    </div>

    <div class="work-card">
        <h5>
            <i class="bi bi-shield-check"></i>
            Antrian Persetujuan
        </h5>
        <div class="transaction-list">
            @forelse ($pendingApprovals as $item)
                <div class="transaction-item" style="grid-template-columns: 40px minmax(0, 1fr);">
                    <div class="transaction-icon" style="background: #fffbeb; color: #b45309;">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div>
                        <div class="transaction-title">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</div>
                        <div class="transaction-meta">
                            {{ $item->tanggal->format('d/m/Y') }} · {{ $item->kategori->nama_kategori ?? '-' }} · {{ $item->user->name ?? '-' }}
                        </div>
                        <div class="transaction-meta">{{ Str::limit($item->keterangan, 52) }}</div>
                    </div>
                </div>
            @empty
                <div class="empty-state" style="padding: 34px 18px !important;">
                    <i class="bi bi-check2-circle"></i>
                    <p>Tidak ada kas keluar pending</p>
                </div>
            @endforelse
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
            Selamat datang di Sistem Informasi Kas {{ $masjidSetting->nama_masjid }}. Dashboard ini menampilkan ringkasan keuangan terkini yang membantu Anda memantau aliran kas masjid.
        </p>
    </div>

    <div class="activity-message" style="border-left-color: #0891b2;">
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
        primary: 'rgba(15, 118, 110, 0.88)',
        primaryLight: 'rgba(15, 118, 110, 0.12)',
        success: 'rgba(22, 163, 74, 0.88)',
        successLight: 'rgba(22, 163, 74, 0.12)',
        danger: 'rgba(220, 38, 38, 0.88)',
        dangerLight: 'rgba(220, 38, 38, 0.12)',
        warning: 'rgba(217, 119, 6, 0.88)',
        info: 'rgba(8, 145, 178, 0.88)',
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
        'rgba(15, 118, 110, 0.88)',
        'rgba(22, 163, 74, 0.88)',
        'rgba(217, 119, 6, 0.88)',
        'rgba(8, 145, 178, 0.88)',
        'rgba(71, 85, 105, 0.88)',
        'rgba(190, 24, 93, 0.82)'
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
