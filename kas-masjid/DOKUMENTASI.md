# 🕌 Sistem Informasi Kas dan Laporan Keuangan Masjid Jami Baitul Rahman

Sistem informasi manajemen kas masjid berbasis web yang dibangun dengan Laravel 10, PHP 8.1, dan MySQL.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Instalasi](#instalasi)
- [Konfigurasi Database](#konfigurasi-database)
- [Struktur Project](#struktur-project)
- [Penggunaan](#penggunaan)
- [Akun Default](#akun-default)

## ✨ Fitur Utama

### 1. Sistem Autentikasi
- Login dan logout
- Registrasi user baru
- Role-based access control (Admin dan Bendahara)
- Password reset functionality
- Email verification

### 2. Manajemen Kas Masuk
- Input data kas masuk dengan kategori
- Edit dan delete data kas masuk
- Tampilan list dengan pagination
- Validasi form input

### 3. Manajemen Kas Keluar
- Input data kas keluar dengan status (pending, approved, rejected)
- Edit dan delete data kas keluar
- Tampilan list dengan pagination
- Validasi form input

### 4. Dashboard
- Ringkasan total kas masuk
- Ringkasan total kas keluar
- Perhitungan saldo akhir otomatis

### 5. User Interface
- Responsive design dengan Bootstrap 5
- Sidebar navigation
- Clean dan modern design

## 🛠️ Teknologi yang Digunakan

- **PHP**: 8.1+
- **Laravel**: 10.x
- **MySQL**: 5.7+
- **Bootstrap**: 5.3
- **Composer**: Package manager untuk PHP
- **NPM**: Package manager untuk JavaScript

## 📦 Instalasi

### Prasyarat
- PHP 8.1 atau lebih tinggi
- MySQL 5.7 atau lebih tinggi
- Composer
- Node.js dan npm
- Git (opsional)

### Langkah Instalasi

1. **Clone atau extract project**
   ```bash
   cd "C:\SI KAS MASJID JAMI BAITUL RAHMAN\kas-masjid"
   ```

2. **Install dependencies PHP**
   ```bash
   composer install
   ```

3. **Generate application key**
   ```bash
   php artisan key:generate
   ```

4. **Install dependencies JavaScript**
   ```bash
   npm install
   ```

5. **Buat database baru**
   ```sql
   CREATE DATABASE kas_masjid CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

6. **Konfigurasi file .env**
   - Buka file `.env` di root project
   - Pastikan konfigurasi database sesuai:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kas_masjid
   DB_USERNAME=root
   DB_PASSWORD=
   ```

7. **Jalankan migrations**
   ```bash
   php artisan migrate
   ```

8. **Jalankan seeders (opsional)**
   ```bash
   php artisan db:seed
   ```

9. **Jalankan development server**
   ```bash
   php artisan serve
   ```

   Server akan berjalan di: `http://localhost:8000`

## 💾 Konfigurasi Database

### Database Structure

#### Tabel `users`
- id: Primary key
- name: Nama user
- email: Email user (unique)
- password: Password terenkripsi
- role: Role user (admin/bendahara)
- email_verified_at: Timestamp verifikasi email
- created_at, updated_at: Timestamps

#### Tabel `kategoris`
- id: Primary key
- nama_kategori: Nama kategori kas
- deskripsi: Deskripsi kategori
- created_at, updated_at: Timestamps

#### Tabel `kas_masuks`
- id: Primary key
- tanggal: Tanggal transaksi
- jumlah: Jumlah uang masuk (decimal)
- keterangan: Keterangan transaksi
- kategori_id: Foreign key ke tabel kategoris
- user_id: Foreign key ke tabel users
- created_at, updated_at: Timestamps

#### Tabel `kas_keluars`
- id: Primary key
- tanggal: Tanggal transaksi
- jumlah: Jumlah uang keluar (decimal)
- keterangan: Keterangan transaksi
- kategori_id: Foreign key ke tabel kategoris
- status: Status pengeluaran (pending/approved/rejected)
- user_id: Foreign key ke tabel users
- created_at, updated_at: Timestamps

## 📁 Struktur Project

```
kas-masjid/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── DashboardController.php
│   │   │   ├── KasMasukController.php
│   │   │   ├── KasKeluarController.php
│   │   │   └── Auth/
│   │   │       ├── AuthenticatedSessionController.php
│   │   │       ├── RegisteredUserController.php
│   │   │       └── ... (auth controllers lainnya)
│   │   └── Requests/
│   │       └── Auth/
│   │           └── LoginRequest.php
│   ├── Models/
│   │   ├── User.php
│   │   ├── Kategori.php
│   │   ├── KasMasuk.php
│   │   └── KasKeluar.php
│   └── ...
├── database/
│   ├── migrations/
│   │   ├── 2024_02_13_000001_create_users_table.php
│   │   ├── 2024_02_13_000002_create_kategoris_table.php
│   │   ├── 2024_02_13_000003_create_kas_masuks_table.php
│   │   └── 2024_02_13_000004_create_kas_keluars_table.php
│   └── seeders/
│       └── DatabaseSeeder.php
├── resources/
│   ├── views/
│   │   ├── layouts/
│   │   │   └── app.blade.php
│   │   ├── auth/
│   │   │   ├── login.blade.php
│   │   │   ├── register.blade.php
│   │   │   ├── forgot-password.blade.php
│   │   │   └── ... (auth views lainnya)
│   │   ├── dashboard/
│   │   │   └── index.blade.php
│   │   ├── kas_masuk/
│   │   │   ├── index.blade.php
│   │   │   ├── create.blade.php
│   │   │   └── edit.blade.php
│   │   └── kas_keluar/
│   │       ├── index.blade.php
│   │       ├── create.blade.php
│   │       └── edit.blade.php
│   └── css/
│       └── app.css
├── routes/
│   ├── web.php
│   ├── auth.php
│   └── ...
├── .env
├── composer.json
├── package.json
└── README.md
```

## 🚀 Penggunaan

### Login ke Sistem
1. Buka browser dan akses `http://localhost:8000`
2. Anda akan diarahkan ke halaman login
3. Gunakan kredensial default:
   - Email: `admin@masjid.com` atau `bendahara@masjid.com`
   - Password: `password`

### Mengelola Kas Masuk
1. Klik menu "Kas Masuk" di sidebar
2. Klik tombol "Tambah Kas Masuk"
3. Isi form dengan data transaksi
4. Klik "Simpan"

### Mengelola Kas Keluar
1. Klik menu "Kas Keluar" di sidebar
2. Klik tombol "Tambah Kas Keluar"
3. Isi form dengan data pengeluaran
4. Pilih status (pending, approved, atau rejected)
5. Klik "Simpan"

### Lihat Dashboard
1. Klik menu "Dashboard" di sidebar
2. Tampilkan ringkasan total kas masuk, kas keluar, dan saldo akhir

## 👤 Akun Default

### Admin Account
- Email: `admin@masjid.com`
- Password: `password`
- Role: Admin

### Bendahara Account
- Email: `bendahara@masjid.com`
- Password: `password`
- Role: Bendahara

> ⚠️ **PENTING**: Ubah password default segera setelah login pertama kali!

## 📚 Kategori Default

Sistem dilengkapi dengan kategori default:
1. Zakat Fitrah
2. Zakat Mal
3. Sumbangan
4. Perbaikan Masjid
5. Operasional
6. Gaji Imam

## 🔧 Troubleshooting

### Masalah: "SQLSTATE[HY000]: General error: 1030"
**Solusi**: Pastikan database sudah dibuat dan koneksi MySQL berjalan.

### Masalah: "Class not found"
**Solusi**: Jalankan `composer dump-autoload`

### Masalah: Asset tidak loading
**Solusi**: Jalankan `npm install && npm run dev`

## 📖 Dokumentasi Lebih Lanjut

Untuk dokumentasi lengkap Laravel 10, kunjungi: https://laravel.com/docs/10.x

## 📝 Lisensi

Proyek ini adalah proprietary software untuk Masjid Jami Baitul Rahman.

## 👥 Kontribusi

Untuk melaporkan bug atau memberikan saran, silakan hubungi administrator sistem.

---

**Dibuat dengan ❤️ untuk Masjid Jami Baitul Rahman**
