/**
 * Dark Mode Toggle
 * Mengelola mode gelap dan terang dengan warna yang lebih rapi, konsisten, dan nyaman dipakai.
 */

class DarkModeToggle {
    constructor() {
        this.storageKey = 'kas-masjid-theme';
        this.darkModeClass = 'dark-mode';
        this.toggleSelector = '[data-toggle-dark-mode]';
        this.init();
    }

    init() {
        this.setupStyles();
        this.applyStoredTheme();
        this.setupToggleButton();
    }

    setupStyles() {
        const style = document.createElement('style');
        style.textContent = `
            :root {
                --primary-color: #0f766e;
                --primary-dark: #115e59;
                --secondary-color: #16a34a;
                --danger-color: #dc2626;
                --warning-color: #d97706;
                --sidebar-bg: #0f172a;
                --sidebar-hover: #1e293b;
                --navbar-bg: #ffffff;
                --text-light: #f8fafc;
                --text-dark: #0f172a;
                --bg-light: #f4f7f6;
                --border-color: #d9e2df;
                --surface-color: #ffffff;
                --muted-color: #64748b;
                --soft-bg: #f8fbfa;
                --shadow-color: rgba(15, 23, 42, 0.08);
            }

            :root.dark-mode {
                --primary-color: #34d399;
                --primary-dark: #10b981;
                --secondary-color: #2dd4bf;
                --danger-color: #f87171;
                --warning-color: #fbbf24;
                --sidebar-bg: #07111f;
                --sidebar-hover: #16253b;
                --navbar-bg: #111827;
                --text-light: #f9fafb;
                --text-dark: #f3f4f6;
                --bg-light: #0f172a;
                --border-color: #334155;
                --surface-color: #111827;
                --muted-color: #94a3b8;
                --soft-bg: #172033;
                --shadow-color: rgba(0, 0, 0, 0.28);
            }

            body {
                background: linear-gradient(135deg, rgba(15, 118, 110, 0.08), transparent 35%), var(--bg-light) !important;
                color: var(--text-dark) !important;
                transition: background-color 0.25s ease, color 0.25s ease;
            }

            .dark-mode {
                --bs-body-color: var(--text-light) !important;
                --bs-body-bg: var(--bg-light) !important;
                --bs-secondary-color: rgba(248, 250, 252, 0.84) !important;
                --bs-tertiary-color: rgba(248, 250, 252, 0.72) !important;
                --bs-emphasis-color: #ffffff !important;
                --bs-heading-color: var(--text-light) !important;
                --bs-link-color: #d1fae5 !important;
                --bs-link-hover-color: #f0fdf4 !important;
                --bs-table-color: var(--text-light) !important;
                --bs-table-bg: var(--surface-color) !important;
                --bs-table-striped-color: var(--text-light) !important;
                --bs-table-striped-bg: rgba(255, 255, 255, 0.03) !important;
                --bs-table-hover-color: var(--text-light) !important;
                --bs-table-hover-bg: rgba(52, 211, 153, 0.08) !important;
                --bs-border-color: var(--border-color) !important;
            }

            .dark-mode body,
            .dark-mode,
            .dark-mode .content-wrapper,
            .dark-mode .page-header,
            .dark-mode .card,
            .dark-mode .card-body,
            .dark-mode .card-header,
            .dark-mode .table,
            .dark-mode .table th,
            .dark-mode .table td,
            .dark-mode .form-label,
            .dark-mode .form-control,
            .dark-mode .form-select,
            .dark-mode .form-check-label,
            .dark-mode .input-group-text,
            .dark-mode .dropdown-menu,
            .dark-mode .modal-content,
            .dark-mode .accordion-item,
            .dark-mode .accordion-button,
            .dark-mode .list-group-item,
            .dark-mode .nav-link,
            .dark-mode .breadcrumb-item,
            .dark-mode p,
            .dark-mode span,
            .dark-mode label,
            .dark-mode small,
            .dark-mode h1,
            .dark-mode h2,
            .dark-mode h3,
            .dark-mode h4,
            .dark-mode h5,
            .dark-mode h6,
            .dark-mode a {
                color: var(--text-light) !important;
            }

            .dark-mode .form-control::placeholder,
            .dark-mode .form-select::placeholder {
                color: rgba(248, 250, 252, 0.75) !important;
            }

            .dark-mode .text-dark,
            .dark-mode .text-black,
            .dark-mode .text-secondary,
            .dark-mode .text-muted,
            .dark-mode .small,
            .dark-mode .form-text,
            .dark-mode .fw-light,
            .dark-mode .fw-normal,
            .dark-mode .fw-semibold,
            .dark-mode .text-start,
            .dark-mode .text-end,
            .dark-mode .text-center,
            .dark-mode .dropdown-item,
            .dark-mode .dropdown-header,
            .dark-mode .modal-title,
            .dark-mode .accordion-button,
            .dark-mode .breadcrumb-item,
            .dark-mode .list-group-item {
                color: var(--text-light) !important;
            }

            .dark-mode .text-primary {
                color: #5eead4 !important;
            }

            .dark-mode .text-success {
                color: #86efac !important;
            }

            .dark-mode .text-danger {
                color: #fda4af !important;
            }

            .dark-mode .text-warning {
                color: #fde68a !important;
            }

            .dark-mode .text-info {
                color: #bfdbfe !important;
            }

            .sidebar {
                background: linear-gradient(180deg, rgba(20, 184, 166, 0.14) 0%, rgba(15, 23, 42, 0) 45%), linear-gradient(180deg, var(--sidebar-bg) 0%, #030712 100%) !important;
                box-shadow: 14px 0 35px rgba(15, 23, 42, 0.16) !important;
            }

            .navbar-top {
                background: rgba(255, 255, 255, 0.88) !important;
                color: var(--text-dark) !important;
                border-bottom: 1px solid rgba(148, 163, 184, 0.24) !important;
                backdrop-filter: blur(14px) !important;
            }

            .dark-mode .navbar-top {
                background: rgba(17, 24, 39, 0.9) !important;
                color: var(--text-light) !important;
                border-bottom-color: rgba(148, 163, 184, 0.2) !important;
            }

            .content-wrapper, .page-header, .filter-card, .card, .stat-card, .chart-card, .activity-card, .work-card, .insight-card, .table-container {
                background-color: var(--surface-color) !important;
                color: var(--text-dark) !important;
                border-color: var(--border-color) !important;
                box-shadow: 0 12px 30px var(--shadow-color) !important;
                transition: background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
            }

            .dark-mode .dashboard-header {
                background: linear-gradient(135deg, #0f172a 0%, #134e4a 55%, #0f766e 100%) !important;
                color: var(--text-light) !important;
                box-shadow: 0 16px 35px rgba(0, 0, 0, 0.35) !important;
            }

            .dashboard-header p, .dashboard-header .dashboard-copy p {
                color: rgba(255,255,255,0.8) !important;
            }

            .table {
                color: var(--text-dark) !important;
            }

            .table thead th {
                background-color: var(--soft-bg) !important;
                color: var(--text-dark) !important;
                border-color: var(--border-color) !important;
            }

            .table tbody tr:hover {
                background-color: rgba(15, 118, 110, 0.08) !important;
            }

            .form-control, .form-select, .form-check-input {
                background-color: var(--surface-color) !important;
                color: var(--text-dark) !important;
                border-color: var(--border-color) !important;
            }

            .dark-mode .form-control, .dark-mode .form-select, .dark-mode .form-check-input {
                background-color: #1f2937 !important;
                color: var(--text-light) !important;
            }

            .nav-link {
                color: rgba(248, 250, 252, 0.78) !important;
                border-radius: 8px !important;
            }

            .dark-mode .nav-link {
                color: rgba(226, 232, 240, 0.78) !important;
            }

            .nav-link:hover, .nav-link.active {
                background-color: var(--sidebar-hover) !important;
                color: #ffffff !important;
            }

            .alert {
                border: 1px solid rgba(148, 163, 184, 0.2) !important;
                box-shadow: 0 6px 20px rgba(15, 23, 42, 0.08) !important;
            }

            .alert-success {
                background: rgba(16, 185, 129, 0.14) !important;
                color: #065f46 !important;
            }

            .dark-mode .alert-success {
                color: #a7f3d0 !important;
            }

            .alert-danger {
                background: rgba(248, 113, 113, 0.16) !important;
                color: #991b1b !important;
            }

            .dark-mode .alert-danger {
                color: #fecaca !important;
            }

            .alert-info, .alert-warning {
                background: rgba(59, 130, 246, 0.12) !important;
                color: #1d4ed8 !important;
            }

            .dark-mode .alert-info, .dark-mode .alert-warning {
                color: #bfdbfe !important;
            }

            .text-muted, .muted-text, .transaction-meta, .stat-change, .note {
                color: var(--muted-color) !important;
            }

            .badge {
                box-shadow: inset 0 0 0 1px rgba(255,255,255,0.08) !important;
            }

            .dark-mode-toggle {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 999px;
                border: 1px solid rgba(148, 163, 184, 0.24);
                background: linear-gradient(135deg, rgba(15, 118, 110, 0.12), rgba(16, 185, 129, 0.14));
                color: var(--primary-color);
                cursor: pointer;
                user-select: none;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
                box-shadow: 0 6px 16px rgba(15, 23, 42, 0.08);
            }

            .dark-mode-toggle:hover {
                transform: translateY(-1px) scale(1.03);
                box-shadow: 0 10px 22px rgba(15, 23, 42, 0.16);
            }

            .dark-mode .dark-mode-toggle {
                background: linear-gradient(135deg, rgba(52, 211, 153, 0.16), rgba(16, 185, 129, 0.2));
                color: #d1fae5;
            }

            .dark-mode .transaction-item {
                background: #172033 !important;
                border-color: rgba(148, 163, 184, 0.2) !important;
            }

            .dark-mode .activity-message {
                background: rgba(15, 118, 110, 0.14) !important;
                border-color: rgba(52, 211, 153, 0.35) !important;
            }
        `;
        document.head.appendChild(style);
    }

