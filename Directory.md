# 📁 PANDUAN STRUKTUR DIREKTORI & PENEMPATAN FILE (PEAKPACK)

Dokumen ini berfungsi sebagai peta penempatan file dan panduan standar saat Anda ingin menambahkan fitur baru pada proyek **PeakPack** (Laravel 11 + Blade + TailwindCSS + Alpine.js).

---

## 🌳 1. STRUKTUR LENGKAP DIREKTORI PROYEK

Berikut adalah pohon direktori utama serta tujuan masing-masing folder:

```text
peakpack/
├── app/                                # Logika utama backend aplikasi
│   ├── Http/
│   │   ├── Controllers/                # Controller untuk mengolah request, logika data, & response
│   │   │   ├── Auth/                   # Controller autentikasi bawaan (Login, Register, Password, dll)
│   │   │   ├── AdminDashboardController.php
│   │   │   ├── CustomersController.php
│   │   │   ├── GearCategoryController.php
│   │   │   ├── GearController.php
│   │   │   ├── MountainController.php
│   │   │   ├── MountainRecommendationController.php
│   │   │   ├── ProfileController.php
│   │   │   ├── RentalController.php
│   │   │   ├── RentalItemController.php
│   │   │   ├── ReportController.php
│   │   │   └── UserDashboardController.php
│   │   ├── Middleware/                 # Middleware filter (auth, role admin, dsb)
│   │   └── Requests/                   # Form Request validation (opsional/jika ada)
│   ├── Models/                         # Eloquent Model (representasi tabel database & relasi)
│   │   ├── Gear.php
│   │   ├── GearCategory.php
│   │   ├── Mountain.php
│   │   ├── MountainRecommendation.php
│   │   ├── Rental.php
│   │   ├── RentalItem.php
│   │   └── User.php
│   └── Providers/                      # Service providers konfigurasi app
├── bootstrap/                          # Bootstrapping framework & konfigurasi app.php
├── config/                             # File konfigurasi global (app, database, auth, mail, dll)
├── database/                           # Skema & data awal database
│   ├── factories/                      # Factory generator data testing
│   ├── migrations/                     # File migrasi struktur tabel database
│   ├── seeders/                        # File seeder pengisi data awal / demo
│   └── database.sqlite                 # File database SQLite aktif
├── public/                             # File publik yang dapat diakses langsung oleh browser
│   ├── build/                          # Hasil compile Vite (CSS/JS bundle)
│   ├── images/                         # Aset gambar statis, ikon, logo
│   └── storage/                        # Symlink ke storage/app/public (upload user)
├── resources/                          # File sumber daya frontend (Blade, CSS, JS)
│   ├── css/                            # Sumber styling (Tailwind CSS)
│   │   └── app.css
│   ├── js/                             # Sumber skrip JavaScript / Alpine.js
│   │   └── app.js
│   └── views/                          # Template antarmuka tampilan (Blade Views)
│       ├── admin/                      # Seluruh halaman khusus Administrator
│       │   ├── customers/              # Manajemen data customer
│       │   ├── mountains/              # Manajemen data gunung (create, edit, index)
│       │   ├── rental-items/           # Manajemen rincian item rental
│       │   ├── rentals/                # Manajemen transaksi sewa (daftar & detail admin)
│       │   ├── reports/                # Laporan & Cetak PDF / Export Excel
│       │   ├── resources/              # Manajemen umum kategori gear & rekomendasi
│       │   └── dashboard.blade.php     # Halaman ringkasan statistik admin
│       ├── auth/                       # Halaman login, register, forgot-password, dll
│       ├── catalog/                    # Halaman katalog publik / customer
│       │   ├── gear.blade.php          # Katalog sewa alat outdoor
│       │   └── mountains.blade.php     # Katalog eksplorasi gunung
│       ├── components/                 # Komponen UI Blade yang dapat dipakai ulang
│       │   ├── admin-sidebar.blade.php # Menu sidebar panel admin
│       │   ├── sidebar.blade.php       # Menu sidebar panel customer
│       │   ├── footer.blade.php        # Footer aplikasi
│       │   ├── topbar.blade.php        # Bar atas dashboard
│       │   └── ... (komponen form, modal, button)
│       ├── layouts/                    # Master layout utama
│       │   ├── admin.blade.php         # Kerangka layout halaman Admin
│       │   ├── app.blade.php           # Kerangka layout halaman Customer
│       │   └── guest.blade.php         # Kerangka layout halaman Guest/Auth
│       ├── profile/                    # Halaman pengaturan profil user & admin
│       ├── rentals/                    # Halaman transaksi penyewaan customer
│       │   ├── form.blade.php          # Form checkout booking sewa gear
│       │   ├── index.blade.php         # Riwayat penyewaan milik customer
│       │   └── show.blade.php / details.blade.php # Detail nota sewa customer
│       ├── dashboard.blade.php         # Dashboard utama customer
│       └── welcome.blade.php           # Halaman depan / Landing page
├── routes/                             # Definisi rute & URL
│   ├── auth.php                        # Rute autentikasi (login, register, logout)
│   └── web.php                         # Rute utama aplikasi web (Customer & Admin)
├── storage/                            # Berkas upload, cache framework, & log sistem
├── tests/                              # File pengujian unit & fitur (Pest / PHPUnit)
├── .env                                # Konfigurasi environment (DB, App Key, URL)
└── vite.config.js                      # Konfigurasi bundler Vite
```

