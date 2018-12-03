-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Okt 2018 pada 05.17
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_roombooking`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `name` varchar(125) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `unit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `areas`
--

INSERT INTO `areas` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`, `unit_id`) VALUES
(63, 'Area Lantai 2', 'Area Perunggu', '2018-09-19 07:01:37', '2018-09-19 07:53:15', NULL, 62),
(64, 'Area Lantai 6', 'Area Perak', '2018-09-19 07:01:56', '2018-09-19 07:40:28', NULL, 62),
(65, 'Area Lantai 10', 'Area Emas', '2018-09-19 07:02:16', '2018-09-19 07:53:50', NULL, 62),
(66, 'Area Lantai 14', 'Area Palladium', '2018-09-19 07:03:44', '2018-09-19 07:42:14', NULL, 62),
(67, 'Area Lantai 16', 'Area Platinum', '2018-09-19 07:04:04', '2018-09-19 07:42:39', NULL, 62);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_09_03_100900_entrust_setup_tables', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(5, 'role-list', 'Display Role Listing', 'See only Listing Of Role', '2018-09-05 00:05:06', '2018-09-05 00:05:06'),
(6, 'role-create', 'Create Role', 'Create New Role', '2018-09-05 00:05:06', '2018-09-05 00:05:06'),
(7, 'role-edit', 'Edit Role', 'Edit Role', '2018-09-05 00:05:06', '2018-09-05 00:05:06'),
(8, 'role-delete', 'Delete Role', 'Delete Role', '2018-09-05 00:05:06', '2018-09-05 00:05:06'),
(9, 'item-list', 'Display Item Listing', 'See only Listing Of Item', '2018-09-05 00:05:06', '2018-09-05 00:05:06'),
(10, 'item-create', 'Create Item', 'Create New Item', '2018-09-05 00:05:06', '2018-09-05 00:05:06'),
(11, 'item-edit', 'Edit Item', 'Edit Item', '2018-09-05 00:05:06', '2018-09-05 00:05:06'),
(12, 'item-delete', 'Delete Item', 'Delete Item', '2018-09-05 00:05:06', '2018-09-05 00:05:06');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(9, 2),
(9, 5),
(10, 1),
(11, 1),
(12, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(125) DEFAULT NULL,
  `description` text,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `type` varchar(125) DEFAULT NULL,
  `contact_hp` varchar(125) DEFAULT NULL,
  `contact_name` varchar(125) NOT NULL,
  `contact_email` varchar(125) DEFAULT NULL,
  `manager_email` varchar(125) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `status` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reservations`
--

