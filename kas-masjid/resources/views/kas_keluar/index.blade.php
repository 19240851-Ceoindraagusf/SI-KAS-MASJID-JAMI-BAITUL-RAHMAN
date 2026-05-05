@extends('layouts.app')

@section('title', 'Kas Keluar')

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
        color: #ef4444;
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
        color: #ef4444;
        font-size: 1rem;
    }

    .date-cell {
        color: #64748b;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }

    .status-approved {
        background-color: #d1fae5;
        color: #065f46;
    }

    .status-rejected {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .action-buttons {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
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
        justify-content: center;
        width: 36px;
        height: 36px;
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

    .btn-approve {
        background-color: #d1fae5;
        color: #065f46;
    }

    .btn-approve:hover {
        background-color: #a7f3d0;
        transform: translateY(-2px);
    }

    .btn-reject {
        background-color: #fee2e2;
        color: #991b1b;
    }

    .btn-reject:hover {
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
        }
    }
</style>
@endsection

@section('content')
<!-- Page Header -->
<div class="page-header">
    <h1>
        <i class="bi bi-arrow-up-circle"></i>
        Data Kas Keluar
    </h1>
    @if (auth()->user()->role === 'bendahara' || auth()->user()->role === 'admin')
        <a href="{{ route('kas_keluar.create') }}" class="btn-add">
            <i class="bi bi-plus-circle"></i> 
            Tambah Kas Keluar
        </a>
    @endif
</div>

<!-- Table Container -->
<div class="table-container">
    @if ($items->count() > 0)
        <div class="table-wrapper">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah</th>
                        <th>Status</th>
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
                                <span style="background: #fee2e2; color: #991b1b; padding: 6px 12px; border-radius: 20px; font-size: 0.9rem; font-weight: 500;">
                                    {{ $item->kategori->nama_kategori }}
                                </span>
                            </td>
                            <td>{{ Str::limit($item->keterangan, 30) }}</td>
                            <td class="amount-cell">
                                Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                            </td>
                            <td>
                                @if ($item->status === 'pending')
                                    <span class="status-badge status-pending">
                                        <i class="bi bi-clock"></i> Pending
                                    </span>
                                @elseif ($item->status === 'approved')
                                    <span class="status-badge status-approved">
                                        <i class="bi bi-check-circle"></i> Approved
                                    </span>
                                @else
                                    <span class="status-badge status-rejected">
                                        <i class="bi bi-x-circle"></i> Rejected
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 32px; height: 32px; background: #ef4444; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 0.85rem;">
                                        {{ substr($item->user->name, 0, 1) }}
                                    </div>
                                    <span>{{ $item->user->name }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    {{-- Edit button: only for owner (bendahara) if pending, or admin --}}
                                    @if ((auth()->user()->role === 'bendahara' && $item->user_id === auth()->id() && $item->status === 'pending') || 
                                         (auth()->user()->role === 'admin'))
                                        <a href="{{ route('kas_keluar.edit', $item) }}" class="btn-action btn-edit" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    @endif

                                    {{-- Delete button: only for owner if pending, or admin --}}
                                    @if ((auth()->user()->role === 'bendahara' && $item->user_id === auth()->id() && $item->status === 'pending') || 
                                         (auth()->user()->role === 'admin'))
                                        <form action="{{ route('kas_keluar.destroy', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action btn-delete" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Approve button: admin only, for pending items --}}
                                    @if (auth()->user()->role === 'admin' && $item->status === 'pending')
                                        <form action="{{ route('kas_keluar.approve', $item) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn-action btn-approve" title="Approve">
                                                <i class="bi bi-check-lg"></i>
                                            </button>
                                        </form>
                                    @endif

                                    {{-- Reject button: admin only, for pending items --}}
                                    @if (auth()->user()->role === 'admin' && $item->status === 'pending')
                                        <form action="{{ route('kas_keluar.reject', $item) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menolak?');">
                                            @csrf
                                            <button type="submit" class="btn-action btn-reject" title="Reject">
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </form>
                                    @endif
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
            <p>Belum ada data kas keluar</p>
            <p style="font-size: 0.95rem; color: #94a3b8; margin-top: 10px;">Klik tombol "Tambah Kas Keluar" untuk mulai mencatat pengeluaran</p>
        </div>
    @endif
</div>
@endsection
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4">Belum ada data kas keluar</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-3">
    {{ $items->links() }}
</div>
@endsection
