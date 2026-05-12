<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kas Masjid Baitul Rahman')</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-dark: #4338ca;
            --secondary-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --sidebar-bg: #1e293b;
            --sidebar-hover: #334155;
            --navbar-bg: #0f172a;
            --text-light: #e2e8f0;
            --text-dark: #1e293b;
            --bg-light: #f8fafc;
            --border-color: #cbd5e1;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR STYLES */
        .sidebar {
            width: 260px;
            background: linear-gradient(135deg, var(--sidebar-bg) 0%, #0f172a 100%);
            padding: 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            transition: transform 0.3s ease;
        }

        .sidebar-header {
            padding: 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            background: rgba(0, 0, 0, 0.2);
        }

        .sidebar-header h4 {
            color: var(--text-light);
            margin: 0;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 1.3rem;
        }

        .sidebar-nav {
            padding: 20px 0;
        }

        .nav-item {
            margin: 0;
        }

        .nav-link {
            color: rgba(226, 232, 240, 0.7);
            padding: 12px 25px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 3px solid transparent;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            text-decoration: none;
        }

        .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--text-light);
            border-left-color: var(--primary-color);
            padding-left: 28px;
        }

        .nav-link.active {
            background-color: var(--sidebar-hover);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            padding-left: 28px;
            font-weight: 600;
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 15px 0;
        }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s ease;
        }

        /* NAVBAR */
        .navbar-top {
            background: linear-gradient(135deg, var(--navbar-bg) 0%, var(--sidebar-bg) 100%);
            padding: 15px 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: var(--text-light);
        }

        .navbar-title {
            font-size: 1.2rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .navbar-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary-color);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--text-light);
            cursor: pointer;
            padding: 0;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }

        .logout-btn:hover {
            color: var(--danger-color);
        }

        /* CONTENT AREA */
        .content-wrapper {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .page-header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin: 0;
        }

        /* ALERTS */
        .alert {
            border: none;
            border-radius: 8px;
            margin-bottom: 20px;
            animation: slideIn 0.3s ease;
        }

        .alert-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .alert-success {
            background-color: #ecfdf5;
            color: #065f46;
        }

        .alert-warning {
            background-color: #fffbeb;
            color: #78350f;
        }

        .alert-info {
            background-color: #eff6ff;
            color: #0c2340;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* CARDS */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-bottom: 1px solid var(--border-color);
            border-radius: 10px 10px 0 0;
        }

        /* STAT CARDS */
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 25px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border-left: 4px solid var(--primary-color);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .stat-card.income {
            border-left-color: var(--secondary-color);
        }

        .stat-card.expense {
            border-left-color: var(--danger-color);
        }

        .stat-card.balance {
            border-left-color: var(--primary-color);
        }

        .stat-label {
            font-size: 0.85rem;
            color: #64748b;
            font-weight: 500;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 0.85rem;
            color: #64748b;
        }

        /* BUTTONS */
        .btn {
            border: none;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .btn-success {
            background-color: var(--secondary-color);
            color: white;
        }

        .btn-success:hover {
            background-color: #059669;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger-color);
            color: white;
        }

        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
        }

        .btn-warning {
            background-color: var(--warning-color);
            color: white;
        }

        .btn-warning:hover {
            background-color: #d97706;
            transform: translateY(-2px);
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        /* TABLES */
        .table {
            color: var(--text-dark);
        }

        .table thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid var(--border-color);
            color: var(--text-dark);
            font-weight: 600;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-bottom: 1px solid var(--border-color);
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        /* BADGES */
        .badge {
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-approved {
            background-color: #d1fae5;
            color: #065f46;
        }

        .badge-rejected {
            background-color: #fee2e2;
            color: #991b1b;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
                width: 100%;
            }

            .content-wrapper {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .navbar-top {
                padding: 12px 15px;
            }

            .navbar-title {
                font-size: 1rem;
            }

            .table {
                font-size: 0.85rem;
            }

            .table thead th,
            .table tbody td {
                padding: 10px;
            }
        }

        /* SCROLLBAR */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.05);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* PROFESSIONAL POLISH */
        :root {
            --primary-color: #0f766e;
            --primary-dark: #115e59;
            --secondary-color: #16a34a;
            --danger-color: #dc2626;
            --warning-color: #d97706;
            --sidebar-bg: #0b1f1d;
            --sidebar-hover: rgba(20, 184, 166, 0.12);
            --navbar-bg: #ffffff;
            --text-light: #f8fafc;
            --text-dark: #0f172a;
            --bg-light: #f4f7f6;
            --border-color: #d9e2df;
            --muted-color: #64748b;
            --surface-color: #ffffff;
            --ring-color: rgba(15, 118, 110, 0.18);
        }

        body {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            background:
                radial-gradient(circle at top left, rgba(20, 184, 166, 0.12), transparent 34rem),
                linear-gradient(180deg, #f7faf9 0%, var(--bg-light) 100%);
            color: var(--text-dark);
        }

        .sidebar {
            background:
                linear-gradient(180deg, rgba(20, 184, 166, 0.14) 0%, rgba(15, 23, 42, 0) 45%),
                linear-gradient(180deg, #0f2f2b 0%, #071513 100%);
            box-shadow: 14px 0 35px rgba(15, 23, 42, 0.12);
        }

        .sidebar-header {
            padding: 24px 22px;
            background: rgba(255, 255, 255, 0.04);
            border-bottom: 1px solid rgba(255, 255, 255, 0.09);
        }

        .sidebar-header h4 {
            font-size: 1.05rem;
            letter-spacing: 0.08em;
        }

        .sidebar-nav {
            padding: 18px 12px;
        }

        .nav-link {
            border-left: 0;
            border-radius: 8px;
            margin-bottom: 6px;
            padding: 12px 14px;
            color: rgba(248, 250, 252, 0.72);
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--sidebar-hover);
            color: #ffffff;
            border-left-color: transparent;
            padding-left: 14px;
        }

        .nav-link.active {
            box-shadow: inset 3px 0 0 #2dd4bf;
            font-weight: 650;
        }

        .navbar-top {
            min-height: 74px;
            background: rgba(255, 255, 255, 0.88);
            color: var(--text-dark);
            border-bottom: 1px solid rgba(148, 163, 184, 0.22);
            box-shadow: 0 10px 28px rgba(15, 23, 42, 0.05);
            backdrop-filter: blur(14px);
        }

        .navbar-title {
            color: #0f172a;
            font-size: 1.05rem;
        }

        .navbar-title i {
            color: var(--primary-color);
        }

        .user-avatar {
            background: linear-gradient(135deg, #0f766e 0%, #14b8a6 100%);
            box-shadow: 0 8px 18px rgba(15, 118, 110, 0.22);
        }

        .content-wrapper {
            padding: 34px;
        }

        .page-header h1,
        .dashboard-header h1 {
            letter-spacing: 0;
        }

        .card,
        .stat-card,
        .chart-card,
        .activity-card,
        .table-container {
            border: 1px solid rgba(148, 163, 184, 0.18) !important;
            border-radius: 8px !important;
            box-shadow: 0 14px 34px rgba(15, 23, 42, 0.07) !important;
        }

        .card:hover,
        .stat-card:hover,
        .chart-card:hover,
        .activity-card:hover,
        .table-container:hover {
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.09) !important;
        }

        .card-header,
        .table thead,
        .table thead th {
            background: #f8fbfa !important;
        }

        .table {
            --bs-table-hover-bg: #f7fbfa;
        }

        .table thead th {
            border-bottom: 1px solid var(--border-color);
            color: #334155;
            font-size: 0.75rem;
            letter-spacing: 0.08em;
        }

        .table tbody td {
            color: #475569;
            border-bottom-color: #e6eeeb;
        }

        .form-control,
        .form-select {
            border-color: #d8e2df;
            border-radius: 8px;
            min-height: 42px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.22rem var(--ring-color);
        }

        .btn,
        .btn-add,
        .btn-action,
        .status-badge,
        .badge {
            border-radius: 8px !important;
        }

        .btn-primary,
        .btn-add {
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%) !important;
            box-shadow: 0 10px 20px rgba(15, 118, 110, 0.16);
        }

        .btn-primary:hover,
        .btn-add:hover {
            background: linear-gradient(135deg, #115e59 0%, #0f766e 100%) !important;
            box-shadow: 0 14px 26px rgba(15, 118, 110, 0.2);
        }

        .mobile-menu-btn {
            display: none;
            width: 40px;
            height: 40px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            background: #ffffff;
            color: var(--primary-color);
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.42);
            z-index: 999;
        }

        .sidebar-backdrop.show {
            display: block;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: inline-flex;
            }

            .navbar-title span {
                display: none;
            }

            .navbar-actions .user-profile > div:last-child {
                display: none;
            }

            .content-wrapper {
                padding: 20px 16px;
            }
        }

        /* SECOND PASS: APP-WIDE DETAILS */
        .content-wrapper {
            max-width: 1480px;
            width: 100%;
            margin: 0 auto;
        }

        .page-header {
            background: rgba(255, 255, 255, 0.86);
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 8px;
            padding: 22px 24px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.055);
        }

        .page-header h1 {
            font-size: 1.55rem !important;
            color: #0f172a !important;
        }

        .page-header h1 i {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 118, 110, 0.1);
            color: var(--primary-color) !important;
            font-size: 1.35rem !important;
        }

        .table-container {
            padding: 0 !important;
            overflow: hidden !important;
        }

        .filter-card {
            background: #ffffff;
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 8px;
            padding: 18px;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.06);
            margin-bottom: 22px;
        }

        .table-wrapper,
        .table-responsive {
            display: block !important;
            width: 100%;
            overflow-x: auto;
        }

        .table {
            min-width: 840px;
        }

        .table tbody tr:last-child td {
            border-bottom: 0;
        }

        .table tbody td > span[style*="border-radius: 20px"] {
            display: inline-flex !important;
            align-items: center;
            min-height: 30px;
            border-radius: 6px !important;
            background: #ecfdf5 !important;
            color: #0f766e !important;
            border: 1px solid rgba(15, 118, 110, 0.12);
        }

        .amount-cell,
        td strong {
            white-space: nowrap;
        }

        .action-buttons form {
            margin: 0;
        }

        .btn-action {
            min-width: 36px;
            min-height: 36px;
            box-shadow: none !important;
        }

        .btn-edit {
            background: #fff7ed !important;
            color: #9a3412 !important;
        }

        .btn-delete,
        .btn-reject {
            background: #fef2f2 !important;
            color: #991b1b !important;
        }

        .btn-approve {
            background: #ecfdf5 !important;
            color: #047857 !important;
        }

        .empty-state {
            padding: 64px 24px !important;
            background:
                linear-gradient(180deg, rgba(248, 251, 250, 0.76), #ffffff),
                radial-gradient(circle at center top, rgba(15, 118, 110, 0.1), transparent 20rem);
        }

        .empty-state i {
            width: 64px;
            height: 64px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: #f1f5f9;
            color: #94a3b8 !important;
            font-size: 2rem !important;
        }

        .pagination {
            padding: 18px 24px 24px;
            margin-top: 0 !important;
        }

        .pagination .page-link,
        .pagination a,
        .pagination span {
            border-radius: 8px !important;
        }

        .pagination .active .page-link,
        .pagination .active,
        .page-item.active .page-link {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .form-container {
            max-width: 760px !important;
            margin: 0 auto;
        }

        .form-card {
            border: 1px solid rgba(148, 163, 184, 0.18);
            border-radius: 8px !important;
            box-shadow: 0 18px 42px rgba(15, 23, 42, 0.08) !important;
            padding: 34px !important;
        }

        .form-card h1 {
            font-size: 1.55rem !important;
            color: #0f172a !important;
        }

        .form-card h1 i {
            width: 42px;
            height: 42px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 118, 110, 0.1);
            color: var(--primary-color) !important;
            font-size: 1.3rem !important;
        }

        .form-subtitle,
        .form-help {
            color: var(--muted-color) !important;
        }

        .form-label {
            color: #334155 !important;
            font-size: 0.88rem !important;
        }

        .btn-submit {
            background: linear-gradient(135deg, #0f766e 0%, #0d9488 100%) !important;
            border-radius: 8px !important;
            box-shadow: 0 12px 24px rgba(15, 118, 110, 0.2) !important;
        }

        .btn-cancel,
        .btn-outline-secondary {
            background: #f8fafc !important;
            border: 1px solid #d8e2df !important;
            color: #334155 !important;
        }

        .info-alert,
        .warning-alert {
            border-radius: 8px !important;
            border-left: 0 !important;
            border: 1px solid rgba(148, 163, 184, 0.18);
        }

        .info-alert {
            background: #ecfdf5 !important;
        }

        .info-alert p {
            color: #065f46 !important;
        }

        .warning-alert {
            background: #fffbeb !important;
        }

        .row.mb-4 > .col-md-8 h3 {
            color: #0f172a;
            font-weight: 750;
        }

        .row.mb-4 > .col-md-8 p {
            color: var(--muted-color) !important;
        }

        .card.p-4,
        .card.mb-4.p-4 {
            padding: 26px !important;
        }

        .card h5,
        .card h6 {
            color: #0f172a;
            font-weight: 700;
        }

        .badge.bg-primary {
            background-color: #0f766e !important;
        }

        .badge.bg-success {
            background-color: #16a34a !important;
        }

        .badge.bg-danger {
            background-color: #dc2626 !important;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 18px;
            }

            .form-card {
                padding: 22px !important;
            }

            .table-container {
                border-radius: 8px !important;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- SIDEBAR -->
    <nav class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div style="display: flex; align-items: center; gap: 12px;">
                <!-- Mosque Logo SVG -->
                <svg width="40" height="40" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg" style="flex-shrink: 0;">
                    <defs>
                        <linearGradient id="dome-grad" x1="0%" y1="0%" x2="0%" y2="100%">
                            <stop offset="0%" style="stop-color:white;stop-opacity:1" />
                            <stop offset="100%" style="stop-color:white;stop-opacity:0.75" />
                        </linearGradient>
                    </defs>
                    <!-- Main building base -->
                    <rect x="12" y="68" width="96" height="40" fill="white" opacity="0.9" rx="4"/>
                    <path d="M 12 68 L 12 72 Q 12 76 16 76 L 104 76 Q 108 76 108 72 L 108 68" fill="white" opacity="0.95"/>
                    
                    <!-- Main Central Dome -->
                    <ellipse cx="60" cy="45" rx="32" ry="38" fill="url(#dome-grad)"/>
                    <ellipse cx="52" cy="38" rx="18" ry="22" fill="white" opacity="0.35"/>
                    
                    <!-- Secondary domes -->
                    <ellipse cx="32" cy="52" rx="20" ry="26" fill="white" opacity="0.85"/>
                    <ellipse cx="28" cy="46" rx="10" ry="14" fill="white" opacity="0.25"/>
                    <ellipse cx="88" cy="52" rx="20" ry="26" fill="white" opacity="0.85"/>
                    <ellipse cx="92" cy="46" rx="10" ry="14" fill="white" opacity="0.25"/>
                    
                    <!-- Central Spire with Crescent & Star -->
                    <path d="M 60 8 L 57 28 L 63 28 Z" fill="white"/>
                    <circle cx="60" cy="6" r="2.5" fill="white"/>
                    <circle cx="60" cy="30" r="5" fill="none" stroke="white" stroke-width="0.8" opacity="0.6"/>
                    
                    <!-- Crescent moon -->
                    <circle cx="58" cy="38" r="7.5" fill="white" opacity="0.8"/>
                    <circle cx="63" cy="38" r="7.5" fill="#4f46e5" opacity="0.95"/>
                    
                    <!-- Star -->
                    <g transform="translate(63, 32)">
                        <polygon points="0,-4 1.2,-1.5 4,-1.5 1.5,0 2.5,3.5 0,1.5 -2.5,3.5 -1.5,0 -4,-1.5 -1.2,-1.5" fill="white"/>
                    </g>
                    
                    <!-- Left minaret -->
                    <rect x="15" y="45" width="8" height="40" fill="white" opacity="0.92"/>
                    <line x1="19" y1="55" x2="19" y2="62" stroke="white" stroke-width="1" opacity="0.5"/>
                    <line x1="19" y1="68" x2="19" y2="75" stroke="white" stroke-width="1" opacity="0.5"/>
                    <rect x="13" y="42" width="12" height="4" fill="white" opacity="0.95"/>
                    <path d="M 19 32 L 16 42 L 22 42 Z" fill="white" opacity="0.95"/>
                    <circle cx="19" cy="30" r="2" fill="white"/>
                    
                    <!-- Right minaret -->
                    <rect x="97" y="45" width="8" height="40" fill="white" opacity="0.92"/>
                    <line x1="101" y1="55" x2="101" y2="62" stroke="white" stroke-width="1" opacity="0.5"/>
                    <line x1="101" y1="68" x2="101" y2="75" stroke="white" stroke-width="1" opacity="0.5"/>
                    <rect x="95" y="42" width="12" height="4" fill="white" opacity="0.95"/>
                    <path d="M 101 32 L 98 42 L 104 42 Z" fill="white" opacity="0.95"/>
                    <circle cx="101" cy="30" r="2" fill="white"/>
                    
                    <!-- Center minaret (tallest) -->
                    <rect x="56" y="32" width="8" height="50" fill="white" opacity="0.95"/>
                    <line x1="60" y1="48" x2="60" y2="55" stroke="white" stroke-width="1.2" opacity="0.5"/>
                    <line x1="60" y1="65" x2="60" y2="72" stroke="white" stroke-width="1.2" opacity="0.5"/>
                    <rect x="54" y="28" width="12" height="5" fill="white" opacity="0.98"/>
                    <path d="M 60 12 L 56 28 L 64 28 Z" fill="white" opacity="0.98"/>
                    <circle cx="60" cy="10" r="2.5" fill="white"/>
                    
                    <!-- Door -->
                    <rect x="54" y="76" width="12" height="18" fill="#4f46e5" opacity="0.75" rx="1"/>
                    <rect x="54" y="76" width="12" height="18" fill="none" stroke="white" stroke-width="0.8" opacity="0.4"/>
                    <circle cx="64" cy="85" r="1.2" fill="white" opacity="0.6"/>
                    
                    <!-- Windows -->
                    <circle cx="32" cy="80" r="2.5" fill="#4f46e5" opacity="0.6"/>
                    <circle cx="88" cy="80" r="2.5" fill="#4f46e5" opacity="0.6"/>
                    <circle cx="28" cy="90" r="2.5" fill="#4f46e5" opacity="0.5"/>
                    <circle cx="92" cy="90" r="2.5" fill="#4f46e5" opacity="0.5"/>
                </svg>
                <h4 style="margin: 0; white-space: nowrap;">KAS MASJID</h4>
            </div>
        </div>

        <div class="sidebar-nav">
            <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active @endif">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('kas_masuk.index') }}" class="nav-link @if(request()->routeIs('kas_masuk.*')) active @endif">
                <i class="bi bi-arrow-down-circle"></i>
                <span>Kas Masuk</span>
            </a>

            <a href="{{ route('kas_keluar.index') }}" class="nav-link @if(request()->routeIs('kas_keluar.*')) active @endif">
                <i class="bi bi-arrow-up-circle"></i>
                <span>Kas Keluar</span>
            </a>

            <a href="{{ route('laporan.index') }}" class="nav-link @if(request()->routeIs('laporan.*')) active @endif">
                <i class="bi bi-journal-text"></i>
                <span>Laporan Keuangan</span>
            </a>

            @if (auth()->user()->role === 'admin')
                <a href="{{ route('audit_logs.index') }}" class="nav-link @if(request()->routeIs('audit_logs.*')) active @endif">
                    <i class="bi bi-activity"></i>
                    <span>Audit Log</span>
                </a>

                <a href="{{ route('settings.masjid.edit') }}" class="nav-link @if(request()->routeIs('settings.masjid.*')) active @endif">
                    <i class="bi bi-gear"></i>
                    <span>Setting Masjid</span>
                </a>
            @endif

            <a href="{{ route('transparansi.index') }}" class="nav-link" target="_blank">
                <i class="bi bi-globe2"></i>
                <span>Transparansi Publik</span>
            </a>

            <div class="sidebar-divider"></div>

            <form action="{{ route('logout') }}" method="POST" class="nav-item">
                @csrf
                <button type="submit" class="nav-link" style="border: none; width: 100%; text-align: left;">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>
    <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- NAVBAR -->
        <nav class="navbar-top">
            <div class="navbar-title">
                <button type="button" class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Buka menu">
                    <i class="bi bi-list"></i>
                </button>
                <i class="bi bi-building"></i>
                <span>Masjid Jami Baitul Rahman</span>
            </div>

            <div class="navbar-actions">
                <div class="user-profile">
                    <div class="user-avatar" title="{{ Auth::user()->name }}">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </div>
                    <div>
                        <div style="font-size: 0.9rem; font-weight: 500;">{{ Auth::user()->name }}</div>
                        <div style="font-size: 0.8rem; color: #94a3b8;">{{ Auth::user()->role }}</div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- CONTENT -->
        <div class="content-wrapper">
            <!-- ALERTS -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="bi bi-exclamation-circle"></i> Terjadi kesalahan!</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('warning'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-triangle"></i> {{ session('warning') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle"></i> {{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Mobile menu toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuBtn = document.getElementById('mobileMenuBtn');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            
            function closeSidebar() {
                sidebar.classList.remove('show');
                sidebarBackdrop.classList.remove('show');
            }

            mobileMenuBtn?.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                sidebarBackdrop.classList.toggle('show');
            });

            sidebarBackdrop?.addEventListener('click', closeSidebar);

            window.addEventListener('resize', function() {
                if (window.innerWidth > 768) {
                    closeSidebar();
                }
            });

            const rupiahInputs = document.querySelectorAll('.rupiah-input');
            const formatter = new Intl.NumberFormat('id-ID');

            function onlyDigits(value) {
                return value.replace(/[^\d]/g, '');
            }

            function formatRupiahInput(input) {
                const digits = onlyDigits(input.value);
                input.value = digits ? 'Rp ' + formatter.format(Number(digits)) : '';
            }

            rupiahInputs.forEach(function(input) {
                formatRupiahInput(input);

                input.addEventListener('input', function() {
                    formatRupiahInput(input);
                });

                input.form?.addEventListener('submit', function() {
                    input.value = onlyDigits(input.value);
                });
            });
        });
    </script>
    
    @yield('scripts')
</body>
</html>
