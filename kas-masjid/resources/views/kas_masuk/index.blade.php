@extends('layouts.app')

@section('title', 'Kas Masuk')

@section('styles')
<style>
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .page-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .page-header h1 i {
        color: #10b981;
        font-size: 2rem;
    }

    .btn-add {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-add:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        color: white;
    }

    .table-container {
        background: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow-x: auto;
    }

    .table-wrapper {
        display: table-cell;
        width: 100%;
    }

    .table {
        margin-bottom: 0;
        width: 100%;
    }

    .table thead {
        background: linear-gradient(135deg, #f8fafc 0%, #eef2ff 100%);
    }

    .table thead th {
        border: none;
        padding: 16px;
        color: #1e293b;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        border-bottom: 1px solid #e2e8f0;
        padding: 16px;
        color: #475569;
        vertical-align: middle;
    }

    .table tbody tr {
        transition: background-color 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8fafc;
    }

    .amount-cell {
        font-weight: 600;
        color: #10b981;
        font-size: 1rem;
    }

    .date-cell {
        color: #64748b;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
    }

    .btn-action {
        padding: 8px 12px;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 0.9rem;
        text-decoration: none;
    }

    .btn-edit {
        background-color: #fef3c7;
        color: #92400e;
    }

    .btn-edit:hover {
        background-color: #fde68a;
        transform: translateY(-2px);
    }

    .btn-delete {
        background-color: #fee2e2;
        color: #991b1b;
        border: none;
    }

    .btn-delete:hover {
        background-color: #fecaca;
        transform: translateY(-2px);
    }

    .empty-state {
        text-align: center;
        padding: 50px 20px;
    }

    .empty-state i {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 15px;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1.1rem;
        margin: 0;
    }

    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
        gap: 5px;
    }

    .pagination a, .pagination span {
        padding: 8px 12px;
        border-radius: 6px;
        color: #4f46e5;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .pagination .active {
        background-color: #4f46e5;
        color: white;
        border-color: #4f46e5;
    }

    .pagination a:hover {
        background-color: #f0f4ff;
    }

    .filter-card {
        background: #ffffff;
        border: 1px solid rgba(148, 163, 184, 0.18);
        border-radius: 8px;
        padding: 18px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
        margin-bottom: 22px;
    }

    .filter-actions {
        display: flex;
        gap: 10px;
        align-items: end;
    }

    @media (max-width: 768px) {
        .page-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .page-header h1 {
            font-size: 1.5rem;
        }

        .table-container {
            padding: 15px;
        }

        .filter-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .table thead th,
        .table tbody td {
            padding: 12px 8px;
            font-size: 0.9rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .btn-action {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-arrow-down-circle"></i>
        Data Kas Masuk
    </h1>
    <a href="{{ route('kas_masuk.create') }}" class="btn-add">
        <i class="bi bi-plus-circle"></i> 
        Tambah Kas Masuk
    </a>
</div>

<!-- Filters -->
<div class="filter-card">
    <form action="{{ route('kas_masuk.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-lg-3 col-md-6">
            <label for="search" class="form-label">Cari Data</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ $search }}" placeholder="Keterangan, kategori, penginput">
        </div>
        <div class="col-lg-3 col-md-6">
            <label for="kategori_id" class="form-label">Kategori</label>
            <select name="kategori_id" id="kategori_id" class="form-select">
                <option value="">Semua kategori</option>
                @foreach ($kategoris as $kategori)
                    <option value="{{ $kategori->id }}" @selected((string) $kategoriId === (string) $kategori->id)>
                        {{ $kategori->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-2 col-md-6">
            <label for="start_date" class="form-label">Dari Tanggal</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $startDate }}">
        </div>
        <div class="col-lg-2 col-md-6">
            <label for="end_date" class="form-label">Sampai Tanggal</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $endDate }}">
        </div>
        <div class="col-lg-2">
            <div class="filter-actions">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-search"></i> Filter
                </button>
                <a href="{{ route('kas_masuk.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-counterclockwise"></i>
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Table Container -->
<div class="table-container">
    @if ($items->count() > 0)
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kode</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Penginput</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td class="date-cell">
                                <i class="bi bi-calendar3"></i>
                                {{ $item->tanggal->format('d/m/Y') }}
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border">{{ $item->kode_transaksi ?: 'KM-' . str_pad($item->id, 5, '0', STR_PAD_LEFT) }}</span>
                            </td>
                            <td>
                                <span style="background: #eef2ff; color: #4f46e5; padding: 6px 12px; border-radius: 20px; font-size: 0.9rem; font-weight: 500;">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td>{{ Str::limit($item->keterangan, 30) }}</td>
                            <td class="amount-cell">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 32px; height: 32px; background: #4f46e5; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.85rem;">
                                        {{ substr($item->user->name, 0, 1) }}
                                    </div>
                                    <span>{{ $item->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('kas_masuk.edit', $item) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>
                                    <form action="{{ route('kas_masuk.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($items->hasPages())
            <div class="pagination">
                {{ $items->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <i class="bi bi-inbox"></i>
            <p>Belum ada data kas masuk</p>
            <p style="font-size: 0.95rem; color: #94a3b8; margin-top: 10px;">Klik tombol "Tambah Kas Masuk" untuk mulai mencatat pemasukan</p>
        </div>
    @endif
</div>
@endsection
