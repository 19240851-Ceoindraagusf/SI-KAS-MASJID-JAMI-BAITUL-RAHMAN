# 📖 Panduan Setup Lengkap - Kas Masjid Baitul Rahman

Panduan lengkap untuk setup dan menjalankan Sistem Informasi Kas Masjid Baitul Rahman.

## ✅ Checklist Prasyarat

Sebelum memulai, pastikan Anda sudah menginstal:

- [ ] PHP 8.1 atau lebih tinggi (dengan ekstensi: PDO, mbstring, BCMath)
- [ ] MySQL 5.7 atau lebih tinggi
- [ ] Composer (package manager PHP)
- [ ] Node.js dan npm
- [ ] Text Editor atau IDE (VS Code, PhpStorm, dll)

### Cara Mengecek Versi

**PHP:**
```bash
php -v
```

**MySQL:**
```bash
mysql --version
```

**Composer:**
```bash
composer --version
```

**Node.js & npm:**
```bash
node -v
npm -v
```

## 🚀 Langkah-Langkah Instalasi

### 1. Buka Command Prompt / PowerShell

Untuk Windows:
- Tekan `Win + R`
- Ketik `cmd` atau `powershell`
- Tekan Enter

### 2. Navigasi ke Folder Project

```bash
cd "c:\SI KAS MASJID JAMI BAITUL RAHMAN\kas-masjid"
```

### 3. Install Composer Dependencies

```bash
composer install
```

> Tunggu sampai selesai (bisa memakan waktu beberapa menit)

### 4. Generate Application Key

```bash
php artisan key:generate
```

Output yang diharapkan:
```
Application key set successfully.
```

### 5. Install NPM Dependencies

```bash
npm install
```

### 6. Buat Database Baru

Buka MySQL Client atau Tools seperti phpMyAdmin:

```sql
CREATE DATABASE kas_masjid CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Atau jika menggunakan command line:
```bash
mysql -u root -p
```

Lalu ketik:
```sql
CREATE DATABASE kas_masjid CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### 7. Konfigurasi File .env

Buka file `.env` di folder project dengan text editor.

Cari dan sesuaikan bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=kas_masjid
DB_USERNAME=root
DB_PASSWORD=
```

**Penjelasan:**
- `DB_CONNECTION`: Jenis database (mysql)
- `DB_HOST`: Host database (localhost)
- `DB_PORT`: Port MySQL (3306 adalah default)
- `DB_DATABASE`: Nama database yang dibuat tadi
- `DB_USERNAME`: Username MySQL (biasanya root)
- `DB_PASSWORD`: Password MySQL (kosong jika tidak ada password)

### 8. Jalankan Database Migrations

```bash
php artisan migrate
```

Ini akan membuat semua tabel di database.

Output yang diharapkan:
```
Migration table created successfully.
Migrating: 2014_10_12_000000_create_users_table
Migrated: 2014_10_12_000000_create_users_table
...
```

### 9. Jalankan Database Seeder (Opsional tapi Direkomendasikan)

```bash
php artisan db:seed
```

Ini akan membuat user default dan kategori contoh.

### 10. Jalankan Development Server

**Terminal 1 - Laravel Server:**
```bash
php artisan serve
```

Server akan berjalan di: `http://localhost:8000`

**Terminal 2 - Build Assets (di terminal baru):**
```bash
npm run dev
```

## 🎯 Akses Aplikasi

### Login

1. Buka browser dan akses: **http://localhost:8000**
2. Anda akan diarahkan ke halaman login
3. Gunakan salah satu akun default:

**Akun Admin:**
- Email: `admin@masjid.com`
- Password: `password`

**Akun Bendahara:**
- Email: `bendahara@masjid.com`
- Password: `password`

### Langkah Pertama Setelah Login

1. **Ubah Password**
   - Klik profile (nama di navbar)
   - Ubah password default segera
   
2. **Explore Dashboard**
   - Lihat ringkasan kas masuk, kas keluar, dan saldo

