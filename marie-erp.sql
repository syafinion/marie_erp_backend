-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 09:32 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `marie-erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Vegetables', '2024-11-07 21:27:58', '2024-11-07 21:27:58'),
(2, 'Fruits', '2024-11-07 21:27:58', '2024-11-07 21:27:58'),
(3, 'Dairy', '2024-11-07 21:27:58', '2024-11-07 21:27:58'),
(4, 'Test Category', '2024-11-21 01:05:57', '2024-11-21 01:05:57'),
(5, 'Powders', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(6, 'Spices', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(7, 'Lentils', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(8, 'Seafoods', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(9, 'Rice', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(10, 'Oils', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(11, 'Meats', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(12, 'Flour', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(13, 'Sauces', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(14, 'Beverages', '2025-04-24 22:30:35', '2025-04-24 22:30:35'),
(15, 'Diary', '2025-04-24 22:30:35', '2025-04-24 22:30:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
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
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_checked` tinyint(1) NOT NULL DEFAULT 0,
  `is_loose` tinyint(1) NOT NULL DEFAULT 0,
  `is_carton` tinyint(1) NOT NULL DEFAULT 0,
  `is_bag` tinyint(1) NOT NULL DEFAULT 0,
  `package_weight` varchar(255) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `storage_location` varchar(255) DEFAULT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `item_code` varchar(255) DEFAULT NULL,
  `measurement` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`id`, `user_id`, `category_id`, `name`, `is_checked`, `is_loose`, `is_carton`, `is_bag`, `package_weight`, `unit_price`, `storage_location`, `barcode`, `item_code`, `measurement`, `created_at`, `updated_at`) VALUES
