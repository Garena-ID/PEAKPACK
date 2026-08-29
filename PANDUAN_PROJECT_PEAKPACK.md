# ⛰️ PANDUAN LENGKAP STRUKTUR & FUNGSI FILE PROJECT PEAKPACK

Dokumen ini berisi panduan lokasi file, hubungan antara **Route → Controller → View → Database**, serta penjelasan detail mengenai fungsi setiap file Blade dalam platform PeakPack.

---

## 🚀 1. CARA MENJALANKAN APLIKASI WEB

1. Buka Terminal / Command Prompt di folder proyek:
   ```bash
   cd C:\FW_API\peakpack
   ```
2. Jalankan server Laravel:
   ```bash
   php artisan serve
   ```
3. Akses melalui browser: `http://localhost:8000`

---

## 🗺️ 2. PETA HUBUNGAN ALUR APLIKASI (ROUTE → CONTROLLER → VIEW → TABEL)

### 🟢 A. ALUR CUSTOMER (PENGGUNA UTAMA)

| No | Alamat URL (Route) | File Controller yang Memproses | File Tampilan (Blade View) | Tabel Database yang Diakses | Fungsi Utama & Yang Ditampilkan |
| :--- | :--- | :--- | :--- | :--- | :--- |
| 1 | `/` (`welcome`) | Closure | `welcome.blade.php` | - | Landing page promo, tentang kami, kontak, & tombol login/register. |
| 2 | `/dashboard` (`dashboard`) | `UserDashboardController` | `dashboard.blade.php` | `users`, `rentals`, `mountains`, `gears` | Dashboard ringkasan user: profil, statistik sewa user, daftar sewa terbaru, rekomendasi gunung & gear. |
| 3 | `/mountains` (`mountains.catalog`) | `MountainController@catalog` | `catalog/mountains.blade.php` | `mountains` | Katalog seluruh gunung, filter pencarian & tingkat kesulitan (`Easy`, `Medium`, `Hard`). |
| 4 | `/gear` (`gear.catalog`) | `GearController@catalog` | `catalog/gear.blade.php` | `gears`, `gear_categories` | Katalog perlengkapan outdoor, stok tersedia, & tombol **"Sewa Sekarang"**. |
| 5 | `/rentals` (`rentals.index`) | `RentalController@index` | `rentals/index.blade.php` | `rentals` | Daftar riwayat penyewaan khusus milik user yang sedang login (`auth()->user()->rentals()`). |
| 6 | `/rentals/create` (`rentals.create`) | `RentalController@create` | `rentals/form.blade.php` | `gears` | Form pengajuan sewa: pilih tanggal sewa, tanggal pengembalian, & daftar item gear. |
| 7 | `/rentals/{id}` (`rentals.show`) | `RentalController@show` | `rentals/show.blade.php` & `rentals/details.blade.php` | `rentals`, `rental_items`, `gears` | Rincian detail nota sewa, barang yang dipinjam, total harga, & status transaksi. |

---

### 🔴 B. ALUR ADMIN (PENGELOLA SISTEM)

