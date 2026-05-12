@extends('layouts.app')

@section('title', 'Tambah Kas Keluar')

@section('styles')
<style>
    .form-container {
        max-width: 600px;
    }

    .form-card {
        background: white;
        border-radius: 12px;
        padding: 30px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }

    .form-card h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .form-card h1 i {
        color: #ef4444;
        font-size: 2rem;
    }

    .form-subtitle {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group:last-of-type {
        margin-bottom: 30px;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }

    .required {
        color: #ef4444;
    }

    .form-control, .form-select {
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        padding: 12px 14px;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        background-color: #f8fafc;
    }

    .form-control:focus, .form-select:focus {
        border-color: #4f46e5;
        background-color: white;
        box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        outline: none;
    }

    .form-control.is-invalid, .form-select.is-invalid {
        border-color: #ef4444;
        background-color: #fef2f2;
    }

    .form-control.is-invalid:focus {
        box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
    }

    .invalid-feedback {
        display: block;
        color: #ef4444;
        font-size: 0.85rem;
        margin-top: 8px;
        font-weight: 500;
    }

    .form-help {
        font-size: 0.85rem;
        color: #64748b;
        margin-top: 6px;
    }

    .warning-alert {
        background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
        border-left: 4px solid #f59e0b;
        padding: 16px;
        border-radius: 8px;
        margin-bottom: 25px;
    }

    .warning-alert p {
        margin: 0;
        color: #78350f;
    }

    .button-group {
        display: flex;
        gap: 12px;
        justify-content: flex-end;
    }

    .btn-submit {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        color: white;
        padding: 12px 32px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
    }

    .btn-cancel {
        background: #e2e8f0;
        color: #1e293b;
        padding: 12px 32px;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-cancel:hover {
        background: #cbd5e1;
        color: #1e293b;
    }

    @media (max-width: 768px) {
        .form-container {
            max-width: 100%;
        }

        .form-card {
            padding: 20px;
        }

        .button-group {
            flex-direction: column-reverse;
        }

        .btn-submit, .btn-cancel {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <div class="form-card">
        <h1>
            <i class="bi bi-plus-circle"></i>
            Tambah Kas Keluar
        </h1>
        <p class="form-subtitle">Catat pengeluaran kas masjid baru</p>

        <form action="{{ route('kas_keluar.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Tanggal -->
            <div class="form-group">
                <label for="tanggal" class="form-label">
                    <i class="bi bi-calendar3"></i>
                    Tanggal <span class="required">*</span>
                </label>
                <input 
                    type="date" 
                    class="form-control @error('tanggal') is-invalid @enderror" 
                    id="tanggal" 
                    name="tanggal" 
                    value="{{ old('tanggal', date('Y-m-d')) }}" 
                    required
                >
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label for="kategori_id" class="form-label">
                    <i class="bi bi-tag"></i>
                    Kategori <span class="required">*</span>
                </label>
                <select 
                    class="form-select @error('kategori_id') is-invalid @enderror" 
                    id="kategori_id" 
                    name="kategori_id" 
                    required
                >
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" @selected(old('kategori_id') == $kategori->id)>
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Jumlah -->
            <div class="form-group">
                <label for="jumlah" class="form-label">
                    <i class="bi bi-wallet2"></i>
                    Jumlah (Rupiah) <span class="required">*</span>
                </label>
                <input 
                    type="text" 
                    inputmode="numeric"
                    class="form-control rupiah-input @error('jumlah') is-invalid @enderror" 
                    id="jumlah" 
                    name="jumlah" 
                    value="{{ old('jumlah') }}" 
                    placeholder="Rp 0"
                    required
                >
                @error('jumlah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <p class="form-help"><i class="bi bi-info-circle"></i> Masukkan angka tanpa titik atau koma</p>
            </div>

            <!-- Keterangan -->
            <div class="form-group">
                <label for="keterangan" class="form-label">
                    <i class="bi bi-chat-dots"></i>
                    Keterangan <span class="required">*</span>
                </label>
                <textarea 
                    class="form-control @error('keterangan') is-invalid @enderror" 
                    id="keterangan" 
                    name="keterangan" 
                    rows="4"
                    placeholder="Jelaskan tujuan dan detail pengeluaran kas..."
                    required
                >{{ old('keterangan') }}</textarea>
                @error('keterangan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <p class="form-help">Minimal 3 karakter, maksimal 255 karakter</p>
            </div>

            <!-- Bukti -->
            <div class="form-group">
                <label for="bukti" class="form-label">
                    <i class="bi bi-paperclip"></i>
                    Bukti Transaksi
                </label>
                <input 
                    type="file" 
                    class="form-control @error('bukti') is-invalid @enderror" 
                    id="bukti" 
                    name="bukti" 
                    accept=".jpg,.jpeg,.png,.pdf"
                >
                @error('bukti')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <p class="form-help">Upload nota/foto bukti pembayaran. Format JPG, PNG, atau PDF maksimal 2MB.</p>
            </div>

            <!-- Warning Alert -->
            <div class="warning-alert">
                <p>
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Perhatian!</strong> Data pengeluaran akan berstatus <strong>Pending</strong> dan menunggu persetujuan admin sebelum difinalisasi.
                </p>
            </div>

            <!-- Buttons -->
            <div class="button-group">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Simpan Data
                </button>
                <a href="{{ route('kas_keluar.index') }}" class="btn-cancel">
                    <i class="bi bi-x-lg"></i> Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