INSERT INTO `reservations` (`id`, `room_id`, `user_id`, `subject`, `description`, `start`, `end`, `type`, `contact_hp`, `contact_name`, `contact_email`, `manager_email`, `created_at`, `updated_at`, `unit_id`, `status`) VALUES
(35, 102, 78, 'GI', 'GI', '2018-09-27 11:47:46', '2018-09-27 11:47:46', 'Eksternal', '08999', 'eva', 'GI@gmail.com', 'GI@gmail.com', '2018-09-27 04:48:18', '2018-09-27 04:48:18', 56, 'approved'),
(36, 102, 78, 'abi', 'dghghh', '2018-09-27 22:15:39', '2018-09-27 22:15:39', 'Eksternal', NULL, 'eva24', 'nonalidia007@gmail.com', 'nonalidia007@gmail.com', '2018-09-27 15:16:02', '2018-09-27 15:16:02', 62, 'approved'),
(37, 102, 78, 'WEBSITE', 'WEBSITE RCTI', '2018-09-27 22:17:38', '2018-09-27 22:17:38', 'Internal', '081234555667', 'EVAAA', 'EVAA@gmail.com', 'VAA@gmail.com', '2018-09-27 15:18:36', '2018-09-27 15:18:36', 55, 'approved'),
(38, 102, 80, 'Meeting Bulanan', 'Bahas projek bulanan\r\nbahas projek live', '2018-09-28 10:05:59', '2018-09-28 12:05:59', 'Internal', '081234555667', 'Mirna', 'mirna@gm.com', 'didi@mnc.com', '2018-09-28 03:07:43', '2018-09-28 03:07:43', 54, 'approved');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'User has access to all system functionality', '2018-09-05 07:25:33', '2018-09-09 23:09:52'),
(2, 'guest', 'Guest', 'User can create create data in the system', '2018-09-05 07:25:39', '2018-09-05 07:25:42'),
(5, 'employee', 'Employee', 'Employee', '2018-09-05 08:33:31', '2018-09-05 19:27:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(78, 1),
(79, 1),
(80, 5),
(81, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `name` varchar(125) DEFAULT NULL,
  `description` text,
  `capacity` int(11) DEFAULT NULL,
  `contact_name` varchar(125) DEFAULT NULL,
  `contact_email` varchar(125) DEFAULT NULL,
  `contact_hp` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `area_id`, `name`, `description`, `capacity`, `contact_name`, `contact_email`, `contact_hp`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(96, 63, 'Ruang Anggrek', 'Ruangan Meeting Kecil', 5, 'Eva', 'eva@mncgroup.com', '081321300395', 1, '2018-09-19 07:06:34', '2018-09-19 07:06:34', NULL),
(97, 63, 'Ruang Mawar', 'Ruang Meeting Sedang', 10, 'Eva May', 'evamay@mncgroup.com', '081321395300', 1, '2018-09-19 07:07:56', '2018-09-19 07:09:18', NULL),
(98, 63, 'Ruang Melati', 'Ruang Meeting Besar', 15, 'Eva Mayadila', 'evamayadila@mncgroup.com', '081300321395', 0, '2018-09-19 07:11:35', '2018-09-19 07:19:13', NULL),
(99, 64, 'Ruang Bouverly', 'Ruangan Meeting Kecil', 8, 'Rafa', 'rafa@mncgroup.com', '081234500987', 1, '2018-09-19 07:13:11', '2018-09-19 07:19:02', NULL),
(100, 64, 'Ruangan Lily', 'Ruang Meeting Sedang', 16, 'Rafael', 'rafael@mncgroup.com', '081234555667', 1, '2018-09-19 07:14:10', '2018-09-19 07:14:10', NULL),
(101, 64, 'Ruang Matahari', 'Ruang Meeting Besar', 24, 'Rafael Himawan', 'rafaelhimawan@mncgroup.com', '081234560981', 0, '2018-09-19 07:15:59', '2018-09-19 07:19:28', NULL),
(102, 65, 'Ruang Anyelir', 'Ruang Meeting Kecil', 6, 'Aditya', 'aditya@mncgroup.com', '081234560981', 1, '2018-09-19 07:46:05', '2018-09-19 08:02:29', NULL),
(103, 65, 'Ruang Aster', 'Ruang Meeting Sedang', 12, 'Aditya Bima', 'adityabima@mncgroup.com', '081234555611', 0, '2018-09-19 07:47:42', '2018-09-19 07:51:43', NULL),
(104, 65, 'Ruang Begonia', 'Ruang Meeting Besar', 18, 'Aditya Bima Jonathan', 'ab.jonathan@mncgroup.com', '081234500900', 1, '2018-09-19 07:48:55', '2018-09-19 08:04:05', NULL),
(105, 66, 'Ruang Freesia', 'Ruang Meeting Kecil', 10, 'Bima', 'bima@mncgroup.com', '08123452093', 1, '2018-09-19 07:56:02', '2018-09-19 07:56:02', NULL),
(106, 66, 'Ruang Lavender', 'Ruang Meeting Sedang', 20, 'Jonathan', 'jonathan@mncgroup.com', '081234444787', 0, '2018-09-19 07:57:19', '2018-09-19 08:04:26', NULL),
(107, 66, 'Ruang Eidelweis', 'Ruang Meeting Besar', 30, 'Jonathan Bima', 'jonathan.bima@mncgroup.com', '081234567890', 1, '2018-09-19 07:58:40', '2018-09-19 07:58:40', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(125) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `units`
--

INSERT INTO `units` (`id`, `name`, `deleted_at`) VALUES
(54, 'MNCTV', NULL),
(55, 'RCTI', NULL),
(56, 'GTV', NULL),
(57, 'MNC PLAY', NULL),
(58, 'MNC NOW', NULL),
(59, 'MNC BANK', NULL),
(60, 'The F Thing', NULL),
(61, 'MNC GROUP', NULL),
(62, 'INEWS', NULL),
(63, 'Star Media', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `unit_id` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `email` varchar(125) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `unit_id`, `name`, `email`, `password`, `created_at`, `updated_at`, `remember_token`, `deleted_at`) VALUES
(78, 61, 'eva24', 'eva24@gmail.com', '$2y$10$REQojrAlfK2/6MNMndC.xOPLpNvvtm/OcaVi0SoglE6YikKQhLNgu', '2018-09-19 06:56:55', '2018-09-19 06:58:11', 'IpolgEnPC618DazpDhJgXs6Te7nBs8peMHHnt0mq3kK6rZ1TOi6RwWHAVvxN', '0000-00-00 00:00:00'),
(79, 62, 'Eva May', 'evamay@gmail.com', '$2y$10$.G2VwF85TJ4wb6JOvYRdCOW1Ntncefco4W2rUUktYE4xkCAbkkHZK', '2018-09-20 02:28:24', '2018-09-20 02:28:24', '8znPTAzn09CbS75ORSlaAcKvFzMQ3uEPD1EnYbrVIiXWjgrWNMXrVwpEBDuJ', '0000-00-00 00:00:00'),
(80, 61, 'Mayadila', 'mayadila24@gmail.com', '$2y$10$wFJui7..spxzJy/mw6VeYO97b14nflJ6tWgi3.UlTp7qoCWSQlvki', '2018-09-26 09:30:25', '2018-09-26 09:30:25', 'peqSLJJTmWN2FSfzSIqbVgTLkHNEisHU0yp32EuimBOXQrFtJKGTFdlvCs96', NULL),
(81, 61, 'Rafa', 'rafa24@gmail.com', '$2y$10$QZKHjaYZ5b2g.ESu3rW1Uu/CnQ65IZAYOUNpQFUbazKR2tQS7mTJ.', '2018-09-26 09:32:49', '2018-09-26 09:32:49', 'GW56HaCxOLDlMdT4FIrRNGlFN1jfoUWrV535gc3w6mYcRme2HKntyIqlEzyi', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indeks untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indeks untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `area_id` (`area_id`);

--
-- Indeks untuk tabel `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_id` (`unit_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_3` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
