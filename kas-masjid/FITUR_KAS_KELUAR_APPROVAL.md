# Dokumentasi Fitur Kas Keluar dengan Workflow Approval

## Ringkasan Fitur

Fitur kas keluar telah ditingkatkan dengan workflow approval berbasis role, memungkinkan proses persetujuan data pengeluaran sebelum difinalisasi.

---

## Struktur Workflow

```
BENDAHARA                    ADMIN
    |                         |
    +-- Input Data       <----+-- Review & Approval
    |   (Status: Pending)     |
    |                         +-- Approve/Reject
    +-- Edit/Hapus            |   (Status: Approved/Rejected)
        (Jika Pending)        +-- View Report
```

---

## Komponen yang Diupdate

### 1. **Database Schema (Sudah Ada)**
Tabel `kas_keluars` memiliki struktur:
- `id` - Primary Key
- `tanggal` - Tanggal pengeluaran
- `jumlah` - Jumlah pengeluaran (decimal 15,2)
- `keterangan` - Deskripsi pengeluaran
- `kategori_id` - Foreign Key ke tabel kategoris
- `user_id` - Foreign Key ke tabel users (pembuat data)
- `status` - Enum (pending, approved, rejected) - Default: pending
- `timestamps` - created_at, updated_at

---

## 2. Model - KasKeluar
File: `app/Models/KasKeluar.php`

**Relasi:**
- `belongsTo(Kategori)` - Kategori pengeluaran
- `belongsTo(User)` - User pembuat data
- `fillable` - [tanggal, jumlah, keterangan, kategori_id, status, user_id]

---

## 3. Form Requests (Validasi)

### StoreKasKeluarRequest
**File:** `app/Http/Requests/StoreKasKeluarRequest.php`

**Aturan Validasi:**
- `tanggal` - Required, date format Y-m-d
- `jumlah` - Required, numeric, min 0.01, max 999999999.99
- `keterangan` - Required, string, 3-255 karakter
- `kategori_id` - Required, exists in kategoris table

**Otorisasi:**
- Hanya bendahara dan admin yang bisa create

### UpdateKasKeluarRequest
**File:** `app/Http/Requests/UpdateKasKeluarRequest.php`

**Aturan Validasi:** Sama dengan Store Request

**Otorisasi:**
- Admin: Bisa update semua data
- Bendahara: Hanya data pending miliknya sendiri

---

## 4. Controller - KasKeluarController
**File:** `app/Http/Controllers/KasKeluarController.php`

### Methods:

#### `index()`
- Menampilkan daftar kas keluar
- Bendahara: Hanya melihat data miliknya sendiri
- Admin: Melihat semua data
- Sorting: By tanggal descending, paginate 15 items

#### `create()`
- Menampilkan form input kas keluar
- Akses: Bendahara & Admin

#### `store(StoreKasKeluarRequest $request)`
- Menyimpan data kas keluar baru
- Status otomatis = "pending"
- user_id = auth()->id()
- Validasi: Via StoreKasKeluarRequest
- Return: Redirect ke index dengan success message

#### `edit(KasKeluar $kasKeluar)`
- Menampilkan form edit
- Akses Bendahara:
  - Hanya edit data miliknya sendiri
  - Hanya jika status = pending
- Akses Admin: Semua data
- Return: abort(403) jika tidak authorized

#### `update(UpdateKasKeluarRequest $request, KasKeluar $kasKeluar)`
- Update data kas keluar
- Validasi: Via UpdateKasKeluarRequest
- Otorisasi: Cek via request class
- Return: Redirect ke index

#### `destroy(KasKeluar $kasKeluar)`
- Hapus data kas keluar
- Akses Bendahara: Hanya data pending miliknya
- Akses Admin: Semua data
- Return: abort(403) jika tidak authorized

#### `approve(KasKeluar $kasKeluar)`
- Approve kas keluar (ADMIN ONLY)
- Hanya untuk status = pending
- Update status → "approved"
- Routes: `POST /kas_keluar/{id}/approve`
- Middleware: `role:admin`

#### `reject(Request $request, KasKeluar $kasKeluar)`
- Reject kas keluar (ADMIN ONLY)
- Hanya untuk status = pending
- Update status → "rejected"
- Routes: `POST /kas_keluar/{id}/reject`
- Middleware: `role:admin`

