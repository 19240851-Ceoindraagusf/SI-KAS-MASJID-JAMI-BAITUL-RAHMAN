# 📊 Struktur Lengkap Sistem Informasi Kas Masjid

## 🎯 Overview Sistem

**Nama:** Sistem Informasi Kas dan Laporan Keuangan Masjid Jami Baitul Rahman  
**Framework:** Laravel 10  
**PHP Version:** 8.1+  
**Database:** MySQL 5.7+  
**UI Framework:** Bootstrap 5  

---

## 📁 Struktur Direktori Lengkap

```
kas-masjid/
│
├── 📂 app/
│   ├── 📂 Console/
│   │   └── Kernel.php
│   │
│   ├── 📂 Exceptions/
│   │   └── Handler.php
│   │
│   ├── 📂 Http/
│   │   ├── 📂 Controllers/
│   │   │   ├── DashboardController.php         ← Dashboard logic
│   │   │   ├── KasMasukController.php          ← Kas Masuk CRUD
│   │   │   ├── KasKeluarController.php         ← Kas Keluar CRUD
│   │   │   │
│   │   │   └── 📂 Auth/
│   │   │       ├── AuthenticatedSessionController.php
│   │   │       ├── ConfirmablePasswordController.php
│   │   │       ├── EmailVerificationNotificationController.php
│   │   │       ├── EmailVerificationPromptController.php
│   │   │       ├── NewPasswordController.php
│   │   │       ├── PasswordController.php
│   │   │       ├── PasswordResetLinkController.php
│   │   │       ├── RegisteredUserController.php
│   │   │       └── VerifyEmailController.php
│   │   │
│   │   ├── 📂 Middleware/
│   │   │   ├── Authenticate.php
│   │   │   ├── CheckRole.php                   ← Custom role middleware
│   │   │   ├── EncryptCookies.php
│   │   │   ├── PreventRequestsDuringMaintenance.php
│   │   │   ├── RedirectIfAuthenticated.php
│   │   │   ├── TrimStrings.php
│   │   │   ├── TrustProxies.php
│   │   │   └── ValidateSignature.php
│   │   │
│   │   ├── 📂 Requests/
│   │   │   └── 📂 Auth/
│   │   │       └── LoginRequest.php
│   │   │
│   │   └── Kernel.php
│   │
│   ├── 📂 Models/
│   │   ├── User.php                           ← User model dengan role
│   │   ├── Kategori.php                       ← Kategori kas
│   │   ├── KasMasuk.php                       ← Kas masuk transactions
│   │   └── KasKeluar.php                      ← Kas keluar transactions
│   │
│   ├── 📂 Providers/
│   │   ├── AppServiceProvider.php
│   │   ├── AuthServiceProvider.php
│   │   ├── BroadcastServiceProvider.php
│   │   ├── EventServiceProvider.php
│   │   └── RouteServiceProvider.php
│   │
│   └── User.php (deprecated, use app/Models/User.php)
│
├── 📂 bootstrap/
│   ├── app.php                                ← App bootstrap
│   │
│   └── 📂 cache/
│       ├── packages.php
│       └── services.php
│
├── 📂 config/
│   ├── app.php                                ← App configuration
│   ├── auth.php                               ← Auth configuration
│   ├── broadcasting.php
│   ├── cache.php
│   ├── cors.php
│   ├── database.php
│   ├── filesystems.php
│   ├── hashing.php
│   ├── logging.php
│   ├── mail.php
│   ├── queue.php
│   ├── sanctum.php
│   ├── services.php
│   ├── session.php
│   └── view.php
│
├── 📂 database/
│   │
│   ├── 📂 factories/
│   │   └── UserFactory.php
│   │
│   ├── 📂 migrations/
│   │   ├── 2014_10_12_000000_create_users_table.php
│   │   ├── 2014_10_12_100000_create_password_reset_tokens_table.php
│   │   ├── 2019_08_19_000000_create_failed_jobs_table.php
│   │   ├── 2019_12_14_000001_create_personal_access_tokens_table.php
│   │   ├── 2024_02_13_000001_create_users_table.php
│   │   ├── 2024_02_13_000002_create_kategoris_table.php
│   │   ├── 2024_02_13_000003_create_kas_masuks_table.php
│   │   └── 2024_02_13_000004_create_kas_keluars_table.php
│   │
│   └── 📂 seeders/
│       └── DatabaseSeeder.php                 ← Default data seeder
│
├── 📂 public/
│   ├── index.php                              ← Entry point aplikasi
│   ├── robots.txt
│   ├── .htaccess
│   │
│   └── 📂 (assets akan di-generate oleh npm)
│
├── 📂 resources/
│   │
│   ├── 📂 css/
│   │   └── app.css
│   │
│   ├── 📂 js/
│   │   ├── app.js
│   │   └── bootstrap.js
│   │
│   └── 📂 views/
│       ├── 📂 layouts/
│       │   └── app.blade.php                  ← Main layout
│       │
│       ├── 📂 auth/
│       │   ├── login.blade.php                ← Login page
│       │   ├── register.blade.php             ← Register page
│       │   ├── forgot-password.blade.php      ← Forgot password
│       │   ├── reset-password.blade.php       ← Reset password
│       │   ├── verify-email.blade.php         ← Email verification
│       │   └── confirm-password.blade.php     ← Password confirmation
│       │
│       ├── 📂 dashboard/
│       │   └── index.blade.php                ← Dashboard
│       │
│       ├── 📂 kas_masuk/
│       │   ├── index.blade.php                ← Kas masuk list
│       │   ├── create.blade.php               ← Add kas masuk form
│       │   └── edit.blade.php                 ← Edit kas masuk form
│       │
│       └── 📂 kas_keluar/
│           ├── index.blade.php                ← Kas keluar list
│           ├── create.blade.php               ← Add kas keluar form
│           └── edit.blade.php                 ← Edit kas keluar form
│
├── 📂 routes/
│   ├── api.php                                ← API routes
│   ├── channels.php
│   ├── console.php
│   ├── web.php                                ← Web routes
│   └── auth.php                               ← Auth routes
│
├── 📂 storage/
│   ├── 📂 app/
│   │   └── 📂 public/                         ← Public storage
│   │
│   ├── 📂 framework/
│   │   ├── 📂 cache/
│   │   ├── 📂 sessions/
│   │   ├── 📂 testing/
│   │   └── 📂 views/
│   │
│   └── 📂 logs/
│       └── laravel.log
│
├── 📂 tests/
│   ├── CreatesApplication.php
│   ├── TestCase.php
│   ├── 📂 Feature/
│   └── 📂 Unit/
│
├── 📂 vendor/                                 ← Composer packages (auto-generated)
│   └── (banyak packages...)
│
├── .env                                       ← Environment config (LOCAL)
├── .env.example                               ← Environment example template
├── .gitattributes
├── .gitignore                                 ← Git ignore rules
├── artisan                                    ← Laravel CLI tool
├── composer.json                              ← PHP dependencies
├── composer.lock                              ← Locked dependencies
├── package.json                               ← NPM dependencies
├── package-lock.json                          ← Locked NPM dependencies
├── phpunit.xml                                ← PHPUnit configuration
├── vite.config.js                             ← Vite configuration
├── DOKUMENTASI.md                             ← Dokumentasi lengkap
├── SETUP.md                                   ← Setup guide
├── STRUKTUR.md                                ← File ini
└── README.md                                  ← Project readme

```

