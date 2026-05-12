@extends('layouts.app')

@section('title', 'Setting Masjid')

@section('content')
<div class="form-container">
    <div class="form-card">
        <h1>
            <i class="bi bi-gear"></i>
            Setting Identitas Masjid
        </h1>
        <p class="form-subtitle">Data ini dipakai untuk kop laporan PDF dan halaman transparansi publik.</p>

        <form action="{{ route('settings.masjid.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama_masjid" class="form-label">Nama Masjid <span class="required">*</span></label>
                <input type="text" name="nama_masjid" id="nama_masjid" class="form-control @error('nama_masjid') is-invalid @enderror" value="{{ old('nama_masjid', $setting->nama_masjid) }}" required>
                @error('nama_masjid')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="alamat" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat', $setting->alamat) }}">
                @error('alamat')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label for="telepon" class="form-label">Telepon</label>
                <input type="text" name="telepon" id="telepon" class="form-control @error('telepon') is-invalid @enderror" value="{{ old('telepon', $setting->telepon) }}">
                @error('telepon')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="ketua_masjid" class="form-label">Ketua Masjid</label>
                        <input type="text" name="ketua_masjid" id="ketua_masjid" class="form-control @error('ketua_masjid') is-invalid @enderror" value="{{ old('ketua_masjid', $setting->ketua_masjid) }}">
                        @error('ketua_masjid')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bendahara" class="form-label">Bendahara</label>
                        <input type="text" name="bendahara" id="bendahara" class="form-control @error('bendahara') is-invalid @enderror" value="{{ old('bendahara', $setting->bendahara) }}">
                        @error('bendahara')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="logo" class="form-label">Logo Masjid</label>
                @if ($setting->logo_path)
                    <p class="form-help">Logo saat ini: <a href="{{ asset('storage/' . $setting->logo_path) }}" target="_blank">Lihat logo</a></p>
                @endif
                <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" accept=".jpg,.jpeg,.png">
                @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                <p class="form-help">Format JPG/PNG maksimal 2MB.</p>
            </div>

            <div class="form-group">
                <label for="catatan_laporan" class="form-label">Catatan Laporan</label>
                <textarea name="catatan_laporan" id="catatan_laporan" class="form-control @error('catatan_laporan') is-invalid @enderror" rows="3">{{ old('catatan_laporan', $setting->catatan_laporan) }}</textarea>
                @error('catatan_laporan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" name="transparansi_publik" value="1" id="transparansi_publik" class="form-check-input" @checked(old('transparansi_publik', $setting->transparansi_publik))>
                <label for="transparansi_publik" class="form-check-label">Aktifkan halaman transparansi publik</label>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Simpan Setting
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
