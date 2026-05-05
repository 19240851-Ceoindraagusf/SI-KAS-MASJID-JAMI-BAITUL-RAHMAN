<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kas Masjid Baitul Rahman')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f5f5f5;
        }
        .sidebar {
            width: 250px;
            background-color: #2c3e50;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: background-color 0.3s;
        }
        .sidebar a:hover,
        .sidebar a.active {
            background-color: #34495e;
            border-left: 4px solid #3498db;
            padding-left: 16px;
        }
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid #34495e;
            color: #ecf0f1;
            font-size: 18px;
            font-weight: bold;
        }
        .main-content {
            margin-left: 250px;
            width: calc(100% - 250px);
            display: flex;
            flex-direction: column;
        }
        .navbar-custom {
            background-color: #34495e;
            padding: 15px 30px;
            color: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .container-fluid {
            padding: 30px;
            flex: 1;
        }
        .card {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .btn-primary {
            background-color: #3498db;
            border: none;
        }
        .btn-primary:hover {
            background-color: #2980b9;
        }
        .stat-card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .stat-value {
            font-size: 28px;
            font-weight: bold;
            color: #2c3e50;
        }
        .stat-label {
            color: #7f8c8d;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .main-content {
                margin-left: 0;
                width: 100%;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-piggy-bank"></i> Kas Masjid
        </div>
        <a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('kas_masuk.index') }}" class="@if(request()->routeIs('kas_masuk.*')) active @endif">
            <i class="bi bi-arrow-down-circle"></i> Kas Masuk
        </a>
        <a href="{{ route('kas_keluar.index') }}" class="@if(request()->routeIs('kas_keluar.*')) active @endif">
            <i class="bi bi-arrow-up-circle"></i> Kas Keluar
        </a>
        <a href="{{ route('laporan.index') }}" class="@if(request()->routeIs('laporan.*')) active @endif">
            <i class="bi bi-journal-text"></i> Laporan Keuangan
        </a>
        <hr style="background-color: #34495e; margin: 20px 0;">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link" style="color: #ecf0f1; text-align: left; padding: 12px 20px;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>

    <div class="main-content">
        <div class="navbar-custom">
            <div class="d-flex justify-content-between align-items-center">
                <h5 style="margin: 0;">Sistem Informasi Kas Masjid Jami Baitul Rahman</h5>
                <span>{{ Auth::user()->name }} ({{ Auth::user()->role }})</span>
            </div>
        </div>

        <div class="container-fluid">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Terjadi kesalahan!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>