(162, 3, 9, 'beras faizah', 1, 0, 0, 1, '12', 1.00, 'Store', '948949702721', 'RIC366', 'kg', '2025-05-01 04:17:31', '2025-05-01 04:17:31'),
(163, 3, 13, 'garlic sause', 1, 0, 1, 0, '3', 12.00, 'Fridge', '078524815550', 'SAU464', 'litre', '2025-05-01 04:39:25', '2025-05-01 04:39:25'),
(165, 3, 5, 'garlic powder', 1, 0, 0, 1, '5', 5.00, 'Store', '585607151807', 'POW891', 'kg', '2025-05-01 07:06:43', '2025-05-01 07:06:43'),
(168, 3, 5, 'chili powder', 1, 0, 0, 1, '8', 5.00, 'Store', '101719962140', 'POW535', 'kg', '2025-05-01 07:21:25', '2025-05-01 07:21:25'),
(169, 3, 5, 'serbuk kari', 1, 1, 0, 0, '12', 12.00, 'Store', '549809591994', 'POW936', 'unit', '2025-05-01 21:31:45', '2025-05-01 21:31:45'),
(170, 3, 5, 'paprika', 1, 1, 0, 0, '12', 5.00, 'Store', '987532711550', 'POW581', 'kg', '2025-05-01 21:32:41', '2025-05-01 21:32:41'),
(171, 3, 7, 'powder', 1, 1, 0, 0, '12', 56.00, 'Store', '755230736348', 'LEN508', 'unit', '2025-05-01 21:33:28', '2025-05-01 21:33:28');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
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
-- Table structure for table `job_batches`
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
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000002_create_jobs_table', 1),
(2, '2024_11_08_051926_create_users_table', 1),
(3, '2024_11_08_051934_create_categories_table', 1),
(4, '2024_11_08_051940_create_ingredients_table', 1),
(5, '2024_11_08_061206_create_sessions_table', 2),
(6, '2024_11_21_233120_add_new_fields_to_ingredients_table', 3),
(7, '2024_11_21_235844_add_barcode_to_ingredients_table', 4),
(8, '2024_12_06_042230_create_stock_in_out_table', 5),
(9, '2025_02_13_190455_add_item_code_to_ingredients_table', 6),
(10, '2025_04_23_155003_add_fields_to_stocks_table', 7),
(11, '2025_04_23_204444_add_wastage_breakdown_to_stocks', 8),
(12, '2025_04_24_230237_add_name_to_users_table', 9),
(13, '2025_04_25_052953_add_name_to_users_table', 10),
(14, '2025_05_01_105021_add_user_id_to_ingredients_table', 10),
(15, '2025_05_02_052636_drop_measurements_table', 11);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
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
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('dYIr4nuMfClLjLtsAsKcZ8TlAIwm5GHlfeE2Mf6w', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTkQydXZTT0pORXZXT1R5N0lxcDRTZ3B1clVHR2s4aE1zVHo4ZHRWbiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731046699);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ingredient_id` bigint(20) UNSIGNED NOT NULL,
  `stock_in` int(11) NOT NULL DEFAULT 0,
  `stock_out` int(11) NOT NULL DEFAULT 0,
  `remarks` text DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `plan_to_buy` int(11) NOT NULL DEFAULT 0,
  `price_per_unit` decimal(10,2) DEFAULT NULL,
  `consumption` int(11) DEFAULT NULL,
  `closing_stock` int(11) DEFAULT NULL,
  `processing_pct` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `packaging_pct` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `environment_pct` tinyint(3) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `ingredient_id`, `stock_in`, `stock_out`, `remarks`, `user_id`, `created_at`, `updated_at`, `plan_to_buy`, `price_per_unit`, `consumption`, `closing_stock`, `processing_pct`, `packaging_pct`, `environment_pct`) VALUES
(68, 162, 3, 0, 'Stock adjustment via scanner', NULL, '2025-05-01 04:18:05', '2025-05-01 04:18:05', 0, 12.00, 0, 3, 0, 0, 0),
(69, 162, 1, 0, 'Stock adjustment via scanner', NULL, '2025-05-01 04:22:10', '2025-05-01 04:22:10', 0, 1.00, 0, 4, 0, 0, 0),
(70, 162, 12, 0, 'Stock adjustment via scanner', 3, '2025-05-01 04:33:50', '2025-05-01 04:33:50', 0, 60.00, 0, 16, 0, 0, 0),
(71, 163, 5, 0, 'Stock adjustment via scanner', 3, '2025-05-01 04:40:38', '2025-05-01 04:40:38', 0, 12.00, 0, 5, 0, 0, 0),
(72, 163, 0, 1, 'Stock adjustment via scanner', 3, '2025-05-01 04:41:39', '2025-05-01 04:41:39', 0, 0.00, 1, 4, 0, 0, 0),
(73, 163, 36, 0, 'Stock adjustment via scanner', 3, '2025-05-01 04:48:35', '2025-05-01 04:48:35', 0, 500.00, 0, 40, 0, 0, 0),
(74, 163, 0, 20, 'Stock adjustment via scanner', 3, '2025-05-01 04:49:11', '2025-05-01 04:49:11', 0, 0.00, 20, 20, 0, 0, 0),
(75, 163, 0, 14, 'Stock adjustment via scanner', 3, '2025-05-01 04:58:50', '2025-05-01 04:58:50', 0, 0.00, 14, 6, 0, 0, 0),
(76, 163, 30, 0, 'Stock adjustment via scanner', 3, '2025-05-01 04:59:10', '2025-05-01 04:59:10', 0, 12.00, 0, 36, 0, 0, 0),
(77, 163, 1, 0, 'Stock adjustment via scanner', 3, '2025-05-01 05:06:58', '2025-05-01 05:06:58', 0, 12.00, 0, 37, 0, 0, 0),
(78, 163, 1, 0, 'Stock adjustment via scanner', 3, '2025-05-01 05:06:59', '2025-05-01 05:06:59', 0, 12.00, 0, 38, 0, 0, 0),
(79, 163, 0, 38, 'Stock adjustment via scanner', 3, '2025-05-01 05:11:06', '2025-05-01 05:11:06', 0, 0.00, 38, 0, 0, 0, 0),
(80, 163, 30, 0, 'Stock adjustment via scanner', 3, '2025-05-01 05:24:04', '2025-05-01 05:24:04', 0, 12.00, 0, 30, 0, 0, 0),
(81, 163, 0, 30, 'Stock adjustment via scanner', 3, '2025-05-01 05:24:25', '2025-05-01 05:24:25', 0, 0.00, 30, 0, 0, 0, 0),
(82, 163, 30, 0, 'Stock adjustment via scanner', 3, '2025-05-01 05:30:46', '2025-05-01 05:30:46', 0, 30.00, 0, 30, 0, 0, 0),
(83, 163, 0, 29, 'Stock adjustment via scanner', 3, '2025-05-01 05:31:46', '2025-05-01 05:31:46', 0, 0.00, 29, 1, 0, 0, 0),
(84, 165, 10, 0, 'Stock adjustment via scanner', 3, '2025-05-01 07:08:00', '2025-05-01 07:08:00', 0, 5.00, 0, 15, 0, 0, 0),
(85, 165, 0, 7, 'Stock adjustment via scanner', 3, '2025-05-01 07:08:24', '2025-05-01 07:09:39', 0, 0.00, 7, 8, 20, 0, 0),
(86, 168, 10, 0, 'Stock adjustment via scanner', 3, '2025-05-01 07:24:52', '2025-05-01 07:24:52', 0, 5.00, 0, 18, 0, 0, 0),
(87, 168, 0, 2, 'Stock adjustment via scanner', 3, '2025-05-01 07:25:54', '2025-05-01 07:25:54', 0, 0.00, 2, 16, 0, 0, 0),
(88, 168, 1, 0, 'Stock adjustment via scanner', 3, '2025-05-01 07:29:28', '2025-05-01 07:43:59', 0, 5.00, 0, 17, 20, 0, 0),
(89, 168, 2, 0, 'Stock adjustment via scanner', 3, '2025-05-01 08:02:32', '2025-05-01 08:02:32', 0, 300.00, 0, 19, 0, 0, 0),
(90, 171, 56, 0, 'Stock adjustment via scanner', 3, '2025-05-01 21:34:06', '2025-05-01 21:34:06', 0, 34.00, 0, 68, 0, 0, 0),
(91, 171, 0, 50, 'Stock adjustment via scanner', 3, '2025-05-01 21:34:24', '2025-05-01 21:34:43', 0, 0.00, 50, 18, 68, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `password`, `token`, `created_at`, `updated_at`) VALUES
(3, 'karthickravikumar710@gmail.com', 'Marie-ERP', '$2y$12$.iR2lEvL1RDS/jdscZ8th.karo6WctGmNmwkKRr0SuN/JpL6YUa8y', '252d19b53b39a4d72cf0e7c31b2331db4c7b56ed0cb48e67875d13f941498fa8d80d3857a0838c11', '2024-11-20 22:27:19', '2025-05-01 08:25:39'),
(8, 'syafiqmajid286@gmail.com', 'syafiq', '$2y$12$Z3bmTHNnnj7ZB95t2fk07uOYw3RCmN0j4Q9Fdq0ubIuGgVOLxUlJ2', NULL, '2025-05-01 08:52:24', '2025-05-01 08:52:24');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ingredients_category_id_foreign` (`category_id`),
  ADD KEY `ingredients_user_id_foreign` (`user_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stocks_ingredient_id_foreign` (`ingredient_id`),
  ADD KEY `stocks_user_id_foreign` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=172;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD CONSTRAINT `ingredients_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ingredients_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ingredient_id_foreign` FOREIGN KEY (`ingredient_id`) REFERENCES `ingredients` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `stocks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
