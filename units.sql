-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 30, 2020 at 07:34 PM
-- Server version: 10.3.22-MariaDB-1ubuntu1
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrms`
--

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `region` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `region`, `unit_name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Greater Accra Region', '37 MIL HOSP', NULL, '2020-06-16 18:53:45', '2020-06-16 18:53:45'),
(2, 'Greater Accra Region', '1MRS', NULL, '2020-06-16 18:57:46', '2020-06-16 18:57:46'),
(3, 'Ashanti Region', '2MRS', NULL, '2020-06-16 18:57:58', '2020-06-16 18:57:58'),
(4, 'Oti Region', '3MRS', NULL, '2020-06-16 18:58:07', '2020-06-16 18:58:07'),
(5, 'Oti Region', '4MRS', NULL, '2020-06-16 18:58:32', '2020-06-16 18:58:32'),
(6, 'Oti Region', '6MRS', NULL, '2020-06-16 18:58:39', '2020-06-16 18:58:39'),
(7, 'Oti Region', '7MRS', NULL, '2020-06-16 18:59:28', '2020-06-16 18:59:28'),
(8, 'Greater Accra Region', 'ARAKAN MED CENTER', NULL, '2020-06-16 19:01:31', '2020-06-16 19:01:31'),
(9, 'Greater Accra Region', 'DUALA MED CENTER', NULL, '2020-06-16 19:02:02', '2020-06-16 19:02:02'),
(10, 'Greater Accra Region', 'KPESHIE MAT CENTER', NULL, '2020-06-16 19:02:21', '2020-06-16 19:02:21'),
(11, 'Greater Accra Region', 'KPESHIE MED CENTER', NULL, '2020-06-16 19:02:39', '2020-06-16 19:02:39'),
(12, 'Greater Accra Region', 'ENC', NULL, '2020-06-16 19:03:24', '2020-06-16 19:03:24'),
(13, 'Western Region', 'WNC', NULL, '2020-06-16 19:03:41', '2020-06-16 19:03:41'),
(14, 'Greater Accra Region', 'AFB', NULL, '2020-06-16 19:04:14', '2020-06-16 19:04:14'),
(15, 'Greater Accra Region', 'ABF', NULL, '2020-06-16 19:05:15', '2020-06-16 19:05:15'),
(16, 'Oti Region', 'ARTS', NULL, '2020-06-16 19:05:43', '2020-06-16 19:05:43'),
(17, 'Oti Region', 'JWS', NULL, '2020-06-16 19:06:05', '2020-06-16 19:06:05'),
(18, 'Greater Accra Region', 'NAVTRAC', NULL, '2020-06-16 19:06:32', '2020-06-16 19:06:32'),
(19, 'Eastern Region', 'ASUTUARE MED CENTER', NULL, '2020-06-16 19:07:07', '2020-06-16 19:07:07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
