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

        /* ==================== ENHANCED BACKGROUND ==================== */
        body {
            font-family: 'Segoe UI', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            background: linear-gradient(135deg, #0a1428 0%, #1a3a4a 30%, #0f766e 60%, #14b8a6 100%);
            position: relative;
            overflow: hidden;
            color: #1e293b;
        }

        /* Animated floating elements */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(20, 184, 166, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(79, 70, 229, 0.15) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
                radial-gradient(circle at 60% 70%, rgba(255, 255, 255, 0.02) 1px, transparent 1px);
            background-size: 50px 50px;
            pointer-events: none;
            z-index: 0;
            animation: moveBackground 20s linear infinite;
        }

        @keyframes moveBackground {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        /* Floating particles animation */
        .bg-decoration {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 1;
        }

        .decoration-1 {
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(20, 184, 166, 0.3) 0%, rgba(20, 184, 166, 0) 70%);
            top: -100px;
            left: -100px;
            animation: float 8s ease-in-out infinite;
            filter: blur(40px);
        }

        .decoration-2 {
            width: 250px;
            height: 250px;
            background: radial-gradient(circle, rgba(79, 70, 229, 0.25) 0%, rgba(79, 70, 229, 0) 70%);
            bottom: -50px;
            right: -50px;
            animation: float 10s ease-in-out infinite reverse;
            filter: blur(40px);
        }

        .decoration-3 {
            width: 200px;
            height: 200px;
            background: radial-gradient(circle, rgba(106, 90, 205, 0.2) 0%, rgba(106, 90, 205, 0) 70%);
            top: 50%;
            right: 10%;
            animation: float 12s ease-in-out infinite;
            filter: blur(50px);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) translateX(0px); }
            25% { transform: translateY(-20px) translateX(10px); }
            50% { transform: translateY(20px) translateX(-10px); }
            75% { transform: translateY(-10px) translateX(20px); }
        }

        /* ==================== LOGIN CONTAINER ==================== */
        .login-wrapper {
            width: 100%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            position: relative;
            z-index: 10;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 24px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.25), 
                        0 0 1px rgba(255, 255, 255, 0.5) inset;
            width: 100%;
            max-width: 480px;
            padding: 60px 45px;
            animation: slideUp 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(20, 184, 166, 0.5), transparent);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ==================== HEADER SECTION ==================== */
        .login-header {
            text-align: center;
            margin-bottom: 50px;
            position: relative;
        }

        .logo-icon {
            width: 110px;
            height: 110px;
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            box-shadow: 0 20px 50px rgba(15, 118, 110, 0.35), 
                        0 0 0 1px rgba(255, 255, 255, 0.5) inset;
            animation: rotateIn 0.8s cubic-bezier(0.34, 1.56, 0.64, 1);
            position: relative;
            overflow: hidden;
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translate(-100%, -100%) rotate(45deg); }
            100% { transform: translate(100%, 100%) rotate(45deg); }
        }

        @keyframes rotateIn {
            from {
                opacity: 0;
                transform: rotate(-10deg) scale(0.9);
            }
            to {
                opacity: 1;
                transform: rotate(0) scale(1);
            }
        }

        .mosque-logo {
            width: 75px;
            height: 75px;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.1));
        }

        .login-header h1 {
            font-size: 2rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .login-header p {
            color: #64748b;
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        /* ==================== FORM ELEMENTS ==================== */
        .form-group {
            margin-bottom: 28px;
            animation: fadeInUp 0.6s ease forwards;
            opacity: 0;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label {
            display: block;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 12px;
            font-size: 0.95rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            opacity: 0.9;
        }

        .form-label i {
            margin-right: 6px;
            color: #0f766e;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            background-color: #f8fafc;
            width: 100%;
            font-family: inherit;
        }

        .form-control::placeholder {
            color: #94a3b8;
        }

        .form-control:focus {
            border-color: #0f766e;
            background-color: #ffffff;
            box-shadow: 0 0 0 4px rgba(15, 118, 110, 0.15),
                        0 8px 20px rgba(15, 118, 110, 0.2);
            outline: none;
            transform: translateY(-2px);
        }

        .form-control:hover {
            border-color: #cbd5e1;
        }

        .form-control.is-invalid {
            border-color: #ef4444;
            background-color: #fef2f2;
        }

        .password-field {
            position: relative;
        }

        .password-field .form-control {
            padding-right: 52px;
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #64748b;
            font-size: 1.2rem;
            line-height: 1;
            padding: 6px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .password-toggle:hover,
        .password-toggle:focus {
            color: #0f766e;
            outline: none;
        }

        .form-control.is-invalid:focus {
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15),
                        0 8px 20px rgba(239, 68, 68, 0.15);
        }

        .invalid-feedback {
            display: block;
            color: #ef4444;
            font-size: 0.85rem;
            margin-top: 10px;
            font-weight: 600;
        }

        /* ==================== CHECKBOX ==================== */
        .form-check {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
            animation: fadeInUp 0.6s ease forwards;
            animation-delay: 0.4s;
            opacity: 0;
        }

        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #cbd5e1;
            border-radius: 6px;
            cursor: pointer;
            accent-color: #0f766e;
            transition: all 0.3s ease;
            appearance: none;
            -webkit-appearance: none;
            background-color: white;
            flex-shrink: 0;
        }

        .form-check-input:hover {
            border-color: #0f766e;
            box-shadow: 0 0 0 2px rgba(15, 118, 110, 0.1);
        }

        .form-check-input:checked {
            background-color: #0f766e;
            border-color: #0f766e;
            box-shadow: 0 2px 6px rgba(15, 118, 110, 0.3);
        }

        .form-check-label {
            margin: 0;
            cursor: pointer;
            color: #475569;
            font-size: 0.95rem;
            font-weight: 500;
            user-select: none;
        }

        /* ==================== ALERTS ==================== */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 25px;
            font-size: 0.95rem;
            animation: slideDown 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            border-left: 4px solid;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert-danger {
            background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
            color: #7f1d1d;
            border-left-color: #ef4444;
        }

        .alert strong {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
        }

        /* ==================== BUTTON ==================== */
        .btn-login {
            width: 100%;
            padding: 15px 24px;
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 50%, #14b8a6 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow: 0 12px 30px rgba(15, 118, 110, 0.35);
            animation: fadeInUp 0.6s ease forwards;
            animation-delay: 0.5s;
            opacity: 0;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            font-size: 0.95rem;
            position: relative;
            overflow: hidden;
        }

        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .btn-login:hover::before {
            left: 100%;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 16px 40px rgba(15, 118, 110, 0.45);
        }

        .btn-login:active {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px rgba(15, 118, 110, 0.3);
        }

        /* ==================== FOOTER LINKS ==================== */
        .footer-link {
            text-align: center;
            margin-top: 30px;
            color: #64748b;
            font-size: 0.95rem;
            animation: fadeInUp 0.6s ease forwards;
            animation-delay: 0.6s;
            opacity: 0;
        }

        .footer-link a {
            color: #0f766e;
            text-decoration: none;
            font-weight: 700;
            transition: all 0.3s ease;
            position: relative;
        }

        .footer-link a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #0f766e, #14b8a6);
            transition: width 0.3s ease;
        }

        .footer-link a:hover {
            color: #14b8a6;
        }

        .footer-link a:hover::after {
            width: 100%;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 576px) {
            .login-container {
                padding: 45px 30px;
            }

            .login-header h1 {
                font-size: 1.6rem;
            }

            .logo-icon {
                width: 90px;
                height: 90px;
            }

            .mosque-logo {
                width: 65px;
                height: 65px;
            }

            .decoration-1,
            .decoration-2,
            .decoration-3 {
                display: none;
            }

            .form-control {
                padding: 13px 15px;
                font-size: 16px; /* Prevents zoom on iOS */
            }
        }
    </style>
</head>
<body>
    <!-- Background decorations -->
    <div class="bg-decoration decoration-1"></div>
    <div class="bg-decoration decoration-2"></div>
    <div class="bg-decoration decoration-3"></div>

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
                    <div class="password-field">
                        <input 
                            type="password" 
                            class="form-control @error('password') is-invalid @enderror" 
                            id="password" 
                            name="password" 
                            placeholder="Masukkan password Anda"
                            required
                        >
                        <button type="button" class="password-toggle" data-toggle-password="password" aria-label="Tampilkan password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
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
    <script>
        document.querySelectorAll('[data-toggle-password]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.togglePassword);
                const icon = button.querySelector('i');
                const isHidden = input.type === 'password';

                input.type = isHidden ? 'text' : 'password';
                icon.classList.toggle('bi-eye', !isHidden);
                icon.classList.toggle('bi-eye-slash', isHidden);
                button.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            });
        });
    </script>
</body>
</html>
