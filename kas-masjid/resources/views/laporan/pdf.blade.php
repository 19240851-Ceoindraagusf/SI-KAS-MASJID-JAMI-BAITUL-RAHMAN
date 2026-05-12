<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #1f2937;
            margin: 26px;
            font-size: 11px;
        }

        h1, h2, h3, p {
            margin: 0;
        }

        .kop {
            text-align: center;
            border-bottom: 3px double #111827;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }

        .kop h1 {
            font-size: 18px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .kop h2 {
            font-size: 15px;
            margin-top: 4px;
        }

        .kop p {
            font-size: 10px;
            color: #4b5563;
            margin-top: 5px;
        }

        .title-box {
            background: #f3f4f6;
            border: 1px solid #d1d5db;
            padding: 10px 12px;
            margin-bottom: 14px;
        }

        .title-box table,
        .signature table {
            margin: 0;
            border-collapse: collapse;
        }

        .title-box td,
        .signature td {
            border: 0;
            padding: 2px 0;
            font-size: 11px;
        }

        .summary {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
        }

        .summary td {
            border: 1px solid #d1d5db;
            padding: 8px;
            background: #fbfbfb;
        }

        .summary strong {
            display: block;
            font-size: 12px;
            margin-top: 3px;
        }

        table.data {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table.data th,
        table.data td {
            border: 1px solid #9ca3af;
            padding: 7px;
            vertical-align: top;
        }

        table.data th {
            background: #e5e7eb;
            color: #111827;
            font-weight: bold;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        .section-title {
            font-size: 13px;
            font-weight: bold;
            margin-top: 14px;
            margin-bottom: 6px;
        }

        .signature {
            margin-top: 34px;
            width: 100%;
        }

        .signature td {
            width: 50%;
            text-align: center;
            padding-top: 8px;
        }

        .signature .space {
            height: 54px;
        }

        .muted {
            color: #6b7280;
        }
    </style>
</head>
<body>
    <div class="kop">
        <h1>{{ $setting->nama_masjid ?? 'Masjid Jami Baitul Rahman' }}</h1>
        <h2>{{ $judul }}</h2>
        <p>{{ $setting->alamat ?: 'Dokumen laporan kas dan keuangan masjid' }}</p>
    </div>

    <div class="title-box">
        <table style="width: 100%;">
            <tr>
                <td style="width: 18%;">Periode</td>
                <td>: {{ $startDate ? \Carbon\Carbon::parse($startDate)->format('d/m/Y') : 'Semua' }} sampai {{ $endDate ? \Carbon\Carbon::parse($endDate)->format('d/m/Y') : 'Semua' }}</td>
                <td style="width: 18%;">Dicetak</td>
                <td>: {{ now()->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Jenis</td>
                <td>: {{ ucfirst($type) }}</td>
                <td>Petugas</td>
                <td>: {{ auth()->user()->name ?? '-' }}</td>
            </tr>
        </table>
    </div>

    @if ($type === 'gabungan')
        <table class="summary">
            <tr>
                <td>Total Kas Masuk<strong>Rp {{ number_format($totalMasuk, 0, ',', '.') }}</strong></td>
                <td>Total Kas Keluar<strong>Rp {{ number_format($totalKeluar, 0, ',', '.') }}</strong></td>
                <td>Saldo Akhir<strong>Rp {{ number_format($saldoAkhir, 0, ',', '.') }}</strong></td>
            </tr>
        </table>

        <div class="section-title">Rincian Kas Masuk</div>
        <table class="data">
            <thead>
                <tr>
                    <th style="width: 13%;">Tanggal</th>
                    <th style="width: 15%;">Kode</th>
                    <th style="width: 18%;">Kategori</th>
                    <th>Keterangan</th>
                    <th style="width: 17%;" class="text-right">Jumlah</th>
                    <th style="width: 16%;">Penginput</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasMasuks as $item)
                    <tr>
                        <td>{{ $item->tanggal?->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $item->kode_transaksi ?: 'KM-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $item->user?->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center muted">Tidak ada kas masuk.</td></tr>
                @endforelse
            </tbody>
        </table>

        <div class="section-title">Rincian Kas Keluar Approved</div>
        <table class="data">
            <thead>
                <tr>
                    <th style="width: 13%;">Tanggal</th>
                    <th style="width: 15%;">Kode</th>
                    <th style="width: 18%;">Kategori</th>
                    <th>Keterangan</th>
                    <th style="width: 17%;" class="text-right">Jumlah</th>
                    <th style="width: 16%;">Penginput</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kasKeluars as $item)
                    <tr>
                        <td>{{ $item->tanggal?->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $item->kode_transaksi ?: 'KK-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $item->user?->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center muted">Tidak ada kas keluar approved.</td></tr>
                @endforelse
            </tbody>
        </table>
    @else
        <table class="summary">
            <tr>
                <td>
                    Total {{ $type === 'masuk' ? 'Kas Masuk' : 'Kas Keluar Approved' }}
                    <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
                </td>
            </tr>
        </table>

        <table class="data">
            <thead>
                <tr>
                    <th style="width: 13%;">Tanggal</th>
                    <th style="width: 15%;">Kode</th>
                    <th style="width: 18%;">Kategori</th>
                    <th>Keterangan</th>
                    <th style="width: 16%;" class="text-right">Jumlah</th>
                    @if ($type === 'keluar')
                        <th style="width: 12%;">Status</th>
                    @endif
                    <th style="width: 16%;">Penginput</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                    <tr>
                        <td>{{ $item->tanggal?->format('d/m/Y') ?? '-' }}</td>
                        <td>{{ $item->kode_transaksi ?: strtoupper(substr($type, 0, 1)) . '-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</td>
                        <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                        <td>{{ $item->keterangan ?? '-' }}</td>
                        <td class="text-right">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                        @if ($type === 'keluar')
                            <td>{{ ucfirst($item->status ?? '-') }}</td>
                        @endif
                        <td>{{ $item->user?->name ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ $type === 'keluar' ? 7 : 6 }}" class="text-center muted">Tidak ada data untuk periode ini.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    @endif

    <table class="signature">
        <tr>
            <td>Mengetahui,<br>Ketua Masjid</td>
            <td>Bendahara</td>
        </tr>
        <tr>
            <td class="space"></td>
            <td class="space"></td>
        </tr>
        <tr>
            <td>({{ $setting->ketua_masjid ?: '______________________' }})</td>
            <td>({{ $setting->bendahara ?: '______________________' }})</td>
        </tr>
    </table>
</body>
</html>