| No | Alamat URL (Route) | File Controller yang Memproses | File Tampilan (Blade View) | Tabel Database yang Diakses | Fungsi Utama & Yang Ditampilkan |
| :--- | :--- | :--- | :--- | :--- | :--- |
| 1 | `/admin/dashboard` (`admin.dashboard`) | `AdminDashboardController` | `admin/dashboard.blade.php` | `users`, `mountains`, `gears`, `rentals` | Statistik realtime sistem (Total Customer, Mountains, Gear, Rentals, Revenue) & transaksi terbaru. |
| 2 | `/admin/mountains` (`admin.mountains.index`) | `MountainController@index` | `admin/mountains/index.blade.php` | `mountains` | Tabel master data gunung, fitur pencarian, pagination, tombol Tambah, Edit, & Delete. |
| 3 | `/admin/mountains/create` (`admin.mountains.create`) | `MountainController@create` | `admin/mountains/create.blade.php` | `mountains` | Form input data gunung baru (Nama, Lokasi, Provinsi, Ketinggian, Kesulitan, Durasi). |
| 4 | `/admin/mountains/{id}/edit` (`admin.mountains.edit`) | `MountainController@edit` | `admin/mountains/edit.blade.php` | `mountains` | Form edit data gunung existing. |
| 5 | `/admin/gear-categories` (`admin.gear-categories.index`) | `GearCategoryController@index` | `admin/resources/index.blade.php` | `gear_categories` | Tabel master kategori perlengkapan. |
| 6 | `/admin/gear` (`admin.gear.index`) | `GearController@index` | `admin/resources/index.blade.php` | `gears`, `gear_categories` | Tabel master inventaris perlengkapan outdoor, stok, & harga sewa per hari. |
| 7 | `/admin/recommendations` (`admin.recommendations.index`) | `MountainRecommendationController@index` | `admin/resources/index.blade.php` | `mountain_recommendations`, `mountains`, `gears` | Pemetaan rekomendasi gear yang dibutuhkan untuk setiap gunung. |
| 8 | `/admin/rentals` (`admin.rentals.index`) | `RentalController@index` | `admin/rentals/index.blade.php` | `rentals`, `users` | Tabel seluruh transaksi penyewaan dari semua customer beserta filter status & kode rental. |
| 9 | `/admin/rentals/{id}` (`admin.rentals.show`) | `RentalController@show` | `admin/rentals/show.blade.php` | `rentals`, `rental_items`, `gears` | Detail transaksi sewa + form update status (`Pending` → `On Rent` → `Completed`) & pengembalian stok. |
| 10 | `/admin/reports` (`admin.reports.index`) | `ReportController@index` | `admin/reports/index.blade.php` | `rentals`, `users`, `gears` | Rekapitulasi operasional, filter rentang tanggal & status, serta tombol Export PDF & Excel. |
| 11 | `/admin/reports/export-pdf` (`admin.reports.export-pdf`) | `ReportController@exportPdf` | `admin/reports/pdf.blade.php` | `rentals`, `users`, `gears` | Tampilan khusus cetak dokumen PDF dengan auto-print browser dialog (`window.print()`). |
| 12 | `/admin/reports/export-excel` (`admin.reports.export-excel`)| `ReportController@exportExcel` | File `.csv` (Stream response) | `rentals`, `users` | Mendownload berkas Excel/CSV rekapitulasi transaksi sewa. |

---

## 📄 3. PENJELASAN DETAIL UNTUK SETIAP FILE VIEW BLADE

### 1. `resources/views/dashboard.blade.php` (Customer Dashboard)
- **Mengakses data**: `$user` (pengguna aktif), `$rentals` (5 transaksi sewa terbaru milik user), `$mountains` (destinasi gunung), `$availableGear` (perlengkapan stok > 0).
- **Komponen yang ditambahkan/ditampilkan**:
  - Banner salam pembuka & tombol cepat `Rent Gear` dan `Explore Mountains`.
  - Ringkasan Profil & 3 kartu total sewa (*Total Sewa, Pending/Active, Completed*).
  - Tabel singkat penyewaan terbaru user.
  - Kartu perlengkapan siap sewa + tombol langsung sewa.
  - Kartu rekomendasi destinasi pendakian.

### 2. `resources/views/admin/dashboard.blade.php` (Admin Dashboard)
- **Mengakses data**: `$stats` (jumlah realtime `customers`, `mountains`, `gear`, `rentals`, `pending_rentals`, `active_rentals`, `completed`, `total_revenue`), `$recentRentals` (6 transaksi terbaru).
- **Komponen yang ditambahkan/ditampilkan**:
  - 4 Kartu metrik utama statistik sistem.
  - 4 Kartu rincian status rental & total akumulasi pendapatan.
  - Tabel transaksi penyewaan terbaru dari seluruh pelanggan.