---

## 🗺️ 2. PETA PENEMPATAN BERDASARKAN PERAN & FUNGSI

| Jenis File / Layer | Folder Tempat Menyimpan | Contoh File yang Ada |
| :--- | :--- | :--- |
| **Model & Relasi** | `app/Models/` | `Mountain.php`, `Gear.php`, `Rental.php` |
| **Controller Customer** | `app/Http/Controllers/` | `RentalController.php`, `MountainController.php` |
| **Controller Admin** | `app/Http/Controllers/` | `AdminDashboardController.php`, `ReportController.php` |
| **Tampilan Admin** | `resources/views/admin/{fitur}/` | `resources/views/admin/mountains/index.blade.php` |
| **Tampilan Customer** | `resources/views/{fitur}/` | `resources/views/rentals/form.blade.php` |
| **Komponen Reusable** | `resources/views/components/` | `sidebar.blade.php`, `admin-sidebar.blade.php` |
| **Definisi Rute** | `routes/web.php` | Rute customer di group `auth`, Admin di prefix `admin` |
| **Database Migrations** | `database/migrations/` | `YYYY_MM_DD_create_xxx_table.php` |
| **Database Seeders** | `database/seeders/` | `MountainSeeder.php`, `GearSeeder.php` |
| **Aset Gambar / Media** | `public/images/` atau `storage/app/public/` | Logo, foto gunung, thumbnail gear |

---

## 🔄 3. PETA ALUR APLIKASI (ROUTE → CONTROLLER → VIEW → TABEL)

### 🟢 A. Alur Customer (Pengguna Utama)

| URL (Route) | Controller & Method | File Blade (View) | Tabel Database | Kegunaan |
| :--- | :--- | :--- | :--- | :--- |
| `/` | `welcome` (Closure) | `welcome.blade.php` | `mountains`, `gears` | Landing page publik & etalase singkat |
| `/dashboard` | `UserDashboardController` | `dashboard.blade.php` | `users`, `rentals`, `gears` | Dashboard ringkasan profil & riwayat sewa |
| `/mountains` | `MountainController@catalog` | `catalog/mountains.blade.php` | `mountains` | Katalog eksplorasi gunung & detail jalur |
| `/gear` | `GearController@catalog` | `catalog/gear.blade.php` | `gears`, `gear_categories` | Katalog sewa perlengkapan outdoor |
| `/rentals` | `RentalController@index` | `rentals/index.blade.php` | `rentals` | Daftar riwayat penyewaan user aktif |
| `/rentals/create` | `RentalController@create` | `rentals/form.blade.php` | `gears` | Form booking sewa alat dengan Alpine.js |
| `/rentals/{id}` | `RentalController@show` | `rentals/show.blade.php` | `rentals`, `rental_items` | Rincian invoice dan status transaksi |
| `/profile` | `ProfileController@edit` | `profile/customer.blade.php` | `users` | Edit profil & ganti kata sandi |

### 🔴 B. Alur Admin (Pengelola Sistem)