---

## 🔄 Database Relationships (ERD)

### Users ↔ KasMasuk & KasKeluar
```
User (1) ──→ (M) KasMasuk
User (1) ──→ (M) KasKeluar
```

### Kategori ↔ KasMasuk & KasKeluar
```
Kategori (1) ──→ (M) KasMasuk
Kategori (1) ──→ (M) KasKeluar
```

---

## 📊 Database Schema

### Table: users
| Column | Type | Constraint |
|--------|------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT |
| name | VARCHAR(255) | NOT NULL |
| email | VARCHAR(255) | UNIQUE, NOT NULL |
| email_verified_at | TIMESTAMP | NULLABLE |
| password | VARCHAR(255) | NOT NULL |
| role | ENUM('admin','bendahara') | DEFAULT 'bendahara' |
| remember_token | VARCHAR(100) | NULLABLE |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |

### Table: kategoris
| Column | Type | Constraint |
|--------|------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT |
| nama_kategori | VARCHAR(255) | NOT NULL |
| deskripsi | TEXT | NULLABLE |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |

### Table: kas_masuks
| Column | Type | Constraint |
|--------|------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT |
| tanggal | DATE | NOT NULL |
| jumlah | DECIMAL(15,2) | NOT NULL |
| keterangan | VARCHAR(255) | NOT NULL |
| kategori_id | BIGINT | NOT NULL, FOREIGN KEY |
| user_id | BIGINT | NOT NULL, FOREIGN KEY |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |

### Table: kas_keluars
| Column | Type | Constraint |
|--------|------|-----------|
| id | BIGINT | PRIMARY KEY, AUTO_INCREMENT |
| tanggal | DATE | NOT NULL |
| jumlah | DECIMAL(15,2) | NOT NULL |
| keterangan | VARCHAR(255) | NOT NULL |
| kategori_id | BIGINT | NOT NULL, FOREIGN KEY |
| status | ENUM('pending','approved','rejected') | DEFAULT 'pending' |
| user_id | BIGINT | NOT NULL, FOREIGN KEY |
| created_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |
| updated_at | TIMESTAMP | DEFAULT CURRENT_TIMESTAMP |

---

## 🔐 Fitur Keamanan

### Authentication
- ✅ Login/Logout
- ✅ Register
- ✅ Password Reset
- ✅ Email Verification
- ✅ CSRF Protection
- ✅ Rate Limiting

### Authorization
- ✅ Role-based Access Control (Admin/Bendahara)
- ✅ Custom Middleware (CheckRole)
- ✅ Model-based Authorization