---

## 5. Routes
**File:** `routes/web.php`

```php
Route::middleware(['auth'])->group(function () {
    Route::resource('kas_keluar', KasKeluarController::class)->except(['show']);

    // Approval routes - Admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::post('kas_keluar/{kas_keluar}/approve', 
            [KasKeluarController::class, 'approve'])->name('kas_keluar.approve');
        Route::post('kas_keluar/{kas_keluar}/reject', 
            [KasKeluarController::class, 'reject'])->name('kas_keluar.reject');
    });
});
```

**Available Routes:**
- `GET  /kas_keluar` - Show list (index)
- `GET  /kas_keluar/create` - Create form
- `POST /kas_keluar` - Store new
- `GET  /kas_keluar/{id}/edit` - Edit form
- `PUT  /kas_keluar/{id}` - Update
- `DELETE /kas_keluar/{id}` - Delete
- `POST /kas_keluar/{id}/approve` - Approve (Admin)
- `POST /kas_keluar/{id}/reject` - Reject (Admin)

---

## 6. Middleware - CheckRole
**File:** `app/Http/Middleware/CheckRole.php`

```php
// Usage in routes:
Route::middleware(['role:admin'])->group(function () {
    // Admin only routes
});

Route::middleware(['role:bendahara'])->group(function () {
    // Bendahara only routes
});

Route::middleware(['role:admin,bendahara'])->group(function () {
    // Admin or Bendahara routes
});
```

---

## 7. Views

### index.blade.php
**File:** `resources/views/kas_keluar/index.blade.php`

**Features:**
- Tampilkan tabel dengan kolom: Tanggal, Kategori, Keterangan, Jumlah, Status, Penginput, Aksi
- Status Badge:
  - Pending: Badge kuning dengan icon clock
  - Approved: Badge hijau dengan icon check
  - Rejected: Badge merah dengan icon X
- Action Buttons (conditional):
  - Edit: Bendahara (data pending miliknya), Admin (semua)
  - Delete: Bendahara (data pending miliknya), Admin (semua)
  - Approve: Admin (data pending only)
  - Reject: Admin (data pending only)
- Button Group untuk tampilan rapi
- Pagination: 15 items per page

### create.blade.php
**File:** `resources/views/kas_keluar/create.blade.php`

**Features:**
- Form fields: tanggal, jumlah, kategori_id, keterangan
- Tidak ada field status (otomatis pending)
- Input validation error display
- Rupiah format untuk jumlah (prefix Rp)
- Alert info: "Data akan otomatis berstatus Pending menunggu approval dari admin"
- Cancel & Submit buttons

### edit.blade.php
**File:** `resources/views/kas_keluar/edit.blade.php`

**Features:**
- Form fields: tanggal, jumlah, kategori_id, keterangan
- Tidak ada field status untuk bendahara
- Status badge di header
- Alert info untuk non-admin: "Anda hanya dapat mengedit data yang masih berstatus Pending"
- Input validation error display
- Rupiah format untuk jumlah (prefix Rp)
- Cancel & Update buttons

---

## Alur Kerja (Workflow)

### 1. INPUT DATA (Bendahara)
```
Bendahara login → Dashboard → Kas Keluar → Tambah Kas Keluar
  ↓
  Input: tanggal, jumlah, kategori, keterangan
  ↓
  Status otomatis: PENDING
  ↓
  Data tersimpan & menunggu approval
```

### 2. REVIEW & APPROVAL (Admin)
```
Admin login → Dashboard → Kas Keluar → View List
  ↓
  Lihat data dengan status PENDING
  ↓
  Approve: Update status → APPROVED
  Atau
  Reject: Update status → REJECTED
  ↓
  Data finalized
```

### 3. EDIT DATA (Bendahara - Jika Pending)
```
Bendahara login → Kas Keluar → Data List
  ↓
  Jika status PENDING & milik sendiri → Edit button aktif
  ↓
  Edit data & submit
  ↓
  Data updated, masih status PENDING
```

### 4. HAPUS DATA
```
Bendahara: Hanya bisa hapus jika status PENDING & milik sendiri
Admin: Bisa hapus semua data
```

---

## Authorization & Access Control

