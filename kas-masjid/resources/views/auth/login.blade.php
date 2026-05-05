<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kas Masjid Baitul Rahman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #06b6d4 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background elements */
        .bg-decoration {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
        }

        .decoration-1 {
            width: 400px;
            height: 400px;
            background: white;
            top: -100px;
            left: -100px;
            animation: float 6s ease-in-out infinite;
        }

        .decoration-2 {
            width: 300px;
            height: 300px;
            background: white;
            bottom: -50px;
            right: -50px;
            animation: float 8s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(30px); }
        }

        .login-wrapper {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            position: relative;
            z-index: 1;
        }

        .login-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
            padding: 50px 40px;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo-icon {
            width: 90px;
            height: 90px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.3);
        }

        .mosque-logo {
            width: 65px;
            height: 65px;
        }

        .login-header h1 {
            font-size: 1.8rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .login-header p {
            color: #64748b;
            font-size: 1rem;
            margin: 0;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 10px;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: #f8fafc;
        }

        .form-control:focus {
            border-color: #4f46e5;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
            outline: none;
        }

        .form-control.is-invalid {
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

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 25px;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            border: 2px solid #cbd5e1;
            border-radius: 4px;
            cursor: pointer;
            accent-color: #4f46e5;
        }

        .form-check-label {
            margin: 0;
            cursor: pointer;
            color: #64748b;
            font-size: 0.95rem;
        }

        .alert {
            border: none;
            border-radius: 10px;
            padding: 14px 16px;
            margin-bottom: 20px;
            font-size: 0.95rem;
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
            border-left: 4px solid #ef4444;
        }

        .btn-login {
            width: 100%;
            padding: 13px 20px;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
            color: #cbd5e1;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            position: relative;
            background: white;
            padding: 0 10px;
        }

        .footer-link {
            text-align: center;
            margin-top: 25px;
            color: #64748b;
            font-size: 0.95rem;
        }

        .footer-link a {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .footer-link a:hover {
            color: #7c3aed;
            text-decoration: underline;
        }

        /* Mobile responsive */
        @media (max-width: 576px) {
            .login-container {
                padding: 40px 25px;
            }

            .login-header h1 {
                font-size: 1.5rem;
            }

            .logo-icon {
                width: 75px;
                height: 75px;
            }

            .mosque-logo {
                width: 55px;
                height: 55px;
            }

            .decoration-1,
            .decoration-2 {
                display: none;
            }
        }
    </style>
</head>
<body>
    <!-- Background decorations -->
    <div class="bg-decoration decoration-1"></div>
    <div class="bg-decoration decoration-2"></div>

    <!-- Login wrapper -->
    <div class="login-wrapper">
        <div class="login-container">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-icon">
                    <svg class="mosque-logo" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                        <!-- Main dome -->
                        <ellipse cx="50" cy="40" rx="28" ry="32" fill="white" opacity="0.9"/>
                        
                        <!-- Dome top -->
                        <path d="M 50 8 Q 65 25 58 40 Q 50 50 42 40 Q 35 25 50 8" fill="white"/>
                        
                        <!-- Crescent moon on dome -->
                        <circle cx="50" cy="28" r="8" fill="white" opacity="0.7"/>
                        <circle cx="54" cy="28" r="8" fill="#4f46e5"/>
                        
                        <!-- Star on crescent -->
                        <g transform="translate(54, 22)">
                            <polygon points="0,-3 1,-1 3,-1 1,0 2,2 0,1 -2,2 -1,0 -3,-1 -1,-1" fill="white"/>
                        </g>
                        
                        <!-- Left minaret -->
                        <rect x="18" y="45" width="6" height="30" fill="white" opacity="0.85"/>
                        <rect x="16" y="42" width="10" height="4" fill="white" opacity="0.9"/>
                        <polygon points="16,42 26,42 23,38 19,38" fill="white"/>
                        
                        <!-- Right minaret -->
                        <rect x="76" y="45" width="6" height="30" fill="white" opacity="0.85"/>
                        <rect x="74" y="42" width="10" height="4" fill="white" opacity="0.9"/>
                        <polygon points="74,42 84,42 81,38 77,38" fill="white"/>
                        
                        <!-- Center minaret (taller) -->
                        <rect x="47" y="35" width="6" height="40" fill="white" opacity="0.9"/>
                        <rect x="45" y="32" width="10" height="4" fill="white"/>
                        <polygon points="45,32 55,32 52,26 48,26" fill="white"/>
                        
                        <!-- Base building -->
                        <rect x="20" y="75" width="60" height="20" fill="white" opacity="0.8" rx="2"/>
                        
                        <!-- Door -->
                        <rect x="46" y="80" width="8" height="15" fill="#4f46e5" opacity="0.6"/>
                        
                        <!-- Windows -->
                        <circle cx="30" cy="83" r="2" fill="#4f46e5" opacity="0.5"/>
                        <circle cx="70" cy="83" r="2" fill="#4f46e5" opacity="0.5"/>
                        <circle cx="30" cy="88" r="2" fill="#4f46e5" opacity="0.5"/>
                        <circle cx="70" cy="88" r="2" fill="#4f46e5" opacity="0.5"/>
                    </svg>
                </div>
                <h1>Kas Masjid</h1>
                <p>Baitul Rahman</p>
            </div>

            <!-- Alerts -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="bi bi-exclamation-circle"></i> Terjadi kesalahan!</strong>
                    <div style="margin-top: 10px;">
                        @foreach ($errors->all() as $error)
                            <div>• {{ $error }}</div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Login form -->
            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="bi bi-envelope"></i> Email
                    </label>
                    <input 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        placeholder="Masukkan email Anda"
                        required 
                        autofocus
                    >
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="bi bi-lock"></i> Password
                    </label>
                    <input 
                        type="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password" 
                        name="password" 
                        placeholder="Masukkan password Anda"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check">
                    <input 
                        type="checkbox" 
                        class="form-check-input" 
                        id="remember" 
                        name="remember"
                    >
                    <label class="form-check-label" for="remember">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </button>
            </form>

            <!-- Footer -->
            <div class="footer-link">
                Belum punya akun? 
                <a href="{{ route('register') }}">Daftar di sini</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
