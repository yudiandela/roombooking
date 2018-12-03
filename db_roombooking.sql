-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Des 2018 pada 09.57
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
-- Struktur dari tabel `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `delete_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `delete_at`) VALUES
(1, 'meja', '2018-11-29 10:00:00'),
(2, 'kursi', NULL),
(3, 'monitor', NULL),
(4, 'proyektor', NULL),
(6, 'whiteboard', NULL);

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
(81, 2),
(82, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `facility_id` int(11) DEFAULT NULL,
  `name` varchar(125) DEFAULT NULL,
  `description` text,
  `capacity` int(11) DEFAULT NULL,
  `contact_name` varchar(125) DEFAULT NULL,
  `contact_email` varchar(125) DEFAULT NULL,
  `contact_hp` varchar(20) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `photo` varchar(150) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rooms`
--

INSERT INTO `rooms` (`id`, `area_id`, `facility_id`, `name`, `description`, `capacity`, `contact_name`, `contact_email`, `contact_hp`, `is_active`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 63, 1, 'cobham', 'interior', 10, 'yopi', 'yopi@gmail.com', '08536372', NULL, '', '2018-11-29 08:00:00', '2018-11-29 09:00:00', '2018-11-29 11:00:00'),
(110, 63, 2, 'etihad', '<p>tes</p>', 12, 'yopi', 'yopi@gmail.com', '08566363', 1, '76fe2ff9cadea5f54808db01c002128f.jpg', '2018-11-29 10:48:38', '2018-11-29 10:48:41', NULL),
(111, 66, NULL, 'Test Ruangan', '<p>Test Description Test Description</p>', 12, 'Test Nama', 'email@email.com', '0865445554', 1, '07be52379493b3b2802d15522cd99011.png', '2018-12-02 14:26:23', '2018-12-02 14:26:26', NULL),
(112, 63, NULL, 'old trafford', '<p>bismilah</p>', 12, 'yopi', 'yopi@gmail.com', '089645555', 1, 'b731e4d7ad8d9a7f3fa664a0c771d946.jpg', '2018-12-02 14:30:54', '2018-12-02 14:30:57', NULL);

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
  `photo` varchar(150) NOT NULL,
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

INSERT INTO `users` (`id`, `unit_id`, `name`, `photo`, `email`, `password`, `created_at`, `updated_at`, `remember_token`, `deleted_at`) VALUES
(78, 61, 'eva24', '', 'eva24@gmail.com', '$2y$12$.k5Mj5aZTmOER2FmBE97te0fZSDr6VZk2D34bF/4l8NKRLvZCWL5W', '2018-09-19 06:56:55', '2018-09-19 06:58:11', 'Ilp31hNgjBzqjMkK5tcAuZ1P9LyZ3dW5UyOuDjKLBuqjB0OKj7R8cMQnwzwp', '0000-00-00 00:00:00'),
(79, 62, 'Eva May', '', 'evamay@gmail.com', '$2y$10$.G2VwF85TJ4wb6JOvYRdCOW1Ntncefco4W2rUUktYE4xkCAbkkHZK', '2018-09-20 02:28:24', '2018-09-20 02:28:24', '8znPTAzn09CbS75ORSlaAcKvFzMQ3uEPD1EnYbrVIiXWjgrWNMXrVwpEBDuJ', '0000-00-00 00:00:00'),
(80, 61, 'Mayadila', '', 'mayadila24@gmail.com', '$2y$10$wFJui7..spxzJy/mw6VeYO97b14nflJ6tWgi3.UlTp7qoCWSQlvki', '2018-09-26 09:30:25', '2018-09-26 09:30:25', 'peqSLJJTmWN2FSfzSIqbVgTLkHNEisHU0yp32EuimBOXQrFtJKGTFdlvCs96', NULL),
(81, 61, 'Rafa', '', 'rafa24@gmail.com', '$2y$10$QZKHjaYZ5b2g.ESu3rW1Uu/CnQ65IZAYOUNpQFUbazKR2tQS7mTJ.', '2018-09-26 09:32:49', '2018-09-26 09:32:49', 'GW56HaCxOLDlMdT4FIrRNGlFN1jfoUWrV535gc3w6mYcRme2HKntyIqlEzyi', NULL),
(82, 62, 'haekal', '44b18a3af099983a0150a0419d6890e2.jpg', 'haekal2@gmail.com', '$2y$10$uT6/E4vSxsXLnVn3ukvkYOFHgDkVgL0doT/Rv0naQKb1rg8qe57YG', '2018-11-29 04:22:46', '2018-11-29 04:30:50', 'Fh8EC5uBFemsxaSGOi2xh8UEsunrXK4woagc5IoIUCW6NnCkX0NEgu7QPSoO', NULL);

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
-- Indeks untuk tabel `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

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
  ADD KEY `area_id` (`area_id`),
  ADD KEY `facility_id` (`facility_id`);

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
-- AUTO_INCREMENT untuk tabel `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT untuk tabel `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

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
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rooms_ibfk_2` FOREIGN KEY (`facility_id`) REFERENCES `facilities` (`id`);

--
-- Ketidakleluasaan untuk tabel `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `units` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