| Action | Bendahara | Admin | Keterangan |
|--------|-----------|-------|-----------|
| Create | ✓ | ✓ | Input data baru |
| View All | ✗ | ✓ | Admin melihat semua |
| View Own | ✓ | ✓ | Bendahara hanya data sendiri |
| Edit Own (Pending) | ✓ | ✓ | Bendahara hanya pending |
| Edit Other | ✗ | ✓ | Admin bisa edit semua |
| Delete Own (Pending) | ✓ | ✓ | Bendahara hanya pending |
| Delete Other | ✗ | ✓ | Admin bisa delete semua |
| Approve | ✗ | ✓ | **ADMIN ONLY** |
| Reject | ✗ | ✓ | **ADMIN ONLY** |

---

## Validasi Input

### Tanggal
- Required
- Format: Y-m-d
- Error: "Tanggal harus diisi", "Format tanggal tidak sesuai"

### Jumlah
- Required
- Numeric
- Min: 0.01
- Max: 999999999.99
- Errors: "Jumlah harus diisi", "Jumlah harus berupa angka", "Jumlah minimal Rp 0,01", "Jumlah terlalu besar"

### Keterangan
- Required
- String
- Min: 3 karakter
- Max: 255 karakter
- Errors: "Keterangan harus diisi", "Keterangan minimal 3 karakter", "Keterangan maksimal 255 karakter"

### Kategori ID
- Required
- Must exist in kategoris table
- Error: "Kategori harus dipilih", "Kategori tidak ditemukan"

---

## Status Enum

| Status | Color | Icon | Makna |
|--------|-------|------|-------|
| pending | Kuning | ⏱️ | Menunggu approval |
| approved | Hijau | ✓ | Disetujui |
| rejected | Merah | ✗ | Ditolak |

---

## Testing Checklist

### 1. Bendahara User
- [ ] Login sebagai bendahara
- [ ] Dapat melihat data kas keluar milik sendiri saja
- [ ] Dapat input data baru (status auto pending)
- [ ] Dapat edit data jika status pending
- [ ] Tidak bisa edit data yang sudah approved/rejected
- [ ] Dapat hapus data jika status pending
- [ ] Tidak bisa approve/reject
- [ ] Alert info ditampilkan saat input/edit

### 2. Admin User
- [ ] Login sebagai admin
- [ ] Dapat melihat SEMUA data kas keluar
- [ ] Dapat melihat approve/reject buttons pada data pending
- [ ] Dapat approve data → status berubah approved
- [ ] Dapat reject data → status berubah rejected
- [ ] Tidak bisa approve data yang bukan pending
- [ ] Dapat edit/delete semua data

### 3. Validasi
- [ ] Submit form dengan data kosong → error ditampilkan
- [ ] Submit dengan jumlah negatif → error
- [ ] Submit dengan keterangan < 3 karakter → error
- [ ] Submit dengan kategori invalid → error
- [ ] Success message ditampilkan setelah submit

### 4. Role Middleware
- [ ] Non-admin tidak bisa akses approve route
- [ ] Non-admin tidak bisa akses reject route
- [ ] 403 error ditampilkan jika unauthorized

---

## File yang Dimodifikasi

1. ✓ `app/Http/Requests/StoreKasKeluarRequest.php` - NEW
2. ✓ `app/Http/Requests/UpdateKasKeluarRequest.php` - NEW
3. ✓ `app/Http/Controllers/KasKeluarController.php` - UPDATED
4. ✓ `routes/web.php` - UPDATED
5. ✓ `resources/views/kas_keluar/index.blade.php` - UPDATED
6. ✓ `resources/views/kas_keluar/create.blade.php` - UPDATED
7. ✓ `resources/views/kas_keluar/edit.blade.php` - UPDATED

---

## Fitur Tambahan untuk Masa Depan

- [ ] Email notification saat data di-approve/reject
- [ ] Audit trail untuk setiap perubahan status
- [ ] Comment/notes saat reject dengan alasan penolakan
- [ ] Report & analytics dashboard
- [ ] Export data ke PDF/Excel
- [ ] Workflow dengan multiple approval levels
- [ ] Budget limit per kategori

---

## Notes

- User model harus memiliki field `role` (admin, bendahara, user)
- Middleware `CheckRole` sudah ter-register di `Kernel.php`
- Validasi error messages dalam bahasa Indonesia
- Format mata uang: Rupiah (Rp)
- Pagination: 15 items per halaman
