# 🚀 QUICK START GUIDE

Panduan cepat mulai menggunakan Sistem Informasi Kas Masjid dalam 5 menit!

---

## ⚡ 5 Menit Setup

### Langkah 1: Persiapan
```bash
cd "c:\SI KAS MASJID JAMI BAITUL RAHMAN\kas-masjid"
```

### Langkah 2: Install PHP Dependencies
```bash
composer install
php artisan key:generate
```

### Langkah 3: Buat Database
```bash
mysql -u root
CREATE DATABASE kas_masjid CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

### Langkah 4: Setup Database
```bash
php artisan migrate
php artisan db:seed
```

### Langkah 5: Jalankan Server
```bash
php artisan serve
```

🎉 **Selesai!** Buka browser ke: `http://localhost:8000`

---

## 👤 Login Akun Default

Gunakan salah satu akun ini:

### Admin Account
- **Email:** admin@masjid.com
- **Password:** password

### Bendahara Account  
- **Email:** bendahara@masjid.com
- **Password:** password

---

## 📖 Menu Utama

### 1️⃣ Dashboard
```
Klik: Dashboard di sidebar
Lihat: Total kas masuk, kas keluar, saldo akhir
```

### 2️⃣ Kas Masuk
```
Klik: Kas Masuk di sidebar
Fitur:
  - Tambah data kas masuk
  - Lihat daftar kas masuk
  - Edit data
  - Hapus data
```

### 3️⃣ Kas Keluar  
```
Klik: Kas Keluar di sidebar
Fitur:
  - Tambah data kas keluar
  - Lihat daftar kas keluar
  - Edit data
  - Hapus data
  - Set status (pending/approved/rejected)
```

---

## 🎯 Contoh Penggunaan

### Menambah Kas Masuk

```
1. Klik menu "Kas Masuk"
2. Klik tombol "+ Tambah Kas Masuk"
3. Isi form:
   - Tanggal: 13 Februari 2024
   - Kategori: Zakat Fitrah
   - Jumlah: 500000
   - Keterangan: Zakat dari Ahmad
4. Klik "Simpan"
5. Data muncul di list
6. Dashboard otomatis update
```

### Menambah Kas Keluar

```
1. Klik menu "Kas Keluar"
2. Klik tombol "+ Tambah Kas Keluar"
3. Isi form:
   - Tanggal: 14 Februari 2024
   - Kategori: Operasional
   - Jumlah: 200000
   - Keterangan: Listrik bulan Februari
   - Status: approved
4. Klik "Simpan"
5. Data muncul di list
6. Dashboard saldo otomatis update
```

---

## 🔐 Keamanan

⚠️ **PENTING: Ubah Password Segera!**

```
1. Login dengan akun default
2. Klik logout
3. Login dengan email & password baru
4. Password baru sudah terenkripsi
```

---

## 📱 Mobile Support

Sistem ini responsive untuk mobile:
- ✅ iPhone
- ✅ Android
- ✅ Tablet

Cukup buka di mobile browser: `http://localhost:8000`

---

## ❓ FAQ Cepat

### Q: Bagaimana jika lupa password?
A: Klik link "Lupa password?" di login page

### Q: Bagaimana reset database?
A: Jalankan command:
```bash
php artisan migrate:refresh --seed
```

### Q: Bagaimana lihat database langsung?
A: Gunakan phpMyAdmin atau MySQL Workbench

### Q: Bagaimana buat user baru?
A: Klik "Daftar" di login page, atau:
```bash
php artisan tinker
User::create(['name' => 'Nama', 'email' => 'email@mail.com', 'password' => Hash::make('password'), 'role' => 'bendahara'])
exit
```

### Q: Bagaimana ganti port dari 8000?
A: 
```bash
php artisan serve --port=3000
```

---

## 🐛 Troubleshooting Cepat

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Database connection failed"
- Cek username & password di .env
- Pastikan MySQL service berjalan
- Pastikan database sudah dibuat

### Error: "View not found"  
```bash
php artisan cache:clear
php artisan view:clear
```

### Error: "CSRF token mismatch"
- Clear browser cookies
- Clear browser cache
- Refresh halaman

---

## 📚 File Dokumentasi Lengkap

| File | Untuk |
|------|-------|
| SETUP.md | Instalasi detail |
| DOKUMENTASI.md | Fitur lengkap |
| STRUKTUR.md | Struktur code |
| TESTING.md | Testing guide |

---

## 🎓 Workflow Lengkap

### Skenario: Manager Kas Bulanan

```
HARI 1 - Setup Awal
├── Install sistem
├── Login dengan admin
├── Cek dashboard
└── Ubah password admin

MINGGU 1-4 - Input Data
├── Kelola Kas Masuk
│   ├── Zakat Fitrah: 5.000.000
│   ├── Sumbangan: 2.000.000
│   └── Donasi: 1.500.000
│
├── Kelola Kas Keluar
│   ├── Operasional: 1.000.000
│   ├── Gaji Imam: 3.000.000
│   └── Perbaikan: 500.000
│
└── Monitor Dashboard
    └── Total Kas Masuk: 8.500.000
        Total Kas Keluar: 4.500.000
        Saldo Akhir: 4.000.000

AKHIR BULAN - Laporan
├── Backup database
├── Export data (manual)
└── Arsip dokumen
```

---

## ✅ Checklist Siap Produksi

- [ ] Database sudah dibuat
- [ ] Semua migration berhasil
- [ ] Bisa login dengan akun default
- [ ] Bisa tambah kas masuk
- [ ] Bisa tambah kas keluar
- [ ] Dashboard menampilkan saldo benar
- [ ] Password sudah diubah
- [ ] Database sudah di-backup
- [ ] User baru sudah dibuat
- [ ] Semua menu sudah di-test

---

## 🚀 Next Steps

Setelah setup awal:

1. **Buat user baru** (Admin/Bendahara)
   - Daftar via register page
   - Ubah role di database jika perlu

2. **Input data awal**
   - Historical data dari tahun lalu
   - Current data
   - Setup kategori tambahan jika perlu

3. **Setup email** (optional)
   - Konfigurasi SMTP di .env
   - Test email notification

4. **Backup rutin**
   - Backup database mingguan
   - Simpan di lokasi aman
   - Test restore backup

5. **Maintenance**
   - Monitor logs di storage/logs/
   - Update password berkala
   - Clear old data jika diperlukan

---

## 📞 Kontak Support

Jika ada masalah:

1. **Baca FAQ** di atas
2. **Cek dokumentasi** SETUP.md atau DOKUMENTASI.md
3. **Hubungi administrator:**
   - Email: admin@masjid.com
   - WhatsApp: [nomor]
   - Datang langsung ke kantor

---

## 🎉 Selamat!

Anda sudah siap menggunakan Sistem Informasi Kas Masjid Baitul Rahman!

**Gunakan dengan baik dan bijak untuk kemajuan masjid kami.** 🕌

---

**Last Updated:** 2024-02-13  
**Version:** 1.0.0
