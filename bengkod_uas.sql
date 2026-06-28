-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jun 2026 pada 12.37
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
-- Database: `bengkod_uas`
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
-- Struktur dari tabel `detail_periksas`
--

CREATE TABLE `detail_periksas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_periksa` bigint(20) UNSIGNED NOT NULL,
  `id_obat` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokters`
--

CREATE TABLE `dokters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `poli_id` bigint(20) UNSIGNED NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `dokters`
--

INSERT INTO `dokters` (`id`, `user_id`, `nama`, `poli_id`, `alamat`, `created_at`, `updated_at`) VALUES
(1, 2, 'levi', 3, 'semarang', '2025-06-29 15:23:54', '2025-06-29 15:23:54');

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
-- Struktur dari tabel `jadwal_periksas`
--

CREATE TABLE `jadwal_periksas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dokter_id` bigint(20) UNSIGNED NOT NULL,
  `hari` varchar(255) NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_selesai` time NOT NULL,
  `is_aktif` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `jadwal_periksas`
--

INSERT INTO `jadwal_periksas` (`id`, `dokter_id`, `hari`, `jam_mulai`, `jam_selesai`, `is_aktif`, `created_at`, `updated_at`) VALUES
(1, 1, 'Senin', '07:00:00', '10:00:00', 1, '2025-06-29 15:25:52', '2025-06-29 15:26:13');

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
(4, '2025_03_24_075511_create_obats_table', 1),
(5, '2025_06_24_035138_create_polis_table', 1),
(6, '2025_06_24_035554_create_dokters_table', 1),
(7, '2025_06_24_035621_create_pasiens_table', 1),
(8, '2025_06_24_064308_create_jadwal_periksas_table', 1),
(9, '2025_06_24_075511_create_periksas_table', 1),
(10, '2025_06_24_075512_create_detail_periksas_table', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `obats`
--

CREATE TABLE `obats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_obat` varchar(50) NOT NULL,
  `kemasan` varchar(35) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `stok_minimum` int(11) NOT NULL DEFAULT 5,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `obats`
--

INSERT INTO `obats` (`id`, `nama_obat`, `kemasan`, `harga`, `stok`, `stok_minimum`, `created_at`, `updated_at`) VALUES
(1, 'Paracetamol', 'Tablet 500mg', 5000, 50, 5, '2025-06-29 15:21:49', '2025-06-29 15:21:49'),
(2, 'Amoxicillin', 'Kapsul 250mg', 8000, 50, 5, '2025-06-29 15:21:49', '2025-06-29 15:21:49'),
(3, 'Antasida', 'Sirup 60ml', 10000, 50, 5, '2025-06-29 15:21:49', '2025-06-29 15:21:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasiens`
--

CREATE TABLE `pasiens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(50) NOT NULL,
  `no_rm` varchar(255) NOT NULL,
  `no_ktp` varchar(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `pasiens`
--

INSERT INTO `pasiens` (`id`, `user_id`, `nama`, `alamat`, `no_hp`, `no_rm`, `no_ktp`, `created_at`, `updated_at`) VALUES
(1, 3, 'idat', 'grobogan', '072687341763', '202506-1', '331910291738137', '2025-06-29 15:24:30', '2025-06-29 15:24:30');

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
-- Struktur dari tabel `periksas`
--

CREATE TABLE `periksas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_pasien` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal` bigint(20) UNSIGNED NOT NULL,
  `tgl_periksa` datetime NOT NULL,
  `keluhan` text DEFAULT NULL,
  `catatan_dokter` text DEFAULT NULL,
  `biaya_periksa` int(11) NOT NULL DEFAULT 0,
  `nomor_antrian` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'menunggu',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `periksas`
--

