@extends('layouts.app')

@section('title', 'Audit Log')

@section('content')
<div class="page-header">
    <h1>
        <i class="bi bi-activity"></i>
        Audit Log Aktivitas
    </h1>
</div>

<div class="filter-card">
    <form action="{{ route('audit_logs.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-5">
            <label for="search" class="form-label">Cari Aktivitas</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ $search }}" placeholder="Deskripsi atau nama user">
        </div>
        <div class="col-md-3">
            <label for="action" class="form-label">Aksi</label>
            <select name="action" id="action" class="form-select">
                <option value="">Semua aksi</option>
                @foreach ($actions as $item)
                    <option value="{{ $item }}" @selected($action === $item)>{{ ucfirst(str_replace('_', ' ', $item)) }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 d-flex gap-2">
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('audit_logs.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-counterclockwise"></i> Reset
            </a>
        </div>
    </form>
</div>

<div class="table-container">
    <div class="table-wrapper">
        <table class="table mb-0">
            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>User</th>
                    <th>Aksi</th>
                    <th>Aktivitas</th>
                    <th>IP</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($logs as $log)
                    <tr>
                        <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $log->user->name ?? 'Sistem' }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">{{ ucfirst(str_replace('_', ' ', $log->action)) }}</span>
                        </td>
                        <td>{{ $log->description }}</td>
                        <td>{{ $log->ip_address ?: '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Belum ada audit log</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($logs->hasPages())
        <div class="pagination">
            {{ $logs->links() }}
        </div>
    @endif
</div>
@endsection