### 3. `resources/views/catalog/mountains.blade.php`
- **Mengakses data**: `$mountains` (paginated list gunung).
- **Ditampilkan**: Grid kartu gunung lengkap dengan badge tingkat kesulitan (`Easy`, `Medium`, `Hard`), lokasi, provinsi, ketinggian (mdpl), & durasi estimasi pendakian.

### 4. `resources/views/catalog/gear.blade.php`
- **Mengakses data**: `$gear` (paginated list perlengkapan), `$categories` (daftar kategori gear).
- **Ditampilkan**: Grid kartu gear dengan info stok, harga sewa harian, & tombol **"Sewa Sekarang"** yang mengarahkan ke form rental dengan `gear_id` otomatis terisi.

### 5. `resources/views/rentals/form.blade.php` (Form Sewa Customer)
- **Mengakses data**: `$gear` (daftar perlengkapan dengan stok > 0).
- **Ditampilkan**: Input tanggal pengambilan, tanggal pengembalian, serta antarmuka dinamis AlpineJS (`x-data`) untuk menambah/menghapus baris perlengkapan yang ingin disewa.

### 6. `resources/views/admin/reports/index.blade.php` (Laporan Admin)
- **Mengakses data**: `$totalCustomers`, `$totalMountains`, `$totalGear`, `$filteredRevenue`, `$statusCounts`, `$rentals` (paginated).
- **Ditampilkan**: Ringkasan metrik laporan, form filter tanggal mulai & tanggal akhir, filter status sewa, serta tombol **Export PDF** & **Export Excel**.

### 7. `resources/views/admin/reports/pdf.blade.php` (Template Cetak PDF)
- **Mengakses data**: `$rentals`, `$totalRevenue`, `$startDate`, `$endDate`, `$status`.
- **Ditampilkan**: Dokumen cetak bersih berlogo PeakPack, periode laporan, tanggal cetak, tabel rincian transaksi, total pendapatan, & pemicu cetak otomatis (`onload="window.print()"`).

### 8. `resources/views/components/sidebar.blade.php` (Menu Navigasi Customer)
- **Menu FIX**:
  - Dashboard (`route('dashboard')`)
  - Explore Mountains (`route('mountains.catalog')`)
  - Rent Gear (`route('gear.catalog')`)
  - My Rentals (`route('rentals.index')`)
  - Profile (`route('profile.edit')`)
  - Logout (`route('logout')`)

### 9. `resources/views/components/admin-sidebar.blade.php` (Menu Navigasi Admin)
- **Menu FIX**:
  - Dashboard (`route('admin.dashboard')`)
  - **DATA**: Mountains, Gear Categories, Gear
  - **TRANSACTIONS**: Rentals
  - **RECOMMENDATION**: Mountain Recommendations
  - **REPORT**: Reports
  - **ACCOUNT**: Profile, Logout

---

## 🛠️ 4. PETUNJUK MEMPERBAIKI & MENAMBAH FITUR BARU

Jika Anda ingin menambahkan fitur baru di masa mendatang, ikuti alur 4 langkah ini:

1. **Tambahkan Rute** di `routes/web.php`:
   ```php
   Route::get('/nama-fitur', [NamaController::class, 'index'])->name('nama-fitur.index');
   ```
2. **Buat / Edit Controller** di `app/Http/Controllers/NamaController.php`:
   ```php
   public function index() {
       $data = Model::all();
       return view('folder.nama-view', compact('data'));
   }
   ```
3. **Buat File Tampilan (Blade)** di `resources/views/folder/nama-view.blade.php`:
   - Untuk Customer: gunakan `@extends('layouts.app')`
   - Untuk Admin: gunakan `@extends('layouts.admin')`
4. **Tambahkan Link ke Sidebar Menu**:
   - Edit [resources/views/components/sidebar.blade.php](file:///c:/FW_API/peakpack/resources/views/components/sidebar.blade.php) (untuk Customer)
   - Edit [resources/views/components/admin-sidebar.blade.php](file:///c:/FW_API/peakpack/resources/views/components/admin-sidebar.blade.php) (untuk Admin)

---

*Dokumen ini dibuat otomatis sebagai panduan resmi pengembangan project PeakPack.*
