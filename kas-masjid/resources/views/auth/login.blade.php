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
        /* PROFESSIONAL POLISH */
        body {
            background:
                linear-gradient(rgba(7, 21, 19, 0.78), rgba(7, 21, 19, 0.82)),
                linear-gradient(135deg, #0f766e 0%, #0f2f2b 48%, #132e2a 100%);
            overflow: auto;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 255, 255, 0.045) 1px, transparent 1px);
            background-size: 44px 44px;
            mask-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6), transparent 78%);
            pointer-events: none;
        }

        .bg-decoration {
            display: none;
        }

        .login-wrapper {
            min-height: 100vh;
            padding: 32px 18px;
        }

        .login-container {
            max-width: 430px;
            padding: 42px 36px;
            border-radius: 8px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 28px 70px rgba(2, 6, 23, 0.34);
        }

        .logo-icon {
            border-radius: 8px;
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            box-shadow: 0 14px 28px rgba(15, 118, 110, 0.24);
        }

        .login-header h1 {
            color: #0f172a;
            font-size: 1.65rem;
        }

        .login-header p {
            color: #64748b;
            font-weight: 500;
        }

        .form-control {
            border: 1px solid #d8e2df;
            border-radius: 8px;
            background: #fbfdfc;
        }

        .form-control:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.13);
        }

        .form-check-input {
            accent-color: #0f766e;
        }

        .btn-login {
            border-radius: 8px;
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%);
            box-shadow: 0 12px 24px rgba(15, 118, 110, 0.24);
        }

        .btn-login:hover {
            box-shadow: 0 16px 30px rgba(15, 118, 110, 0.28);
        }

        .footer-link a {
            color: #0f766e;
        }

        .footer-link a:hover {
            color: #115e59;
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
                    <svg class="mosque-logo" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <linearGradient id="domegradient" x1="0%" y1="0%" x2="0%" y2="100%">
                                <stop offset="0%" style="stop-color:white;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:white;stop-opacity:0.7" />
                            </linearGradient>
                        </defs>
                        
                        <!-- Main building base -->
                        <rect x="12" y="68" width="96" height="40" fill="white" opacity="0.9" rx="4"/>
                        <path d="M 12 68 L 12 72 Q 12 76 16 76 L 104 76 Q 108 76 108 72 L 108 68" fill="white" opacity="0.95"/>
                        
                        <!-- Main Central Dome (largest) -->
                        <ellipse cx="60" cy="45" rx="32" ry="38" fill="url(#domegradient)" opacity="0.95"/>
                        
                        <!-- Dome highlight/light reflection -->
                        <ellipse cx="52" cy="38" rx="18" ry="22" fill="white" opacity="0.35"/>
                        
                        <!-- Secondary dome left -->
                        <ellipse cx="32" cy="52" rx="20" ry="26" fill="white" opacity="0.85"/>
                        <ellipse cx="28" cy="46" rx="10" ry="14" fill="white" opacity="0.25"/>
                        
                        <!-- Secondary dome right -->
                        <ellipse cx="88" cy="52" rx="20" ry="26" fill="white" opacity="0.85"/>
                        <ellipse cx="92" cy="46" rx="10" ry="14" fill="white" opacity="0.25"/>
                        
                        <!-- Central Spire/Finial with Crescent & Star -->
                        <path d="M 60 8 L 57 28 L 63 28 Z" fill="white"/>
                        <circle cx="60" cy="6" r="2.5" fill="white"/>
                        
                        <!-- Decorative ring below finial -->
                        <circle cx="60" cy="30" r="5" fill="none" stroke="white" stroke-width="0.8" opacity="0.6"/>
                        
                        <!-- Crescent moon element -->
                        <circle cx="58" cy="38" r="7.5" fill="white" opacity="0.8"/>
                        <circle cx="63" cy="38" r="7.5" fill="#4f46e5" opacity="0.95"/>
                        
                        <!-- Star element -->
                        <g transform="translate(63, 32)">
                            <polygon points="0,-4 1.2,-1.5 4,-1.5 1.5,0 2.5,3.5 0,1.5 -2.5,3.5 -1.5,0 -4,-1.5 -1.2,-1.5" fill="white"/>
                        </g>
                        
                        <!-- LEFT MINARET - Detailed -->
                        <rect x="15" y="45" width="8" height="40" fill="white" opacity="0.92"/>
                        <!-- Minaret shaft details -->
                        <line x1="19" y1="55" x2="19" y2="62" stroke="white" stroke-width="1" opacity="0.5"/>
                        <line x1="19" y1="68" x2="19" y2="75" stroke="white" stroke-width="1" opacity="0.5"/>
                        <!-- Minaret top platform -->
                        <rect x="13" y="42" width="12" height="4" fill="white" opacity="0.95"/>
                        <ellipse cx="19" cy="42" rx="6.5" ry="2.5" fill="white" opacity="0.7"/>
                        <!-- Minaret spire -->
                        <path d="M 19 32 L 16 42 L 22 42 Z" fill="white" opacity="0.95"/>
                        <circle cx="19" cy="30" r="2" fill="white"/>
                        <!-- Balcony rings -->
                        <circle cx="19" cy="40" r="4" fill="none" stroke="white" stroke-width="0.6" opacity="0.5"/>
                        
                        <!-- RIGHT MINARET - Detailed -->
                        <rect x="97" y="45" width="8" height="40" fill="white" opacity="0.92"/>
                        <!-- Minaret shaft details -->
                        <line x1="101" y1="55" x2="101" y2="62" stroke="white" stroke-width="1" opacity="0.5"/>
                        <line x1="101" y1="68" x2="101" y2="75" stroke="white" stroke-width="1" opacity="0.5"/>
                        <!-- Minaret top platform -->
                        <rect x="95" y="42" width="12" height="4" fill="white" opacity="0.95"/>
                        <ellipse cx="101" cy="42" rx="6.5" ry="2.5" fill="white" opacity="0.7"/>
                        <!-- Minaret spire -->
                        <path d="M 101 32 L 98 42 L 104 42 Z" fill="white" opacity="0.95"/>
                        <circle cx="101" cy="30" r="2" fill="white"/>
                        <!-- Balcony rings -->
                        <circle cx="101" cy="40" r="4" fill="none" stroke="white" stroke-width="0.6" opacity="0.5"/>
                        
                        <!-- CENTER MINARET (TALLEST) - Most detailed -->
                        <rect x="56" y="32" width="8" height="50" fill="white" opacity="0.95"/>
                        <!-- Minaret shaft bands/details -->
                        <line x1="60" y1="48" x2="60" y2="55" stroke="white" stroke-width="1.2" opacity="0.5"/>
                        <line x1="60" y1="65" x2="60" y2="72" stroke="white" stroke-width="1.2" opacity="0.5"/>
                        <!-- Minaret top platform -->
                        <rect x="54" y="28" width="12" height="5" fill="white" opacity="0.98"/>
                        <ellipse cx="60" cy="28" rx="7" ry="3" fill="white" opacity="0.7"/>
                        <!-- Minaret spire -->
                        <path d="M 60 12 L 56 28 L 64 28 Z" fill="white" opacity="0.98"/>
                        <circle cx="60" cy="10" r="2.5" fill="white"/>
                        <!-- Multiple balcony rings for detail -->
                        <circle cx="60" cy="26" r="5" fill="none" stroke="white" stroke-width="0.8" opacity="0.5"/>
                        <circle cx="60" cy="38" r="4.5" fill="none" stroke="white" stroke-width="0.7" opacity="0.4"/>
                        
                        <!-- Entrance Door -->
                        <rect x="54" y="76" width="12" height="18" fill="#4f46e5" opacity="0.75" rx="1"/>
                        <!-- Door frame -->
                        <rect x="54" y="76" width="12" height="18" fill="none" stroke="white" stroke-width="0.8" opacity="0.4"/>
                        <!-- Door handle -->
                        <circle cx="64" cy="85" r="1.2" fill="white" opacity="0.6"/>
                        
                        <!-- Windows -->
                        <circle cx="32" cy="80" r="2.5" fill="#4f46e5" opacity="0.6"/>
                        <circle cx="88" cy="80" r="2.5" fill="#4f46e5" opacity="0.6"/>
                        <circle cx="28" cy="90" r="2.5" fill="#4f46e5" opacity="0.5"/>
                        <circle cx="92" cy="90" r="2.5" fill="#4f46e5" opacity="0.5"/>
                        
                        <!-- Windows - left side -->
                        <rect x="28" y="80" width="5" height="5" fill="#4f46e5" opacity="0.6" rx="1"/>
                        <line x1="30.5" y1="80" x2="30.5" y2="85" stroke="white" stroke-width="0.5" opacity="0.4"/>
                        <line x1="28" y1="82.5" x2="33" y2="82.5" stroke="white" stroke-width="0.5" opacity="0.4"/>
                        
                        <rect x="28" y="88" width="5" height="5" fill="#4f46e5" opacity="0.6" rx="1"/>
                        <line x1="30.5" y1="88" x2="30.5" y2="93" stroke="white" stroke-width="0.5" opacity="0.4"/>
                        <line x1="28" y1="90.5" x2="33" y2="90.5" stroke="white" stroke-width="0.5" opacity="0.4"/>
                        
                        <!-- Windows - right side -->
                        <rect x="87" y="80" width="5" height="5" fill="#4f46e5" opacity="0.6" rx="1"/>
                        <line x1="89.5" y1="80" x2="89.5" y2="85" stroke="white" stroke-width="0.5" opacity="0.4"/>
                        <line x1="87" y1="82.5" x2="92" y2="82.5" stroke="white" stroke-width="0.5" opacity="0.4"/>
                        
                        <rect x="87" y="88" width="5" height="5" fill="#4f46e5" opacity="0.6" rx="1"/>
                        <line x1="89.5" y1="88" x2="89.5" y2="93" stroke="white" stroke-width="0.5" opacity="0.4"/>
                        <line x1="87" y1="90.5" x2="92" y2="90.5" stroke="white" stroke-width="0.5" opacity="0.4"/>
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
