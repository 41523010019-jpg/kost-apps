-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 18 Des 2025 pada 08.34
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
-- Database: `laravel_kos`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `abouts`
--

INSERT INTO `abouts` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Tentang Kos', 'Kos Harmoni menyediakan kamar bersih, fasilitas lengkap, dan suasana yang nyaman. Lokasi dekat kampus, minimarket, dan transportasi umum.', '2025-12-16 00:25:26', '2025-12-16 00:26:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `bookings`
--

CREATE TABLE `bookings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `next_billing_date` date DEFAULT NULL,
  `status` enum('pending','active','expired') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `start_date`, `next_billing_date`, `status`, `created_at`, `updated_at`) VALUES
(89, 4, 6, '2025-12-17', '2026-02-17', 'expired', '2025-12-17 06:15:26', '2025-12-17 06:22:07'),
(90, 3, 6, '2025-12-17', '2026-02-17', 'expired', '2025-12-17 06:30:53', '2025-12-17 06:31:56'),
(91, 1, 6, '2025-12-17', '2026-02-17', 'expired', '2025-12-17 07:36:16', '2025-12-17 07:48:00'),
(92, 1, 7, '2025-12-17', '2026-02-17', 'active', '2025-12-17 07:39:03', '2025-12-17 07:48:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_midtrans_config', 'a:3:{s:10:\"server_key\";s:38:\"SB-Mid-server-0JoB8W9re_zRokVN7Enkc4MY\";s:10:\"client_key\";s:30:\"SB-Mid-client-Unb4qzXJkE5kgcy1\";s:13:\"is_production\";b:0;}', 1765982581);

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
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Gold', 'gold', '2025-12-03 19:17:23', '2025-12-03 19:17:23'),
(2, 'Basic', 'basic', '2025-12-03 19:17:29', '2025-12-03 19:17:29'),
(3, 'Premium', 'premium', '2025-12-03 19:17:34', '2025-12-03 19:17:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL DEFAULT 'Hubungi Kami',
  `description` text DEFAULT NULL,
  `address` text NOT NULL,
  `address_note` text DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `phone_note` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `map_embed` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `contacts`
--

INSERT INTO `contacts` (`id`, `title`, `description`, `address`, `address_note`, `phone`, `phone_note`, `email`, `map_embed`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kontak Kos Harmoni Edit', 'Aplikasi Kos', 'Sidomulyo, Wonosalam, Demak', 'Jl. Janoko no.17 A Kompleks C12', '081515815176', '081515815176', 'adminkos@gmail.com', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126715.84305079783!2d110.3346620255009!3d-7.024552222860721!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e708b4d3f0d024d%3A0x1e0432b9da5cb9f2!2sKota%20Semarang%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1765982734629!5m2!1sid!2sid\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 1, '2025-12-17 00:51:39', '2025-12-17 07:45:44');

-- --------------------------------------------------------

--
-- Struktur dari tabel `facilities`
--

CREATE TABLE `facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `icon` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Wifi Cepat', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-wifi-icon lucide-wifi\"><path d=\"M12 20h.01\"/><path d=\"M2 8.82a15 15 0 0 1 20 0\"/><path d=\"M5 12.859a10 10 0 0 1 14 0\"/><path d=\"M8.5 16.429a5 5 0 0 1 7 0\"/></svg>', '2025-12-16 23:51:27', '2025-12-16 23:56:09'),
(2, 'Kasur & Lemari', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-bed-icon lucide-bed\"><path d=\"M2 4v16\"/><path d=\"M2 8h18a2 2 0 0 1 2 2v10\"/><path d=\"M2 17h20\"/><path d=\"M6 8v9\"/></svg>', '2025-12-16 23:51:50', '2025-12-16 23:56:27'),
(3, 'Kamar Mandi Dalam', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shower-head-icon lucide-shower-head\"><path d=\"m4 4 2.5 2.5\"/><path d=\"M13.5 6.5a4.95 4.95 0 0 0-7 7\"/><path d=\"M15 5 5 15\"/><path d=\"M14 17v.01\"/><path d=\"M10 16v.01\"/><path d=\"M13 13v.01\"/><path d=\"M16 10v.01\"/><path d=\"M11 20v.01\"/><path d=\"M17 14v.01\"/><path d=\"M20 11v.01\"/></svg>', '2025-12-16 23:52:03', '2025-12-16 23:56:53'),
(4, 'Parkir Luas', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-square-parking-icon lucide-square-parking\"><rect width=\"18\" height=\"18\" x=\"3\" y=\"3\" rx=\"2\"/><path d=\"M9 17V7h4a3 3 0 0 1 0 6H9\"/></svg>', '2025-12-16 23:52:16', '2025-12-16 23:57:19'),
(5, 'CCTV 24 Jam', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-cctv-icon lucide-cctv\"><path d=\"M16.75 12h3.632a1 1 0 0 1 .894 1.447l-2.034 4.069a1 1 0 0 1-1.708.134l-2.124-2.97\"/><path d=\"M17.106 9.053a1 1 0 0 1 .447 1.341l-3.106 6.211a1 1 0 0 1-1.342.447L3.61 12.3a2.92 2.92 0 0 1-1.3-3.91L3.69 5.6a2.92 2.92 0 0 1 3.92-1.3z\"/><path d=\"M2 19h3.76a2 2 0 0 0 1.8-1.1L9 15\"/><path d=\"M2 21v-4\"/><path d=\"M7 9h.01\"/></svg>', '2025-12-16 23:52:29', '2025-12-16 23:58:02'),
(6, 'One Gate System', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-brick-wall-shield-icon lucide-brick-wall-shield\"><path d=\"M12 9v1.258\"/><path d=\"M16 3v5.46\"/><path d=\"M21 9.118V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h5.75\"/><path d=\"M22 17.5c0 2.499-1.75 3.749-3.83 4.474a.5.5 0 0 1-.335-.005c-2.085-.72-3.835-1.97-3.835-4.47V14a.5.5 0 0 1 .5-.499c1 0 2.25-.6 3.12-1.36a.6.6 0 0 1 .76-.001c.875.765 2.12 1.36 3.12 1.36a.5.5 0 0 1 .5.5z\"/><path d=\"M3 15h7\"/><path d=\"M3 9h12.142\"/><path d=\"M8 15v6\"/><path d=\"M8 3v6\"/></svg>', '2025-12-16 23:52:41', '2025-12-16 23:57:51'),
(7, 'Security 24 Jam', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-shield-icon lucide-shield\"><path d=\"M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z\"/></svg>', '2025-12-16 23:52:54', '2025-12-16 23:57:35'),
(8, 'Pembayaran Online', '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" class=\"lucide lucide-hand-coins-icon lucide-hand-coins\"><path d=\"M11 15h2a2 2 0 1 0 0-4h-3c-.6 0-1.1.2-1.4.6L3 17\"/><path d=\"m7 21 1.6-1.4c.3-.4.8-.6 1.4-.6h4c1.1 0 2.1-.4 2.8-1.2l4.6-4.4a2 2 0 0 0-2.75-2.91l-4.2 3.9\"/><path d=\"m2 16 6 6\"/><circle cx=\"16\" cy=\"9\" r=\"2.9\"/><circle cx=\"6\" cy=\"5\" r=\"3\"/></svg>', '2025-12-16 23:54:47', '2025-12-16 23:55:16');

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
-- Struktur dari tabel `heroes`
--

CREATE TABLE `heroes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `heroes`
--

INSERT INTO `heroes` (`id`, `image`, `order`, `created_at`, `updated_at`) VALUES
(1, 'heroes/3cIRRnQtuXHpoCGOq2yyCY2buzp5uhi57OJITtDs.png', 1, '2025-12-03 19:31:00', '2025-12-03 19:31:00'),
(2, 'heroes/or72InL7A7FX2qkjWCWQ5tmE1qKFc9KC5Nm4zJKv.png', 2, '2025-12-03 19:31:32', '2025-12-03 19:31:32'),
(3, 'heroes/BiYJmDiDnUNIRUzjFnIGGyq2dXwr7QlS9jfWgm4M.png', 3, '2025-12-03 19:32:09', '2025-12-03 19:32:09');

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
(4, '2025_12_02_160331_create_permission_tables', 1),
(5, '2025_12_02_160803_add_extra_fields_to_users_table', 1),
(6, '2025_12_02_161859_create_categories_table', 1),
(7, '2025_12_02_164153_create_rooms_table', 1),
(8, '2025_12_02_164358_create_room_photos_table', 1),
(9, '2025_12_03_012401_create_price_packages_table', 1),
(10, '2025_12_03_045219_create_heroes_table', 1),
(11, '2025_12_03_064645_create_bookings_table', 1),
(12, '2025_12_03_090716_create_monthly_bills_table', 1),
(13, '2025_12_03_090809_create_payments_table', 1),
(14, '2025_12_16_045939_create_payment_gateways_table', 2),
(15, '2025_12_16_071818_create_abouts_table', 3),
(16, '2025_12_17_064009_create_facilities_table', 4),
(17, '2025_12_17_065039_alter_icon_column_on_facilities_table', 5),
(18, '2025_12_17_065929_create_contacts_table', 6),
(19, '2025_12_17_080018_create_web_settings_table', 7);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 2),
(2, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 3),
(2, 'App\\Models\\User', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `monthly_bills`
--

CREATE TABLE `monthly_bills` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(11) NOT NULL,
  `due_date` date NOT NULL,
  `status` enum('pending','paid','unpaid') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `monthly_bills`
--

INSERT INTO `monthly_bills` (`id`, `booking_id`, `amount`, `due_date`, `status`, `created_at`, `updated_at`) VALUES
(171, 89, 500000, '2025-12-17', 'paid', '2025-12-17 06:15:26', '2025-12-17 06:15:39'),
(172, 89, 500000, '2026-01-17', 'unpaid', '2025-12-17 06:15:42', '2025-12-17 06:15:42'),
(173, 90, 500000, '2025-12-17', 'paid', '2025-12-17 06:30:53', '2025-12-17 06:31:18'),
(174, 90, 500000, '2026-01-17', 'unpaid', '2025-12-17 06:31:20', '2025-12-17 06:31:20'),
(175, 91, 500000, '2025-12-17', 'paid', '2025-12-17 07:36:16', '2025-12-17 07:36:36'),
(176, 91, 500000, '2026-01-17', 'unpaid', '2025-12-17 07:36:41', '2025-12-17 07:36:41'),
(177, 92, 750000, '2025-12-17', 'paid', '2025-12-17 07:39:03', '2025-12-17 07:39:25'),
(178, 92, 750000, '2026-01-17', 'unpaid', '2025-12-17 07:39:25', '2025-12-17 07:39:25');

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
-- Struktur dari tabel `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `booking_id` bigint(20) UNSIGNED NOT NULL,
  `bill_id` bigint(20) UNSIGNED DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `method` enum('cash','midtrans') NOT NULL,
  `order_id` varchar(255) DEFAULT NULL,
  `transaction_status` varchar(255) DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payments`
--

INSERT INTO `payments` (`id`, `booking_id`, `bill_id`, `amount`, `method`, `order_id`, `transaction_status`, `snap_token`, `paid_at`, `created_at`, `updated_at`) VALUES
(139, 89, 171, 500000, 'midtrans', 'KOS-171-1765977326', 'cancelled', 'c5e77991-0245-4d4f-beea-24cfae7fdb8a', NULL, '2025-12-17 06:15:26', '2025-12-17 06:22:07'),
(140, 90, 173, 500000, 'midtrans', 'KOS-173-1765978253', 'cancelled', 'de02ea4b-d56a-4143-8aa7-f7c56ef20844', NULL, '2025-12-17 06:30:54', '2025-12-17 06:31:56'),
(141, 90, 174, 500000, 'midtrans', 'BOOKING-174-1765978290', 'cancelled', 'b517477f-1718-49d4-bf8e-9cf4049f02e5', NULL, '2025-12-17 06:31:31', '2025-12-17 06:31:56'),
(142, 91, 175, 500000, 'midtrans', 'KOS-175-1765982176', 'cancelled', '869ae920-9463-4110-955d-39810342a3a6', NULL, '2025-12-17 07:36:17', '2025-12-17 07:48:00'),
(143, 91, 176, 500000, 'midtrans', 'BOOKING-176-1765982282', 'cancelled', '8df01792-9fbd-4703-8bf4-18e80d9dc8c0', NULL, '2025-12-17 07:38:02', '2025-12-17 07:48:00'),
(144, 92, 177, 750000, 'cash', 'CASH-177', 'cancelled', NULL, NULL, '2025-12-17 07:39:03', '2025-12-17 07:48:00'),
(145, 92, 178, 750000, 'midtrans', 'BOOKING-178-1765982378', 'cancelled', '265b65fa-f29d-42e5-bbc0-83119a101929', NULL, '2025-12-17 07:39:39', '2025-12-17 07:48:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `payment_gateways`
--

CREATE TABLE `payment_gateways` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `payment_gateways`
--

INSERT INTO `payment_gateways` (`id`, `gateway`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'midtrans', 'MIDTRANS_SERVER_KEY', 'SB-Mid-server-0JoB8W9re_zRokVN7Enkc4MY', '2025-12-15 23:21:36', '2025-12-15 23:37:34'),
(2, 'midtrans', 'MIDTRANS_CLIENT_KEY', 'SB-Mid-client-Unb4qzXJkE5kgcy1', '2025-12-15 23:21:36', '2025-12-15 23:54:59'),
(3, 'midtrans', 'MIDTRANS_IS_PRODUCTION', '0', '2025-12-15 23:21:36', '2025-12-16 00:04:01');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `price_packages`
--

CREATE TABLE `price_packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `price_per_month` int(11) NOT NULL,
  `facilities` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`facilities`)),
  `is_popular` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `price_packages`
--

INSERT INTO `price_packages` (`id`, `category_id`, `price_per_month`, `facilities`, `is_popular`, `created_at`, `updated_at`) VALUES
(1, 2, 450000, '[\"Kasur & Lemari\",\"Kamar mandi luar\",\"Akses WiFi normal\",\"Kebersihan mingguan\"]', 0, '2025-12-03 19:19:12', '2025-12-03 19:19:12'),
(2, 1, 500000, '[\"Kasur premium & lemari besar\",\"Kamar mandi dalam\",\"WiFi cepat 50 Mbps\",\"Kebersihan 2x seminggu\",\"Meja belajar\"]', 1, '2025-12-03 19:19:44', '2025-12-03 19:19:44'),
(3, 3, 750000, '[\"Tempat tidur premium\",\"AC + kamar mandi dalam\",\"WiFi super cepat 100 Mbps\",\"Kebersihan harian\",\"Smart TV\"]', 0, '2025-12-03 19:20:30', '2025-12-17 07:41:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'web', '2025-12-03 19:16:50', '2025-12-03 19:16:50'),
(2, 'user', 'web', '2025-12-03 19:16:50', '2025-12-03 19:16:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `is_available` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `category_id`, `name`, `price`, `is_available`, `description`, `created_at`, `updated_at`) VALUES
(2, 1, 'Kamar A1', 500000, 0, 'Ready Kamar A1', '2025-12-03 19:21:44', '2025-12-15 21:22:58'),
(3, 2, 'Kamar A2', 450000, 0, 'Ready Kamar A2', '2025-12-03 19:22:04', '2025-12-15 21:11:39'),
(4, 1, 'Kamar A3', 700000, 0, 'Ready Kamar A3', '2025-12-03 19:22:26', '2025-12-15 21:20:32'),
(5, 2, 'Kamar A4', 400000, 0, 'Ready Kamar A4', '2025-12-03 19:23:04', '2025-12-15 21:29:33'),
(6, 1, 'Kamar A5', 500000, 1, 'Ready Kamar A5', '2025-12-03 19:23:24', '2025-12-17 07:48:00'),
(7, 3, 'Kamar A6', 750000, 1, 'Ready Kamar A6', '2025-12-03 19:23:48', '2025-12-17 07:48:00'),
(8, 1, 'Kamar A7', 500000, 1, 'Kamar Ready', '2025-12-03 20:55:42', '2025-12-15 21:10:55'),
(9, 3, 'Kamar A8', 750000, 1, 'Ready', '2025-12-03 20:56:11', '2025-12-17 01:25:19');

-- --------------------------------------------------------

--
-- Struktur dari tabel `room_photos`
--

CREATE TABLE `room_photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `room_id` bigint(20) UNSIGNED NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `room_photos`
--

INSERT INTO `room_photos` (`id`, `room_id`, `path`, `created_at`, `updated_at`) VALUES
(1, 2, 'room_photos/dLlOeu4YKCcvM5iyfM1HDDnBwIUXE3Kcqte57PR9.png', '2025-12-03 19:21:44', '2025-12-03 19:21:44'),
(3, 4, 'room_photos/ujjoRUBGO9Eli7pLK9xztoIkosEGFi88m3IqOLKO.png', '2025-12-03 19:22:26', '2025-12-03 19:22:26'),
(4, 5, 'room_photos/3fTDCIdI8Bjy3JI9ucL5K6FN0ADx3FmoILYYk8eC.png', '2025-12-03 19:23:04', '2025-12-03 19:23:04'),
(5, 6, 'room_photos/IithWxJ8IOVSCmldKN9zmYy493VVP3rLu1wrDdYa.png', '2025-12-03 19:23:24', '2025-12-03 19:23:24'),
(6, 7, 'room_photos/NYmElpfdgMbxxlFwBTqYQnTS1CDhxmzilBLSVRXz.png', '2025-12-03 19:23:48', '2025-12-03 19:23:48'),
(7, 3, 'room_photos/2yiep5UEK0jab3wwmrVuJV1Zi5qeeJQbpqgRgWVf.png', '2025-12-03 20:03:33', '2025-12-03 20:03:33'),
(8, 3, 'room_photos/xnxpVTf9LRR7AQbwdUYChcKowILabgwucjgdpkry.png', '2025-12-03 20:03:33', '2025-12-03 20:03:33'),
(9, 3, 'room_photos/RIlbyselRRxNWSF5ANAWM2oJE1WhGMsuMrIZAqmh.png', '2025-12-03 20:03:34', '2025-12-03 20:03:34'),
(10, 3, 'room_photos/RrMadR40HdhFnDn6sW8htWJ9XfXkf3u0NklxZNjT.png', '2025-12-03 20:03:34', '2025-12-03 20:03:34'),
(11, 3, 'room_photos/dqbEZ3SE3m4Ms1khXFLz8PRad7UlC9lK6n59pjsF.png', '2025-12-03 20:03:34', '2025-12-03 20:03:34'),
(12, 3, 'room_photos/47I7wfANY7rE0BAADtZ4k7uCplffv9j414s2wCvZ.png', '2025-12-03 20:03:34', '2025-12-03 20:03:34'),
(13, 3, 'room_photos/3KyEiABbWRPdEZ05ZhdltOD0JsrcQjP1IpzBQkqJ.png', '2025-12-03 20:03:34', '2025-12-03 20:03:34'),
(14, 3, 'room_photos/62HYUF29JgB2evA50iixMMMs39MTbemILYoIQsx6.png', '2025-12-03 20:03:34', '2025-12-03 20:03:34'),
(15, 3, 'room_photos/5IppQhj2oFwLRR5qXDW03IIVrxt7qlVinOd23MD1.png', '2025-12-03 20:03:34', '2025-12-03 20:03:34'),
(16, 8, 'room_photos/KGoCBWWEw8xn5TJX37TrThvt1rPCdM855TuS2bHh.png', '2025-12-03 20:55:42', '2025-12-03 20:55:42'),
(17, 9, 'room_photos/FDe2ZVyTnHDWdxpicraKCfYOYzsj6EvvM84Wb39D.png', '2025-12-03 20:56:11', '2025-12-03 20:56:11');

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
('2cdQDN4CqtuUFkfAm7NMXsMOxWbcQS0B3HMDWggn', 4, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiOVQzRDB3cTRJOWVMRkZZc0RUeFZKbDRBV25TS0tHMkxFdm1wV1JZaiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO3M6NToicm91dGUiO3M6OToiZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6NDt9', 1765975959),
('4aLaje5ucDfl7lBsibZd6WcVnyDl3E1XN1O0gZZF', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoielF6OXVyU3dxWGlOd3QxMENrSW1mc2NhQ0V2YjVvWGl6OTlyczBmeCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765978278),
('akrG0PiblYPnded5H0wdZsI4ga460fEHqm26hbym', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQjNsamo3cnI2TzRZUEhnWHlRUHFBOWVnMHdQVlh3VE5YQmRJQjZUSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9pbnZvaWNlLzE3NyI7czo1OiJyb3V0ZSI7czoxNjoiaW52b2ljZS5nZW5lcmF0ZSI7fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1765984800),
('dWOymLmie8tNousJXDfgGD3uFbdcnkifGMhnRVJU', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiR0hsbWVSRnFKREtYbjFpSEZGU2hDNjlRTU9UQldIVlNPT0hkNGpLQyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765977339),
('ebt4fEBJm5emDgwh95Tyo1jrrgxAuiqpsuIDYpT8', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiRTNyc0RoUjRiU0Y5Tmg3MlhaMTBQOVM0WllJYW5EeFBTQmJpdENtaSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765977333),
('IVxnf60EDKGZwRtEG7gZn7cyp1xhGSRCOz6QjgdA', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiT3MxM2JRUjRncmNNUGZGVUlhR2VQQTVjQlhsT3RmR256VmFJcmJvRyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765978260),
('kWt3uWwaGbF3RI9LFCLdFtHUsnDNvdlPReQPsPav', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoicVJPUlhNaDB4YXZNeGVOVmpHRUhvSnBjTFVxOHdSeFViVHFqWHF4TiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765982191),
('MvJBxIk9YuPZNNWLRVQlp3AdR4w3Svf4JcJN0IKd', NULL, '127.0.0.1', 'Veritrans', 'YToyOntzOjY6Il90b2tlbiI7czo0MDoiQ05CRFNONXFJWE9VaXZwb1VkUGpZVlhzVnJxYnpsOER0YzJoRTAydSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765982196),
('QDaJyVji4wHIUJwqJ98fD4weNq8rUs5C0rjqmc6S', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoibFVRTnluejk4cFh1ekduMWZzWG9FaWtiSFZiSUdOd0NEc25UMTRpcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly9hOTU2Y2M0YmRkZjEubmdyb2stZnJlZS5hcHAiO3M6NToicm91dGUiO3M6NDoiaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1765980958),
('rJqSjJ7NK6vxou44K1W8xyTN38gamNlnqVtTQ9J4', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiWlFPcnhlS1lRWkJVMHkyeXNIVGpKeVVpM3NhRUh3Z1dPTjFLQmJmWSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9sb2dpbiI7czo1OiJyb3V0ZSI7czo1OiJsb2dpbiI7fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6MzE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9kYXNoYm9hcmQiO319', 1765980431),
('s0yv7Ttm4fOWEsoJC2bzhzYM4a6cXi8436m3AcmB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMjFOUmVnZ3pxZXU0V1lFNjJRWWlWd2d4ODhMQmc0QllGQWpkb1R1NiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1765982892),
('TCOfwNUx3hjOhoMJvKKIVcBOXBxaAPhPOlUqcJFA', NULL, '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 18_5 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/18.5 Mobile/15E148 Safari/604.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiYndtZ0l5VWdMVnJVem5uazVHTW01S3BkWE9DME1URUNxUmtNV2lnVSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765980541);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `gender` enum('male','female') DEFAULT NULL,
  `address` text DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `gender`, `address`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hasan', 'hasan@mail.com', '081515815176', 'female', NULL, '2025-12-03 02:14:35', '$2y$12$SGxY8TeZXO/Yc9dyrsOsF.dcWDsfV1YBBxbpq/OvXaO2hwln8u5uC', '3CfiwyAbmZ', '2025-12-03 02:14:36', '2025-12-17 06:06:16'),
(2, 'Kurnia Andi Nugroho', 'admin@example.com', '081515815176', 'male', NULL, NULL, '$2y$12$zH00.4DvJZZIkLJo4pY7rejXz2gb9jTzvF30J4W4ckQrkq3ToC9ca', NULL, '2025-12-03 19:16:50', '2025-12-17 06:05:00'),
(3, 'Yohan', 'yohan@mail.com', '081515815176', 'male', 'JL. GEMAH SARI V NO. 185 RT 01/RW 04, DESA/KEL. KEDUNGMUNDU, KEC. TEMBALANG, KOTA SEMARANG', NULL, '$2y$12$5Ihwo04DJfbYAFNz1eN.5exEpkhC8kgF1V9Z7pUByR/.zl1TYnmJS', NULL, '2025-12-03 19:16:51', '2025-12-17 06:36:59'),
(4, 'Farhan', 'farhan@mail.com', '081515815176', 'male', 'demak\njawa tengah', NULL, '$2y$12$.a0fQPpMIWK9vkJ4/inaHuHMDgi79/wge0YqovmUXzW7BnxRzmiMC', NULL, '2025-12-17 05:37:17', '2025-12-17 06:05:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `web_settings`
--

CREATE TABLE `web_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(255) NOT NULL,
  `site_description` text DEFAULT NULL,
  `social_media` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`social_media`)),
  `copyright` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `web_settings`
--

INSERT INTO `web_settings` (`id`, `site_title`, `site_description`, `social_media`, `copyright`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Kos Harmoni', 'Kos Harmoni menyediakan hunian nyaman, aman, dan strategis \ndekat kampus dengan fasilitas lengkap dan harga terjangkau.\n', '{\"instagram\":\"https:\\/\\/instagram.com\\/kosharmoni\",\"facebook\":\"https:\\/\\/facebook.com\\/kosharmoni\",\"whatsapp\":\"https:\\/\\/wa.me\\/6281234567890\",\"email\":\"mailto:kosharmoni@gmail.com\"}', '© 2025 Kos Harmoni. All rights reserved.', 1, '2025-12-17 01:12:18', '2025-12-17 01:13:51');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bookings_user_id_foreign` (`user_id`),
  ADD KEY `bookings_room_id_foreign` (`room_id`);

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
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `heroes`
--
ALTER TABLE `heroes`
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
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `monthly_bills`
--
ALTER TABLE `monthly_bills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `monthly_bills_booking_id_foreign` (`booking_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_booking_id_foreign` (`booking_id`),
  ADD KEY `payments_bill_id_foreign` (`bill_id`);

--
-- Indeks untuk tabel `payment_gateways`
--
ALTER TABLE `payment_gateways`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `payment_gateways_gateway_key_unique` (`gateway`,`key`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `price_packages`
--
ALTER TABLE `price_packages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `price_packages_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rooms_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `room_photos`
--
ALTER TABLE `room_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_photos_room_id_foreign` (`room_id`);

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
-- Indeks untuk tabel `web_settings`
--
ALTER TABLE `web_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `heroes`
--
ALTER TABLE `heroes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `monthly_bills`
--
ALTER TABLE `monthly_bills`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=179;

--
-- AUTO_INCREMENT untuk tabel `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT untuk tabel `payment_gateways`
--
ALTER TABLE `payment_gateways`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `price_packages`
--
ALTER TABLE `price_packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `room_photos`
--
ALTER TABLE `room_photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `web_settings`
--
ALTER TABLE `web_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `monthly_bills`
--
ALTER TABLE `monthly_bills`
  ADD CONSTRAINT `monthly_bills_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `monthly_bills` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_booking_id_foreign` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `price_packages`
--
ALTER TABLE `price_packages`
  ADD CONSTRAINT `price_packages_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `room_photos`
--
ALTER TABLE `room_photos`
  ADD CONSTRAINT `room_photos_room_id_foreign` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
