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

INSERT INTO `users` (`id`, `unit_id`, `name`, `email`, `email_verified_at`, `password`, `photo`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(82, 62, 'haekal', 'haekal2@gmail.com', NULL, '$2y$10$uT6/E4vSxsXLnVn3ukvkYOFHgDkVgL0doT/Rv0naQKb1rg8qe57YG', '44b18a3af099983a0150a0419d6890e2.jpg', 'Fh8EC5uBFemsxaSGOi2xh8UEsunrXK4woagc5IoIUCW6NnCkX0NEgu7QPSoO', '2018-11-28 21:22:46', '2018-11-28 21:30:50', NULL);

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'Administrator', 'User has access to all system functionality', '2018-09-05 00:25:33', '2018-09-09 16:09:52'),
(2, 'guest', 'Guest', 'User can create create data in the system', '2018-09-05 00:25:39', '2018-09-05 00:25:42'),
(5, 'employee', 'Employee', 'Employee', '2018-09-05 01:33:31', '2018-09-05 12:27:42');

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(82, 1);

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(5, 'role-list', 'Display Role Listing', 'See only Listing Of Role', '2018-09-04 17:05:06', '2018-09-04 17:05:06'),
(6, 'role-create', 'Create Role', 'Create New Role', '2018-09-04 17:05:06', '2018-09-04 17:05:06'),
(7, 'role-edit', 'Edit Role', 'Edit Role', '2018-09-04 17:05:06', '2018-09-04 17:05:06'),
(8, 'role-delete', 'Delete Role', 'Delete Role', '2018-09-04 17:05:06', '2018-09-04 17:05:06'),
(9, 'item-list', 'Display Item Listing', 'See only Listing Of Item', '2018-09-04 17:05:06', '2018-09-04 17:05:06'),
(10, 'item-create', 'Create Item', 'Create New Item', '2018-09-04 17:05:06', '2018-09-04 17:05:06'),
(11, 'item-edit', 'Edit Item', 'Edit Item', '2018-09-04 17:05:06', '2018-09-04 17:05:06'),
(12, 'item-delete', 'Delete Item', 'Delete Item', '2018-09-04 17:05:06', '2018-09-04 17:05:06');

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(9, 2),
(9, 5);

INSERT INTO `areas` (`id`, `unit_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(63, 62, 'Area Lantai 2', 'Area Perunggu', '2018-09-19 00:01:37', '2018-09-19 00:53:15', NULL),
(64, 62, 'Area Lantai 6', 'Area Perak', '2018-09-19 00:01:56', '2018-09-19 00:40:28', NULL),
(65, 62, 'Area Lantai 10', 'Area Emas', '2018-09-19 00:02:16', '2018-09-19 00:53:50', NULL),
(66, 62, 'Area Lantai 14', 'Area Palladium', '2018-09-19 00:03:44', '2018-09-19 00:42:14', NULL),
(67, 62, 'Area Lantai 16', 'Area Platinum', '2018-09-19 00:04:04', '2018-09-19 00:42:39', NULL);

INSERT INTO `facilities` (`id`, `name`, `deleted_at`) VALUES
(1, 'meja', NULL),
(2, 'kursi', NULL),
(3, 'monitor', NULL),
(4, 'proyektor', NULL),
(6, 'whiteboard', NULL);

INSERT INTO `rooms` (`id`, `area_id`, `facility_id`, `name`, `description`, `capacity`, `contact_name`, `contact_email`, `contact_hp`, `is_active`, `photo`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 63, 'cobham', 'interior', 10, 'yopi', 'yopi@gmail.com', '08536372', NULL, '', '2018-11-29 08:00:00', '2018-11-29 09:00:00', '2018-11-29 11:00:00'),
(110, 63, 'etihad', '<p>tes</p>', 12, 'yopi', 'yopi@gmail.com', '08566363', 1, '76fe2ff9cadea5f54808db01c002128f.jpg', '2018-11-29 10:48:38', '2018-11-29 10:48:41', NULL),
(111, 66, 'Test Ruangan', '<p>Test Description</p>', 12, 'Test Nama', 'email@email.com', '0865445554', 1, '07be52379493b3b2802d15522cd99011.png', '2018-12-02 14:26:23', '2018-12-02 14:26:26', NULL);