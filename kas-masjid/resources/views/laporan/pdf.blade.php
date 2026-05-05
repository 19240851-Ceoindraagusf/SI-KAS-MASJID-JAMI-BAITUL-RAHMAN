<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #222;
            margin: 24px;
        }
        h1, h2, h3, h4, h5, h6 {
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
            margin-bottom: 24px;
        }
        .header h2 {
            font-size: 20px;
        }
        .meta {
            margin-top: 8px;
            font-size: 12px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            font-size: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .summary {
            margin-top: 16px;
            font-size: 13px;
        }
        .summary strong {
            display: block;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>{{ $judul }}</h2>
        <div class="meta">Periode: {{ $startDate ?: 'Semua' }} sampai {{ $endDate ?: 'Semua' }}</div>
        <div class="meta">Dicetak pada {{ now()->format('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 14%;">Tanggal</th>
                <th style="width: 18%;">Kategori</th>
                <th>Keterangan</th>
                <th style="width: 16%;" class="text-right">Jumlah</th>
                @if ($type === 'keluar')
                    <th style="width: 12%;">Status</th>
                @endif
                <th style="width: 18%;">Penginput</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td>{{ $item->tanggal?->format('d/m/Y') ?? '-' }}</td>
                    <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->keterangan ?? '-' }}</td>
                    <td class="text-right">{{ $item->jumlah ? 'Rp ' . number_format($item->jumlah, 0, ',', '.') : '-' }}</td>
                    @if ($type === 'keluar')
                        <td>{{ ucfirst($item->status ?? '-') }}</td>
                    @endif
                    <td>{{ $item->user?->name ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="{{ $type === 'keluar' ? 6 : 5 }}" class="text-center">Tidak ada data untuk periode ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="summary">
        <strong>Total {{ $type === 'masuk' ? 'Kas Masuk' : 'Kas Keluar' }}: Rp {{ number_format($total, 0, ',', '.') }}</strong>
    </div>
</body>
</html>
