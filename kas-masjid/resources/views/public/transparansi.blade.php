<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transparansi Keuangan - {{ $setting->nama_masjid }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background: #f4f7f6;
            color: #0f172a;
        }

        .hero {
            background: linear-gradient(135deg, #0f2f2b 0%, #0f766e 100%);
            color: white;
            padding: 42px 0 58px;
        }

        .hero p {
            color: rgba(255, 255, 255, 0.76);
            margin-bottom: 0;
        }

        .logo-box {
            width: 72px;
            height: 72px;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.12);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .logo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .content {
            margin-top: -32px;
            padding-bottom: 42px;
        }

        .card-clean {
            background: white;
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 8px;
            padding: 22px;
            box-shadow: 0 16px 36px rgba(15, 23, 42, 0.08);
            height: 100%;
        }

        .label {
            color: #64748b;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .value {
            font-size: 1.45rem;
            font-weight: 850;
        }

        .list-item {
            display: flex;
            justify-content: space-between;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid #e6eeeb;
        }

        .list-item:last-child {
            border-bottom: 0;
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="logo-box">
                    @if ($setting->logo_path)
                        <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="Logo {{ $setting->nama_masjid }}">
                    @else
                        <i class="bi bi-building fs-2"></i>
                    @endif
                </div>
                <div>
                    <h1 class="h3 mb-1">{{ $setting->nama_masjid }}</h1>
                    <p>Ringkasan transparansi kas dan laporan keuangan masjid</p>
                    @if ($setting->alamat)
                        <p>{{ $setting->alamat }}</p>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <main class="content">
        <div class="container">
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="card-clean">
                        <div class="label">Total Kas Masuk</div>
                        <div class="value text-success">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-clean">
                        <div class="label">Total Kas Keluar</div>
                        <div class="value text-danger">Rp {{ number_format($totalKeluar, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-clean">
                        <div class="label">Saldo Akhir</div>
                        <div class="value" style="color: #0f766e;">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <div class="card-clean">
                        <div class="label">Kas Masuk Bulan Ini</div>
                        <div class="value text-success">Rp {{ number_format($masukBulanIni, 0, ',', '.') }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card-clean">
                        <div class="label">Kas Keluar Bulan Ini</div>
                        <div class="value text-danger">Rp {{ number_format($keluarBulanIni, 0, ',', '.') }}</div>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="card-clean">
                        <h2 class="h6 mb-3">Kas Masuk Terbaru</h2>
                        @forelse ($recentMasuks as $item)
                            <div class="list-item">
                                <div>
                                    <strong>{{ $item->kategori->nama_kategori ?? '-' }}</strong>
                                    <div class="text-muted small">{{ $item->tanggal->format('d/m/Y') }} · {{ Str::limit($item->keterangan, 48) }}</div>
                                </div>
                                <strong class="text-success">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Belum ada data kas masuk.</p>
                        @endforelse
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card-clean">
                        <h2 class="h6 mb-3">Kas Keluar Approved Terbaru</h2>
                        @forelse ($recentKeluars as $item)
                            <div class="list-item">
                                <div>
                                    <strong>{{ $item->kategori->nama_kategori ?? '-' }}</strong>
                                    <div class="text-muted small">{{ $item->tanggal->format('d/m/Y') }} · {{ Str::limit($item->keterangan, 48) }}</div>
                                </div>
                                <strong class="text-danger">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</strong>
                            </div>
                        @empty
                            <p class="text-muted mb-0">Belum ada data kas keluar approved.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <p class="text-center text-muted small mt-4 mb-0">Diperbarui otomatis dari sistem kas masjid.</p>
        </div>
    </main>
</body>
</html>