3. **Buat Data Kas Masuk**
   - Klik menu "Kas Masuk"
   - Klik "Tambah Kas Masuk"
   - Isi form dan submit

4. **Buat Data Kas Keluar**
   - Klik menu "Kas Keluar"
   - Klik "Tambah Kas Keluar"
   - Isi form dan submit

## ⚠️ Troubleshooting

### Problem: "Access denied for user 'root'@'localhost'"

**Solusi:**
- Periksa password MySQL di .env
- Pastikan MySQL service berjalan
- Verifikasi database sudah dibuat

### Problem: "SQLSTATE[HY000]: General error: 1030"

**Solusi:**
```bash
php artisan migrate:refresh
php artisan db:seed
```

### Problem: "Class not found"

**Solusi:**
```bash
composer dump-autoload
```

### Problem: "npm: command not found"

**Solusi:**
- Install Node.js dari https://nodejs.org/
- Restart command prompt

### Problem: "mysql: command not found"

**Solusi:**
- Pastikan MySQL sudah diinstall
- Tambahkan MySQL bin folder ke PATH environment variable

### Problem: Assets (CSS/JS) tidak loading

**Solusi:**
```bash
npm install
npm run dev
```

## 📝 Command-Command Penting

### Jalankan Development Server
```bash
php artisan serve
```

### Rebuild Assets
```bash
npm run dev
```

### Production Build
```bash
npm run build
```

### Reset Database
```bash
php artisan migrate:refresh
```

### Reset Database + Seed
```bash
php artisan migrate:refresh --seed
```

### Tambah User Baru
```bash
php artisan tinker
User::create(['name' => 'John', 'email' => 'john@mail.com', 'password' => Hash::make('password'), 'role' => 'bendahara'])
exit
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📚 Struktur Folder Penting

```
kas-masjid/
├── app/
│   ├── Http/
│   │   ├── Controllers/      ← Logika bisnis
│   │   └── Requests/         ← Validasi form
│   └── Models/               ← Database models
├── database/
│   ├── migrations/           ← Struktur database
│   └── seeders/              ← Data default
├── resources/
│   ├── views/                ← Tampilan (Blade)
│   └── css/                  ← CSS files
├── routes/
│   ├── web.php               ← Web routes
│   └── auth.php              ← Auth routes
├── storage/                  ← File uploads
├── .env                      ← Konfigurasi
└── composer.json             ← PHP dependencies
```

## 🔒 Keamanan

### Password Best Practices
1. Gunakan password yang kuat (min 8 karakter, campuran huruf & angka)
2. Ubah password default segera setelah instalasi
3. Jangan bagikan password dengan siapapun

### Database Backup
Backup database secara berkala:

```bash
mysqldump -u root kas_masjid > backup_kas_masjid.sql
```

Restore database dari backup:

```bash
mysql -u root kas_masjid < backup_kas_masjid.sql
```

## 📞 Support & Bantuan

Jika mengalami masalah:

1. Periksa error message di terminal
2. Baca dokumentasi di folder project
3. Cek di Laravel documentation: https://laravel.com/docs

## 🎓 Tips & Trik

### Development Server tidak berjalan?
Pastikan port 8000 tidak digunakan:
```bash
php artisan serve --port=8001
```

### Ingin menggunakan port berbeda?
```bash
php artisan serve --host=0.0.0.0 --port=3000
```

### Database sudah ada tapi migration gagal?
```bash
php artisan migrate --force
```

### Lihat query SQL yang dijalankan
Edit file `.env`:
```env
DB_QUERY_LOG=true
```

## ✅ Verifikasi Instalasi

Setelah semua selesai, check:

- [ ] Database sudah dibuat
- [ ] Migration berhasil
- [ ] Server berjalan di port 8000
- [ ] Bisa login dengan akun default
- [ ] Dashboard menampilkan data
- [ ] Bisa tambah/edit data kas masuk
- [ ] Bisa tambah/edit data kas keluar

---

**Selamat! Instalasi berhasil dilakukan.** 🎉

Untuk pertanyaan lebih lanjut, silakan hubungi administrator sistem.
