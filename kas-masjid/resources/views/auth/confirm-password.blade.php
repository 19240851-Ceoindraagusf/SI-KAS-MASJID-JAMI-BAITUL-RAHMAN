@extends('layouts.app')

@section('title', 'Konfirmasi Password')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Konfirmasi Password</h5>
            </div>
            <div class="card-body">
                <p>Ini adalah area yang aman dari aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan.</p>

                <form action="{{ route('password.confirm') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required autofocus>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Konfirmasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
