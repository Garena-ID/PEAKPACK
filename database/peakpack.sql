-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Sep 2026 pada 14.30
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peakpack`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `gears`
--

CREATE TABLE `gears` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `stock` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `rental_price` decimal(12,2) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gears`
--

INSERT INTO `gears` (`id`, `category_id`, `name`, `stock`, `rental_price`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 'Tenda 2 Orang', 5, 50000.00, 'Tenda untuk kapasitas 2 orang.', '2026-08-03 23:14:56', '2026-09-02 05:25:45'),
(2, 2, 'Carrier 40L', 5, 35000.00, 'Carrier dengan kapasitas 40 liter.', '2026-08-03 23:14:56', '2026-09-02 05:21:29'),
(3, 3, 'Sleeping Bag', 10, 20000.00, 'Sleeping bag untuk kebutuhan bermalam.', '2026-08-03 23:14:56', '2026-08-29 00:20:41'),
(4, 4, 'Headlamp', 10, 15000.00, 'Lampu kepala untuk membantu penerangan.', '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(5, 5, 'Kompor Portable', 10, 30000.00, 'Alat Masak Kompor Portable Sudah Include Dengan Gas Portable', '2026-08-29 00:18:44', '2026-09-02 05:25:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `gear_categories`
--

CREATE TABLE `gear_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `gear_categories`
--

INSERT INTO `gear_categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tenda', '2026-08-03 23:14:55', '2026-08-03 23:14:55'),
(2, 'Carrier', '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(3, 'Sleeping Bag', '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(4, 'Penerangan', '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(5, 'Alat Masak', '2026-08-29 00:17:40', '2026-08-29 00:17:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_04_045615_create_gear_categories_table', 2),
(5, '2026_08_04_045615_create_mountains_table', 2),
(6, '2026_08_04_045616_create_gears_table', 2),
(7, '2026_08_04_045616_create_rentals_table', 2),
(8, '2026_08_04_045617_create_mountain_recommendations_table', 2),
(9, '2026_08_04_045617_create_rental_items_table', 2),
(10, '2026_08_04_060228_add_role_to_users_table', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mountains`
--

CREATE TABLE `mountains` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `elevation` int(10) UNSIGNED NOT NULL,
  `difficulty` enum('Easy','Medium','Hard') NOT NULL,
  `estimated_duration` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mountains`
--

INSERT INTO `mountains` (`id`, `name`, `location`, `province`, `elevation`, `difficulty`, `estimated_duration`, `description`, `latitude`, `longitude`, `created_at`, `updated_at`) VALUES
(1, 'Gunung Gede', 'Cibodas', 'Jawa Barat', 2958, 'Medium', '1-2 hari', 'Gunung Gede merupakan salah satu gunung populer di Jawa Barat.', -6.7875000, 106.9790000, '2026-08-03 23:05:36', '2026-08-03 23:14:55'),
(2, 'Gunung Papandayan', 'Garut', 'Jawa Barat', 2665, 'Easy', '1 hari', 'Gunung Papandayan memiliki jalur pendakian yang relatif mudah.', -7.3190000, 107.7310000, '2026-08-03 23:05:36', '2026-09-02 03:16:01'),
(3, 'Gunung Ciremai', 'Kuningan', 'Jawa Barat', 3078, 'Hard', '1-2 hari', 'Gunung Ciremai merupakan gunung tertinggi di wilayah Jawa Barat.', -6.8920000, 108.4050000, '2026-08-03 23:14:55', '2026-08-28 23:50:37');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mountain_recommendations`
--

CREATE TABLE `mountain_recommendations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mountain_id` bigint(20) UNSIGNED NOT NULL,
  `gear_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `mountain_recommendations`
--

INSERT INTO `mountain_recommendations` (`id`, `mountain_id`, `gear_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(2, 1, 2, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(3, 1, 3, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(4, 2, 2, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(5, 2, 3, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(6, 3, 1, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(7, 3, 2, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(8, 3, 3, '2026-08-03 23:14:56', '2026-08-03 23:14:56'),
(9, 3, 4, '2026-08-03 23:14:56', '2026-08-03 23:14:56');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rentals`
--

CREATE TABLE `rentals` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `rental_code` varchar(255) NOT NULL,
  `rental_date` date NOT NULL,
  `due_date` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `total_price` decimal(12,2) NOT NULL DEFAULT 0.00,
  `status` enum('Pending','On Rent','Completed') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `rental_code`, `rental_date`, `due_date`, `return_date`, `total_price`, `status`, `created_at`, `updated_at`) VALUES
(1, 5, 'PP-260829-LZMZD', '2026-08-29', '2026-08-31', '2026-08-31', 50000.00, 'Completed', '2026-08-29 00:13:00', '2026-08-29 00:19:15'),
(3, 5, 'PP-260829-1JCYY', '2026-08-29', '2026-08-31', '2026-08-31', 175000.00, 'Completed', '2026-08-29 00:22:14', '2026-08-29 00:23:39'),
(4, 5, 'PP-260829-JUFLM', '2026-08-29', '2026-08-31', NULL, 175000.00, 'Completed', '2026-08-29 00:28:02', '2026-08-29 00:29:05'),
(14, 7, 'PP-260902-CKZKE', '2026-09-02', '2026-09-04', '2026-09-02', 160000.00, 'Completed', '2026-09-02 05:23:18', '2026-09-02 05:25:45');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rental_items`
--

CREATE TABLE `rental_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rental_id` bigint(20) UNSIGNED NOT NULL,
  `gear_id` bigint(20) UNSIGNED NOT NULL,
  `qty` int(10) UNSIGNED NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rental_items`
--

INSERT INTO `rental_items` (`id`, `rental_id`, `gear_id`, `qty`, `price`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 50000.00, 50000.00, '2026-08-29 00:13:00', '2026-08-29 00:13:00'),
(2, 3, 2, 5, 35000.00, 175000.00, '2026-08-29 00:22:14', '2026-08-29 00:22:14'),
(3, 4, 2, 5, 35000.00, 175000.00, '2026-08-29 00:28:02', '2026-08-29 00:28:02'),
(13, 14, 1, 2, 50000.00, 100000.00, '2026-09-02 05:23:18', '2026-09-02 05:23:18'),
(14, 14, 5, 2, 30000.00, 60000.00, '2026-09-02 05:23:18', '2026-09-02 05:23:18');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('Z5CfN5XYbMZ1y9PrcUUoQf2FvZFkpTyJ8NiX8p3q', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVTZlYWhXaEVNaEFLa1J4VmJQMldRSUNaYUlpNTE1cVUyMzA4MmlEbiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6MTU6ImFkbWluLmRhc2hib2FyZCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjM7fQ==', 1788352186);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'tester', 'imilistiwi@gmail.com', NULL, '$2y$12$9BDmWFieQDl6g/LI1io2iukFGj3KoGIXmCqhVmCvCIgZxtBjZSoyK', 'customer', NULL, '2026-08-03 07:48:51', '2026-08-03 07:48:51'),
(2, 'Admin', 'admin@peakpack', NULL, '$2y$12$i4UfP7wxPxGUzRM8v6zNo.7bbSCaVs4tWAXwIiIaKPvFS.H0lIwVC', 'admin', NULL, '2026-08-03 23:05:36', '2026-08-03 23:05:36'),
(3, 'Admin Frega', 'admin@peakpack.test', NULL, '$2y$12$C0NFNqCz6KDE69bnVA/8aOHmeJM2Fek82wP1UZO7reOgqANnms5Zi', 'admin', NULL, '2026-08-03 23:14:55', '2026-08-03 23:14:55'),
(5, 'Frega Teguh Dwiguna', 'dwigunafrega88@gmail.com', NULL, '$2y$12$YasTaPVADYpn8cvcMfYtcOWubylWV5a3ElL2CohXlDE54QoYPbndi', 'customer', NULL, '2026-08-28 23:27:15', '2026-08-28 23:27:15'),
(6, 'Bagas Tubagas', 'cursorrandom91@gmail.com', NULL, '$2y$12$EPedtuaYUovaTHISzlwDW.rjSfzROcaL9rJ68WO2QIv8IJbNVtJte', 'customer', NULL, '2026-08-31 21:55:57', '2026-08-31 21:55:57'),
(7, 'Agus Muhammad', 'gus@gmail.com', NULL, '$2y$12$HxHQByVaYIB29D8Rqw.6G.3MtuWrD3X1Y6Tc9zLpFUPrvNxFks.2a', 'customer', NULL, '2026-09-02 05:22:48', '2026-09-02 05:22:48');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `gears`
--
ALTER TABLE `gears`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gears_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `gear_categories`
--
ALTER TABLE `gear_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mountains`
--
ALTER TABLE `mountains`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mountain_recommendations`
--
ALTER TABLE `mountain_recommendations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `mountain_recommendations_mountain_id_gear_id_unique` (`mountain_id`,`gear_id`),
  ADD KEY `mountain_recommendations_gear_id_foreign` (`gear_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `rentals_rental_code_unique` (`rental_code`),
  ADD KEY `rentals_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `rental_items`
--
ALTER TABLE `rental_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_items_rental_id_foreign` (`rental_id`),
  ADD KEY `rental_items_gear_id_foreign` (`gear_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `gears`
--
ALTER TABLE `gears`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `gear_categories`
--
ALTER TABLE `gear_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `mountains`
--
ALTER TABLE `mountains`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `mountain_recommendations`
--
ALTER TABLE `mountain_recommendations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `rental_items`
--
ALTER TABLE `rental_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `gears`
--
ALTER TABLE `gears`
  ADD CONSTRAINT `gears_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `gear_categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `mountain_recommendations`
--
ALTER TABLE `mountain_recommendations`
  ADD CONSTRAINT `mountain_recommendations_gear_id_foreign` FOREIGN KEY (`gear_id`) REFERENCES `gears` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `mountain_recommendations_mountain_id_foreign` FOREIGN KEY (`mountain_id`) REFERENCES `mountains` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rental_items`
--
ALTER TABLE `rental_items`
  ADD CONSTRAINT `rental_items_gear_id_foreign` FOREIGN KEY (`gear_id`) REFERENCES `gears` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rental_items_rental_id_foreign` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
