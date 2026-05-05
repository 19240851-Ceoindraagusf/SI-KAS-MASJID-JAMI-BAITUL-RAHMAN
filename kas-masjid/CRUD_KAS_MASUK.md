# 📋 Fitur CRUD Kas Masuk

## Deskripsi
Fitur CRUD lengkap untuk mengelola data kas masuk dengan validasi input dan relasi ke tabel kategori.

## 🎯 Fitur yang Tersedia

### 1. **Tambah Data (Create)**
- Form input dengan validasi
- Field yang diisi:
  - Tanggal (date picker)
  - Jumlah (numeric dengan 2 desimal)
  - Keterangan (textarea)
  - Kategori (dropdown dari tabel kategori)
- Validasi input:
  - Tanggal: required, format date
  - Jumlah: required, numeric, minimum 0
  - Keterangan: required, string, max 255 karakter
  - Kategori: required, exists di tabel kategori

### 2. **Tampilkan Data (Read)**
- Tabel daftar kas masuk dengan pagination (15 items per halaman)
- Kolom yang ditampilkan:
  - Tanggal (format: d/m/Y)
  - Kategori (nama kategori)
  - Keterangan
  - Jumlah (format rupiah)
  - Penginput (nama user)
  - Aksi (Edit & Delete)
- Sorting: descending berdasarkan tanggal

### 3. **Edit Data (Update)**
- Form pre-filled dengan data existing
- Validasi input sama seperti create
- Update ke database

### 4. **Hapus Data (Delete)**
- Konfirmasi sebelum menghapus
- Soft delete otomatis via cascade
- Redirect ke halaman daftar

## 📁 File Struktur

```
app/
├── Models/
│   ├── KasMasuk.php          # Model dengan relasi
│   └── Kategori.php          # Model kategori

app/Http/Controllers/
└── KasMasukController.php    # Controller CRUD

resources/views/kas_masuk/
├── index.blade.php           # Tabel daftar
├── create.blade.php          # Form tambah
└── edit.blade.php            # Form edit

database/migrations/
├── 2024_02_13_000002_create_kategoris_table.php
└── 2024_02_13_000003_create_kas_masuks_table.php
```

## 🔗 Relasi Database

### KasMasuk Model
```php
- belongsTo(Kategori)  // Relasi ke tabel kategori
- belongsTo(User)      // Relasi ke user yang input
```

### Kategori Model
```php
- hasMany(KasMasuk)   // One-to-Many dengan kas masuk
```

## 🛣️ Routes

```php
GET    /kas_masuk              # Tampilkan daftar
GET    /kas_masuk/create       # Tampilkan form tambah
POST   /kas_masuk              # Simpan data baru
GET    /kas_masuk/{id}/edit    # Tampilkan form edit
PUT    /kas_masuk/{id}         # Update data
DELETE /kas_masuk/{id}         # Hapus data
```

## ✅ Validasi Input

| Field | Validasi | Pesan Error |
|-------|----------|-------------|
| Tanggal | required, date | Field required & format date |
| Jumlah | required, numeric, min:0 | Field required, must be numeric, min 0 |
| Keterangan | required, string, max:255 | Field required, string, max 255 char |
| Kategori | required, exists:kategoris,id | Field required & must exist in kategori |

## 🎨 User Interface

- Layout: Bootstrap 5
- Responsive design
- Form validation dengan error messages
- Pagination untuk list data
- Icons dari Bootstrap Icons
- Color scheme:
  - Primary: #3498db (biru)
  - Danger: #e74c3c (merah untuk delete)
  - Warning: #f39c12 (orange untuk edit)

## 📊 Database Schema

### Tabel: kas_masuks
```sql
- id (PK)
- tanggal (DATE)
- jumlah (DECIMAL 15,2)
- keterangan (VARCHAR 255)
- kategori_id (FK → kategoris.id)
- user_id (FK → users.id)
- created_at (TIMESTAMP)
- updated_at (TIMESTAMP)
```

## 🔐 Access Control

- Middleware: `auth` (hanya user yang login)
- Role: Semua user (bisa create, read, update, delete)
- Auto capture: user_id dari session

## 📝 Contoh Penggunaan

1. **Akses halaman daftar:** `http://localhost:8000/kas_masuk`
2. **Klik "Tambah Kas Masuk"** untuk form input
3. **Isi form dan klik "Simpan"**
4. **Edit:** Klik tombol edit di tabel
5. **Hapus:** Klik tombol delete (dengan konfirmasi)

## 🚀 Status Fitur

- ✅ Model & Migration
- ✅ Controller dengan CRUD lengkap
- ✅ Views (index, create, edit)
- ✅ Validasi input
- ✅ Relasi kategori & user
- ✅ Pagination
- ✅ Error handling
- ✅ Bootstrap 5 UI

---

**Dibuat:** 05 Mei 2026  
**Versi:** 1.0 - Complete CRUD  
**Developer:** Uadz