INSERT INTO `periksas` (`id`, `id_pasien`, `id_jadwal`, `tgl_periksa`, `keluhan`, `catatan_dokter`, `biaya_periksa`, `nomor_antrian`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 1, '2025-06-29 22:26:57', 'pusing', 'gausah kakean obat sapi', 150000, 1, 'selesai', '2025-06-29 15:26:57', '2025-06-30 08:00:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `polis`
--

CREATE TABLE `polis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `polis`
--

INSERT INTO `polis` (`id`, `nama`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Poli Umum', NULL, NULL, NULL),
(2, 'Poli Gigi', NULL, NULL, NULL),
(3, 'Poli Anak', NULL, NULL, NULL),
(4, 'poli jiwa', '-', '2025-06-30 07:51:07', '2025-06-30 07:51:07');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `no_hp` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','dokter','pasien') NOT NULL DEFAULT 'pasien',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nama`, `alamat`, `no_hp`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Jl. Admin No.1', '081234567890', 'admin@example.com', '$2y$12$m4wXkC6KvlPll5vqetCvbOD4kwxMnwtZ3hHVlzj7U5B09iwwHgUna', 'admin', '2025-06-29 15:21:49', '2025-06-29 15:21:49'),
(2, 'levi', 'semarang', '0806042005', 'levi@gmail.com', '$2y$12$nwKr8kDPbihsxBWj.fASYeTOcVYwfQ7fAkTwpyMnDwq9WAdebIUYG', 'dokter', '2025-06-29 15:23:54', '2025-06-29 15:23:54'),
(3, 'messi', 'tegal', '072687341763', 'messi@example.com', '$2y$12$REH3UOL9VM3jr2xXVxOFo.lrwj1kHWN3M.yKLf71GIYr8krJyT/7O', 'pasien', '2025-06-29 15:24:30', '2025-06-29 15:24:30');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `detail_periksas`
--
ALTER TABLE `detail_periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_periksas_id_periksa_foreign` (`id_periksa`),
  ADD KEY `detail_periksas_id_obat_foreign` (`id_obat`);

--
-- Indeks untuk tabel `dokters`
--
ALTER TABLE `dokters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dokters_user_id_foreign` (`user_id`),
  ADD KEY `dokters_poli_id_foreign` (`poli_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwal_periksas_dokter_id_foreign` (`dokter_id`);

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
-- Indeks untuk tabel `obats`
--
ALTER TABLE `obats`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pasiens_no_hp_unique` (`no_hp`),
  ADD UNIQUE KEY `pasiens_no_rm_unique` (`no_rm`),
  ADD UNIQUE KEY `pasiens_no_ktp_unique` (`no_ktp`),
  ADD KEY `pasiens_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `periksas`
--
ALTER TABLE `periksas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `periksas_id_pasien_foreign` (`id_pasien`),
  ADD KEY `periksas_id_jadwal_foreign` (`id_jadwal`);

--
-- Indeks untuk tabel `polis`
--
ALTER TABLE `polis`
  ADD PRIMARY KEY (`id`);

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
  ADD UNIQUE KEY `users_no_hp_unique` (`no_hp`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_periksas`
--
ALTER TABLE `detail_periksas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `dokters`
--
ALTER TABLE `dokters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT untuk tabel `obats`
--
ALTER TABLE `obats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `periksas`
--
ALTER TABLE `periksas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `polis`
--
ALTER TABLE `polis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_periksas`
--
ALTER TABLE `detail_periksas`
  ADD CONSTRAINT `detail_periksas_id_obat_foreign` FOREIGN KEY (`id_obat`) REFERENCES `obats` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_periksas_id_periksa_foreign` FOREIGN KEY (`id_periksa`) REFERENCES `periksas` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `dokters`
--
ALTER TABLE `dokters`
  ADD CONSTRAINT `dokters_poli_id_foreign` FOREIGN KEY (`poli_id`) REFERENCES `polis` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `dokters_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `jadwal_periksas`
--
ALTER TABLE `jadwal_periksas`
  ADD CONSTRAINT `jadwal_periksas_dokter_id_foreign` FOREIGN KEY (`dokter_id`) REFERENCES `dokters` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pasiens`
--
ALTER TABLE `pasiens`
  ADD CONSTRAINT `pasiens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `periksas`
--
ALTER TABLE `periksas`
  ADD CONSTRAINT `periksas_id_jadwal_foreign` FOREIGN KEY (`id_jadwal`) REFERENCES `jadwal_periksas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `periksas_id_pasien_foreign` FOREIGN KEY (`id_pasien`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
