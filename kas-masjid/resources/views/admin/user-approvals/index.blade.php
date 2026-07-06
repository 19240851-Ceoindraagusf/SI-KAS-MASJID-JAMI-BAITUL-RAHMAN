@extends('layouts.app')

@section('title', 'Persetujuan Pendaftaran User')

@section('content')
<div class="page-header">
    <h1>
        <i class="bi bi-check-circle"></i>
        Persetujuan Pendaftaran Bendahara
    </h1>
    <p class="text-muted">Kelola persetujuan pendaftaran akun bendahara baru</p>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-circle"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($pendingUsers->isEmpty())
    <div class="alert alert-info">
        <i class="bi bi-info-circle"></i>
        Tidak ada pendaftaran bendahara yang menunggu persetujuan.
    </div>
@else
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Tanggal Daftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pendingUsers as $user)
                        <tr>
                            <td>
                                <strong>{{ $user->name }}</strong>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <small class="text-muted">
                                    {{ \App\Helpers\DateHelper::formatIndonesianAuditLog($user->created_at) }}
                                </small>
                            </td>
                            <td>
                                <span class="badge bg-warning text-dark">
                                    <i class="bi bi-hourglass-split"></i> Menunggu
                                </span>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.user-approvals.show', $user) }}" class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                    <form method="POST" action="{{ route('admin.user-approvals.approve', $user) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Setujui pendaftaran user ini?')">
                                            <i class="bi bi-check-circle"></i> Setujui
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.user-approvals.reject', $user) }}" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tolak dan hapus pendaftaran user ini?')">
                                            <i class="bi bi-x-circle"></i> Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @if ($pendingUsers->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $pendingUsers->links() }}
        </div>
    @endif
@endif

<style>
    .btn-group {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    .btn-group form {
        margin: 0;
    }
</style>
@endsection
