@extends('layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Verifikasi Email Anda</h5>
            </div>
            <div class="card-body">
                <p>Terima kasih telah mendaftar. Sebelum melanjutkan, silakan verifikasi email Anda dengan mengklik link yang telah kami kirimkan.</p>

                @if (session('resent'))
                    <div class="alert alert-success">
                        Link verifikasi baru telah dikirim ke email Anda.
                    </div>
                @endif

                <p>Jika Anda tidak menerima email:</p>
                <form action="{{ route('verification.send') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-primary">Kirim Ulang Email Verifikasi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