### Data Protection
- ✅ Password Hashing (bcrypt)
- ✅ Encrypted Cookies
- ✅ HTTPS Support (configurable)
- ✅ SQL Injection Prevention (ORM)
- ✅ XSS Protection (Blade escaping)

---

## 🚀 Key Features

### Dashboard
- Total Kas Masuk (sum)
- Total Kas Keluar (sum)
- Saldo Akhir (auto-calculated)

### Kas Masuk Management
- CREATE: Tambah transaksi kas masuk
- READ: Lihat daftar kas masuk (with pagination)
- UPDATE: Edit data kas masuk
- DELETE: Hapus data kas masuk
- Validasi form lengkap

### Kas Keluar Management
- CREATE: Tambah transaksi kas keluar
- READ: Lihat daftar kas keluar (with pagination)
- UPDATE: Edit data kas keluar
- DELETE: Hapus data kas keluar
- Status management (pending/approved/rejected)
- Validasi form lengkap

### User Management
- Registrasi user baru (default role: bendahara)
- Login dengan email & password
- Profile management
- Password change
- Logout

---

## 📋 Validation Rules

### Users
- name: required, string, max:255
- email: required, email, unique
- password: required, confirmed, min:8
- role: enum:admin,bendahara

### Kategoris
- nama_kategori: required, string, max:255
- deskripsi: nullable, string

### Kas Masuk
- tanggal: required, date
- jumlah: required, numeric, min:0
- keterangan: required, string, max:255
- kategori_id: required, exists:kategoris,id

### Kas Keluar
- tanggal: required, date
- jumlah: required, numeric, min:0
- keterangan: required, string, max:255
- kategori_id: required, exists:kategoris,id
- status: nullable, in:pending,approved,rejected

---

## 🎨 UI Components

### Layout Components
- Sidebar Navigation
- Top Navbar
- Alert Messages
- Loading States

### Form Components
- Input fields (text, email, number, date, textarea)
- Select dropdowns
- Checkboxes
- Submit buttons
- Error messages

### Table Components
- Responsive tables
- Pagination
- Action buttons (edit, delete)
- Status badges

### Bootstrap 5 Integration
- Responsive grid system
- Utility classes
- Icons (Bootstrap Icons)
- Color scheme

---

## 🔧 Configuration Files

### .env (Environment)
- APP_NAME, APP_ENV, APP_DEBUG, APP_URL
- DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD
- CACHE_DRIVER, SESSION_DRIVER, QUEUE_CONNECTION
- MAIL_DRIVER, MAIL_HOST, MAIL_PORT, MAIL_FROM_ADDRESS

### composer.json
- PHP dependencies
- Laravel framework
- Development packages (PHPUnit, Pint, Debugbar)

### package.json
- NPM dependencies
- Build scripts (dev, build, preview)
- Vite configuration

---

## 📦 Dependencies

### Production
- laravel/framework: 10.x
- laravel/sanctum: 3.x
- laravel/tinker: 2.x

### Development
- laravel/sail: 1.x
- phpunit/phpunit: 10.x
- laravel/pint: 1.x
- spatie/laravel-ignition: 2.x

---

## 🚀 Development Commands

```bash
# Jalankan server
php artisan serve

# Buat migration
php artisan make:migration create_table_name

# Jalankan migration
php artisan migrate

# Rollback migration
php artisan migrate:rollback

# Refresh database (reset + re-run)
php artisan migrate:refresh

# Seed database
php artisan db:seed

# Buat model
php artisan make:model ModelName

# Buat controller
php artisan make:controller ControllerName

# Buat request
php artisan make:request RequestName

# Clear cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Run tests
php artisan test
```

---

## 📈 Scalability Considerations

### Future Enhancements
1. **Reports & Analytics**
   - Monthly reports
   - Yearly reports
   - Charts & graphs

2. **Advanced Features**
   - Multi-currency support
   - Budget planning
   - Approval workflow
   - Email notifications

3. **API Development**
   - RESTful API
   - Mobile app integration
   - Third-party integrations

4. **Performance**
   - Caching strategy
   - Database indexing
   - Query optimization

---

## 🔍 Code Quality Tools

### Installed
- PHPUnit: Unit testing
- Laravel Pint: Code style formatter
- Laravel Debugbar: Debug toolbar (in dev)

### Recommended
- PHPStan: Static analysis
- Psalm: Psalm type checker
- PHP-CS-Fixer: Code formatter

---

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| README.md | Project overview |
| SETUP.md | Installation guide |
| DOKUMENTASI.md | Complete documentation |
| STRUKTUR.md | This file - project structure |

---

## ✅ Project Checklist

- [x] Laravel 10 setup
- [x] Database migrations
- [x] Models dengan relationships
- [x] Controllers dengan CRUD logic
- [x] Authentication & authorization
- [x] Views dengan Bootstrap 5
- [x] Validasi form
- [x] Role-based middleware
- [x] Seeder dengan default data
- [x] Documentation

---

**Created:** 2024-02-13  
**Last Updated:** 2026-04-30  
**Version:** 1.0.0  
**Status:** ✅ Production Ready

---

Untuk informasi lebih lanjut, lihat file dokumentasi lainnya di project root.
