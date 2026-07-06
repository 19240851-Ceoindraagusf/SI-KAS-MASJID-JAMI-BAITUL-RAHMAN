@extends('layouts.app')

@section('title', 'Detail Persetujuan User')

@section('content')
<div class="page-header">
    <h1>
        <i class="bi bi-person-check"></i>
        Detail Pendaftaran Bendahara
    </h1>
</div>

<div class="card">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Informasi User</h5>
    </div>
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="text-muted" style="font-size: 0.9rem;">Nama Lengkap</label>
                <h6>{{ $user->name }}</h6>
            </div>
            <div class="col-md-6">
                <label class="text-muted" style="font-size: 0.9rem;">Email</label>
                <h6>{{ $user->email }}</h6>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <label class="text-muted" style="font-size: 0.9rem;">Role</label>
                <h6>
                    <span class="badge bg-info">Bendahara</span>
                </h6>
            </div>
            <div class="col-md-6">
                <label class="text-muted" style="font-size: 0.9rem;">Status</label>
                <h6>
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-hourglass-split"></i> Menunggu Persetujuan
                    </span>
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label class="text-muted" style="font-size: 0.9rem;">Tanggal Pendaftaran</label>
                <h6>{{ \App\Helpers\DateHelper::formatIndonesianDateTime($user->created_at) }}</h6>
            </div>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header bg-light">
        <h5 class="card-title mb-0">Aksi Persetujuan</h5>
    </div>
    <div class="card-body">
        <p class="text-muted mb-4">
            Pilih aksi untuk mengelola pendaftaran user ini. Setujui untuk mengaktifkan akun atau tolak untuk menghapus pendaftaran.
        </p>

        <div class="d-flex gap-3">
            <form method="POST" action="{{ route('admin.user-approvals.approve', $user) }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-success" onclick="return confirm('Setujui pendaftaran user {{ $user->name }}?')">
                    <i class="bi bi-check-circle"></i>
                    Setujui Pendaftaran
                </button>
            </form>

            <form method="POST" action="{{ route('admin.user-approvals.reject', $user) }}" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-danger" onclick="return confirm('Tolak dan hapus pendaftaran user {{ $user->name }}?')">
                    <i class="bi bi-x-circle"></i>
                    Tolak Pendaftaran
                </button>
            </form>

            <a href="{{ route('admin.user-approvals.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
@endsection