| URL (Route) | Controller & Method | File Blade (View) | Tabel Database | Kegunaan |
| :--- | :--- | :--- | :--- | :--- |
| `/admin/dashboard` | `AdminDashboardController` | `admin/dashboard.blade.php` | Semua tabel | Metrik statistik realtime & grafik |
| `/admin/customers` | `CustomersController` | `admin/customers/index.blade.php` | `users` | Manajemen akun customer |
| `/admin/mountains` | `MountainController` | `admin/mountains/index.blade.php` | `mountains` | CRUD data gunung & upload foto |
| `/admin/gear-categories` | `GearCategoryController` | `admin/resources/index.blade.php` | `gear_categories` | CRUD kategori perlengkapan |
| `/admin/gear` | `GearController` | `admin/resources/index.blade.php` | `gears` | CRUD stok & tarif sewa gear |
| `/admin/recommendations` | `MountainRecommendationController` | `admin/resources/index.blade.php` | `mountain_recommendations` | Pemetaan gear rekomendasi per gunung |
| `/admin/rentals` | `RentalController` | `admin/rentals/index.blade.php` | `rentals`, `rental_items` | Pengelolaan status sewa & verifikasi |
| `/admin/reports` | `ReportController@index` | `admin/reports/index.blade.php` | `rentals`, `users` | Filter laporan & rekap keuangan |
| `/admin/reports/export-pdf` | `ReportController@exportPdf` | `admin/reports/pdf.blade.php` | `rentals` | Cetak laporan formal (PDF Print Dialog) |
| `/admin/reports/export-excel` | `ReportController@exportExcel` | Stream download `.csv` | `rentals` | Ekspor data ke format spreadsheet/Excel |

---

## 🛠️ 4. PANDUAN PRAKTIS: CARA MENAMBAHKAN FITUR BARU

Saat Anda ingin menambahkan fitur baru, ikuti urutan langkah standar berikut:

```
[1. Migration] ➜ [2. Model] ➜ [3. Controller] ➜ [4. View (Blade)] ➜ [5. Route] ➜ [6. Sidebar Menu]
```

### Langkah 1: Buat Migration & Model
Jalankan perintah di terminal:
```bash
php artisan make:model NamaModel -m
```
- File migrasi akan dibuat di `database/migrations/` ➔ Tentukan kolom tabel.
- File model akan dibuat di `app/Models/NamaModel.php` ➔ Tambahkan `$fillable` dan relasi (`belongsTo`, `hasMany`, dsb).
- Jalankan migrasi:
  ```bash
  php artisan migrate
  ```

### Langkah 2: Buat Controller
```bash
php artisan make:controller NamaFiturController --resource
```
- File tersimpan di `app/Http/Controllers/NamaFiturController.php`.
- Tulis fungsi logika (`index`, `create`, `store`, `show`, `edit`, `update`, `destroy`).

### Langkah 3: Buat File Tampilan (View Blade)
- **Jika untuk Customer**: Buat folder di `resources/views/nama-fitur/index.blade.php`
  Gunakan layout customer:
  ```html
  @extends('layouts.app')

  @section('content')
  <div class="container mx-auto px-4 py-8">
      <!-- Konten Fitur Customer Disini -->
  </div>
  @endsection
  ```
- **Jika untuk Admin**: Buat folder di `resources/views/admin/nama-fitur/index.blade.php`
  Gunakan layout admin:
  ```html
  @extends('layouts.admin')

  @section('content')
  <div class="p-6">
      <!-- Konten Master Data / Panel Admin Disini -->
  </div>
  @endsection
  ```

### Langkah 4: Daftarkan Rute di `routes/web.php`
- **Untuk Customer (Wajib Login)**:
  ```php
  Route::middleware(['auth', 'verified'])->group(function () {
      Route::resource('nama-fitur', NamaFiturController::class);
  });
  ```
- **Untuk Admin (Wajib Hak Akses Admin)**:
  ```php
  Route::prefix('admin')->as('admin.')->middleware(['auth', 'admin'])->group(function () {
      Route::resource('nama-fitur', NamaFiturController::class);
  });
  ```

### Langkah 5: Tambahkan Navigasi ke Sidebar
- **Customer Sidebar**: Edit [resources/views/components/sidebar.blade.php](file:///c:/FW_API/peakpack/resources/views/components/sidebar.blade.php)
- **Admin Sidebar**: Edit [resources/views/components/admin-sidebar.blade.php](file:///c:/FW_API/peakpack/resources/views/components/admin-sidebar.blade.php)

---

## 📌 5. ATURAN PENAMAAN (CONVENTIONS)

1. **Model**: Singular, PascalCase (`Mountain`, `RentalItem`, `GearCategory`).
2. **Tabel Database**: Plural, snake_case (`mountains`, `rental_items`, `gear_categories`).
3. **Controller**: PascalCase berakhiran Controller (`MountainController`, `RentalController`).
4. **File Blade**: lowercase dengan kebab-case (`index.blade.php`, `admin-sidebar.blade.php`).
5. **Route Name**: dot notation (`admin.mountains.index`, `rentals.create`).
