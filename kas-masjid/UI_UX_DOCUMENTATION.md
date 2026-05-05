# Dokumentasi UI/UX Sistem Kas Masjid

Versi: 1.0  
Tanggal: 2026-05-05  
Framework: Laravel 10 + Bootstrap 5  
Status: ✅ Completed

---

## 📋 Daftar Isi

1. [Pengenalan](#pengenalan)
2. [Arsitektur Desain](#arsitektur-desain)
3. [Halaman-Halaman](#halaman-halaman)
4. [Komponen Reusable](#komponen-reusable)
5. [Panduan Penggunaan](#panduan-penggunaan)
6. [Tips Pengembangan](#tips-pengembangan)

---

## 🎨 Pengenalan

Sistem Kas Masjid telah didesain ulang dengan mengikuti prinsip-prinsip modern UI/UX menggunakan:
- **Framework**: Bootstrap 5.3.0
- **Ikon**: Bootstrap Icons 1.11.0
- **Warna**: Palette warna modern dengan gradien
- **Typography**: Segoe UI (fallback: Tahoma, Geneva, Verdana)
- **Responsive**: Mobile-first approach

### Palet Warna

```
Primary:      #4f46e5 (Indigo)
Primary Dark: #7c3aed (Purple)
Success:      #10b981 (Emerald)
Danger:       #ef4444 (Red)
Warning:      #f59e0b (Amber)
Info:         #3b82f6 (Blue)
Light:        #f8fafc (Slate)
Dark:         #1e293b (Slate)
```

---

## 🏗️ Arsitektur Desain

### Layout Utama (`resources/views/layouts/app.blade.php`)

Struktur layout dengan sidebar tetap di kiri dan konten utama responsif:

```
┌─────────────────────────────────────┐
│ NAVBAR (Header Atas)                │
├─────────────────┬───────────────────┤
│                 │                   │
│  SIDEBAR        │   CONTENT AREA    │
│  (260px fixed)  │   (Responsive)    │
│                 │                   │
│                 │                   │
└─────────────────┴───────────────────┘
```

**Fitur Utama:**
- Sidebar navigasi dengan hover effect
- Navbar top dengan profil user
- Responsif untuk mobile (sidebar dapat disembunyikan)
- Alert notifications dengan animasi smooth
- Consistent styling di seluruh aplikasi

### Tema Warna Layout

- **Sidebar**: Dark gradient (#1e293b → #0f172a)
- **Navbar**: Dark gradient dengan background shadow
- **Background**: Light (#f8fafc)
- **Cards**: White dengan subtle shadow

---

## 📄 Halaman-Halaman

### 1. Login Page (`resources/views/auth/login.blade.php`)

**Fitur:**
- ✅ Full-screen centered form
- ✅ Gradient background dengan animasi
- ✅ Logo dengan icon piggy bank
- ✅ Input fields dengan validasi real-time
- ✅ Error display yang jelas
- ✅ "Ingat saya" checkbox
- ✅ Link registrasi
- ✅ Mobile responsive

**Desain Highlights:**
- Animated background decorations
- Modern glassmorphism inspiration
- Smooth focus transitions
- Professional color scheme

---

### 2. Dashboard (`resources/views/dashboard/index.blade.php`)

**Fitur:**
- ✅ 3 Statistical Cards (Kas Masuk, Kas Keluar, Saldo)
- ✅ Monthly trend bar chart
- ✅ Income distribution pie chart
- ✅ Expense distribution pie chart
- ✅ System information section
- ✅ Responsive grid layout

**Komponen:**

#### Stat Cards
```blade
<div class="stat-card income">
    <div class="stat-label"><i class="bi bi-arrow-down-circle"></i> Total Kas Masuk</div>
    <div class="stat-value text-success">Rp {{ number_format($totalMasuk, 0, ',', '.') }}</div>
    <div class="stat-change positive"><i class="bi bi-check-circle"></i> Pemasukan bulan ini</div>
</div>
```

**Chart Libraries:**
- Chart.js untuk visualisasi data
- Bar chart untuk trend bulanan
- Doughnut charts untuk distribusi kategori

---

### 3. Kas Masuk (`resources/views/kas_masuk/index.blade.php`)

**Fitur:**
- ✅ Tabel data dengan hover effects
- ✅ Kolom: Tanggal, Kategori, Keterangan, Jumlah, Penginput, Aksi
- ✅ Tombol Edit dan Delete
- ✅ Pagination
- ✅ Empty state message
- ✅ Kategori badge dengan warna

**Styling Khusus:**
- Row hover highlight
- Amount color: green (#10b981)
- Status badges dengan background warna
- Action buttons dengan smooth transitions

---

### 4. Kas Keluar (`resources/views/kas_keluar/index.blade.php`)

**Fitur:**
- ✅ Similar dengan Kas Masuk
- ✅ Tambahan: Status badge (Pending/Approved/Rejected)
- ✅ Role-based actions (Edit, Delete, Approve, Reject)
- ✅ Conditional button rendering
- ✅ Amount color: red (#ef4444)

**Status Badges:**
```
Pending:  Yellow (#fef3c7) - Clock icon
Approved: Green (#d1fae5) - Check icon
Rejected: Red (#fee2e2) - X icon
```

---

### 5. Tambah/Edit Kas Masuk (`resources/views/kas_masuk/create.blade.php`, `edit.blade.php`)

**Fitur:**
- ✅ Centered form container (max-width: 600px)
- ✅ Clean form layout dengan spacing
- ✅ Input validation indicators
- ✅ Help text untuk setiap field
- ✅ Info alerts
- ✅ Submit & Cancel buttons
- ✅ Icon di setiap label

**Form Fields:**
1. Tanggal (date picker)
2. Kategori (select dropdown)
3. Jumlah (number input)
4. Keterangan (textarea)

---

### 6. Tambah/Edit Kas Keluar (`resources/views/kas_keluar/create.blade.php`, `edit.blade.php`)

**Perbedaan dari Kas Masuk:**
- ✅ Warning alert untuk status pending
- ✅ Display status badge pada edit
- ✅ Conditional editing untuk non-admin users

---

## 🧩 Komponen Reusable

Komponen tersimpan di `resources/views/components/`

### 1. Stat Card Component

**File:** `stat-card.blade.php`

**Penggunaan:**
```blade
<x-stat-card 
    label="Total Kas Masuk"
    value="Rp 50.000.000"
    type="income"
    icon="bi-arrow-down-circle"
    change="+Rp 5.000.000"
/>
```

**Props:**
- `label`: Label card
- `value`: Nilai utama
- `icon`: Bootstrap icon class
- `type`: income|expense|balance|primary
- `change`: Perubahan (optional)

---

### 2. Alert Component

**File:** `alert.blade.php`

**Penggunaan:**
```blade
<x-alert type="success" title="Berhasil!" message="Data telah disimpan" />
<x-alert type="warning">Custom slot content</x-alert>
```

**Props:**
- `type`: success|danger|warning|info
- `title`: Judul alert (optional)
- `message`: Pesan alert (optional)

---

### 3. Button Component

**File:** `button.blade.php`

**Penggunaan:**
```blade
<x-button variant="primary" size="md" icon="bi-plus-circle">
    Tambah Data
</x-button>

<x-button href="{{ route('home') }}" variant="secondary">
    Kembali
</x-button>
```

**Props:**
- `href`: Link (jika button adalah link)
- `type`: submit|button|reset
- `variant`: primary|success|danger|warning|secondary|light
- `size`: sm|md|lg
- `icon`: Bootstrap icon class
- `disabled`: true|false

---

## 📖 Panduan Penggunaan

### Menambah Halaman Baru

1. **Buat file view** di `resources/views/nama-folder/halaman.blade.php`

2. **Extend layout utama:**
```blade
@extends('layouts.app')

@section('title', 'Judul Halaman')

@section('styles')
<style>
    /* Custom styles untuk halaman ini */
</style>
@endsection

@section('content')
    <!-- Konten halaman -->
@endsection
```

3. **Gunakan komponen:**
```blade
<x-stat-card label="Title" value="Value" type="primary" />
<x-alert type="info" title="Info" />
<x-button variant="primary">Click</x-button>
```

### Styling Guidelines

#### Spacing
- Margin/Padding: 20px, 25px, 30px
- Gap antar elemen: 8px, 12px, 15px, 20px

#### Border Radius
- Small: 6px
- Medium: 8px
- Large: 12px

#### Font Sizes
- Heading 1: 2rem (700 weight)
- Heading 2: 1.8rem (700 weight)
- Body: 0.95rem-1rem (400 weight)
- Small: 0.85rem (500 weight)
- Labels: 0.85rem uppercase

#### Shadows
- Light: 0 1px 3px rgba(0,0,0,0.1)
- Medium: 0 4px 12px rgba(0,0,0,0.15)
- Heavy: 0 8px 20px rgba(0,0,0,0.15)

---

## 💡 Tips Pengembangan

### 1. Responsiveness

Gunakan media queries untuk mobile:
```css
@media (max-width: 768px) {
    .element {
        /* Mobile styles */
    }
}
```

### 2. Accessibility

- Selalu gunakan `<label>` untuk form inputs
- Tambahkan `aria-label` untuk icon-only buttons
- Gunakan semantic HTML (`<header>`, `<nav>`, `<main>`, etc)
- Pastikan contrast ratio cukup (WCAG AA minimum)

### 3. Performance

- Lazy load images
- Minimize CSS/JS
- Gunakan CDN untuk library eksternal
- Optimize font loading

### 4. Konsistensi

- Gunakan color variables (CSS custom properties)
- Maintain naming conventions
- Dokumentasikan custom components
- Reuse components sebanyak mungkin

### 5. Testing

- Test di berbagai breakpoints (320px, 768px, 1024px, 1440px)
- Test form validation
- Test dengan screen reader
- Test di berbagai browser

---

## 🚀 Fitur-Fitur Unggulan

✅ **Modern Design**
- Gradient backgrounds
- Smooth animations
- Professional color scheme

✅ **Responsive**
- Mobile-first approach
- Flexible grid system
- Touch-friendly buttons

✅ **Accessible**
- Semantic HTML
- Keyboard navigation
- High contrast

✅ **Fast**
- Optimized assets
- Minimal dependencies
- Efficient CSS

✅ **Maintainable**
- Clean code structure
- Reusable components
- Well-documented

---

## 📱 Mobile Breakpoints

```
Extra Small: < 576px  (Phone)
Small:       576px    (Large Phone)
Medium:      768px    (Tablet)
Large:       1024px   (Desktop)
Extra Large: 1440px   (Wide Desktop)
```

---

## 🎯 Checklist Implementasi

- ✅ Layout utama dengan sidebar responsif
- ✅ Login page dengan modern design
- ✅ Dashboard dengan statistik dan charts
- ✅ Tabel data Kas Masuk dan Kas Keluar
- ✅ Form Create/Edit dengan validasi
- ✅ Status badges dan role-based actions
- ✅ Reusable components (Stat Card, Alert, Button)
- ✅ Consistent styling di seluruh aplikasi
- ✅ Mobile responsive design
- ✅ Smooth animations dan transitions

---

## 📞 Support

Untuk pertanyaan atau saran perbaikan, silakan hubungi tim pengembang.

---

**Dibuat dengan ❤️ menggunakan Laravel 10 dan Bootstrap 5**