    applyStoredTheme() {
        const savedTheme = localStorage.getItem(this.storageKey) || 'light';
        if (savedTheme === 'dark') {
            this.enableDarkMode();
        } else {
            this.disableDarkMode();
        }
    }

    setupToggleButton() {
        const buttons = document.querySelectorAll(this.toggleSelector);
        buttons.forEach(button => {
            button.addEventListener('click', () => this.toggle());
        });
    }

    toggle() {
        if (this.isDarkMode()) {
            this.disableDarkMode();
        } else {
            this.enableDarkMode();
        }
    }

    isDarkMode() {
        return document.documentElement.classList.contains(this.darkModeClass);
    }

    enableDarkMode() {
        document.documentElement.classList.add(this.darkModeClass);
        document.body.classList.add(this.darkModeClass);
        localStorage.setItem(this.storageKey, 'dark');
        this.updateToggleButton();
    }

    disableDarkMode() {
        document.documentElement.classList.remove(this.darkModeClass);
        document.body.classList.remove(this.darkModeClass);
        localStorage.setItem(this.storageKey, 'light');
        this.updateToggleButton();
    }

    updateToggleButton() {
        const buttons = document.querySelectorAll(this.toggleSelector);
        buttons.forEach(button => {
            const icon = button.querySelector('i');
            if (icon) {
                if (this.isDarkMode()) {
                    icon.className = 'bi bi-sun';
                } else {
                    icon.className = 'bi bi-moon';
                }
            }
        });
    }
}

document.addEventListener('DOMContentLoaded', function () {
    new DarkModeToggle();
});
