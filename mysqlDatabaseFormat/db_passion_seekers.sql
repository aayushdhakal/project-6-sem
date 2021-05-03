-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 03, 2021 at 10:15 AM
-- Server version: 8.0.23-0ubuntu0.20.04.1
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
-- Database: `db_passion_seekers`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admins`
--

DROP TABLE IF EXISTS `tbl_admins`;
CREATE TABLE `tbl_admins` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `phone_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admins`
--

INSERT INTO `tbl_admins` (`id`, `name`, `username`, `password`, `email`, `address`, `phone_number`, `avatar`, `status`, `created_at`, `Updated_at`) VALUES
(7, 'Kimberley Hogan', 'aayush1', 'd2295ddd09aa9e94b503b88f6d78eb97', 'aayushdhakal961@gmail.com', 'Eu at esse aut repu', '+1 (259) 968-2016', NULL, 1, '2021-04-25 08:27:14', NULL),
(8, 'Katelyn Hurst', 'aayush2', 'd2295ddd09aa9e94b503b88f6d78eb97', 'aayushdhakal9@gmail.com', 'Iste aliquid vel inv', '+1 (454) 275-4795', NULL, 1, '2021-04-25 09:54:01', NULL),
(9, 'Callum Stevenson', 'petanobah', 'd2295ddd09aa9e94b503b88f6d78eb97', 'xevajodob@mailinator.com', 'Natus sed deserunt e', '+1 (137) 954-8351', NULL, 0, '2021-05-03 01:58:17', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comments`
--

DROP TABLE IF EXISTS `tbl_comments`;
CREATE TABLE `tbl_comments` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `location_id` int NOT NULL,
  `comment` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_favorites`
--

DROP TABLE IF EXISTS `tbl_favorites`;
CREATE TABLE `tbl_favorites` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `location_id` int NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_images`
--

DROP TABLE IF EXISTS `tbl_images`;
CREATE TABLE `tbl_images` (
  `id` int NOT NULL,
  `image` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `location_id` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_images`
--

INSERT INTO `tbl_images` (`id`, `image`, `location_id`, `status`, `created_at`, `updated_at`) VALUES
(4, 'imagePost608f6715b6eac', 13, 1, '2021-05-03 02:59:33', NULL),
(5, 'imagePost608f6715b7030', 13, 1, '2021-05-03 02:59:33', NULL),
(6, 'imagePost608f6715b7211', 13, 1, '2021-05-03 02:59:33', NULL),
(7, 'imagePost608f6715b738d', 13, 1, '2021-05-03 02:59:33', NULL),
(8, 'imagePost608f727d5f7bc.png', 14, 1, '2021-05-03 03:48:13', NULL),
(9, 'imagePost608f727d5f928.png', 14, 1, '2021-05-03 03:48:13', NULL),
(10, 'imagePost608f736e712b5.png', 15, 1, '2021-05-03 03:52:14', NULL),
(11, 'imagePost608f736e71527.png', 15, 1, '2021-05-03 03:52:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

DROP TABLE IF EXISTS `tbl_location`;
CREATE TABLE `tbl_location` (
  `id` int NOT NULL,
  `title` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci NOT NULL,
  `admin_id` int NOT NULL,
  `lattitude` decimal(10,0) NOT NULL,
  `longitude` decimal(10,0) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`id`, `title`, `description`, `admin_id`, `lattitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(13, 'Consectetur qui min', 'Iure rem non ipsum', 7, '52', '88', 1, '2021-05-03 02:59:33', NULL),
(14, 'Accusamus exercitati', 'Qui dolore est esse', 7, '76', '8', 1, '2021-05-03 03:48:13', NULL),
(15, 'Quis sit repudiandae', 'Culpa qui fugit off', 7, '6', '48', 1, '2021-05-03 03:52:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone_number` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `avatar` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `name`, `username`, `password`, `email`, `phone_number`, `address`, `avatar`, `status`, `created_at`, `updated_at`) VALUES
(70, 'aayush', 'aayush', 'd2295ddd09aa9e94b503b88f6d78eb97', 'aayushdhakal96@gmail.com', '98123123', 'baneshore', NULL, 1, '2021-04-25 08:25:23', NULL),
(71, 'Quinn Durham', 'aayush12', 'd2295ddd09aa9e94b503b88f6d78eb97', 'jixyco@mailinator.com', '+1 (873) 193-6218', 'Ipsum iure dolor mo', NULL, 1, '2021-04-25 09:51:49', NULL),
(72, 'Ali Mckee', 'bycocoh', 'd2295ddd09aa9e94b503b88f6d78eb97', 'hupotumax@mailinator.com', '+1 (465) 383-5188', 'Laboriosam est dol', NULL, 1, '2021-05-03 01:57:37', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN KEY on location_id comments` (`location_id`),
  ADD KEY `FOREIGN KEY on users_id comments` (`user_id`);

--
-- Indexes for table `tbl_favorites`
--
ALTER TABLE `tbl_favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN KEY on location_id favorite` (`location_id`),
  ADD KEY `FOREIGN KEY on user_id favorite` (`user_id`);

--
-- Indexes for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN KEY on location_id images` (`location_id`) USING BTREE;

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FOREIGN KEY on admin_id location` (`admin_id`) USING BTREE;

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admins`
--
ALTER TABLE `tbl_admins`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_favorites`
--
ALTER TABLE `tbl_favorites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_images`
--
ALTER TABLE `tbl_images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_comments`
--
ALTER TABLE `tbl_comments`
  ADD CONSTRAINT `FOREIGN KEY on location_id comments` FOREIGN KEY (`location_id`) REFERENCES `tbl_location` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FOREIGN KEY on users_id comments` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_favorites`
--
ALTER TABLE `tbl_favorites`
  ADD CONSTRAINT `FOREIGN KEY on location_id favorite` FOREIGN KEY (`location_id`) REFERENCES `tbl_location` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `FOREIGN KEY on user_id favorite` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_images`
--
ALTER TABLE `tbl_images`
  ADD CONSTRAINT `FOREIGN KEY` FOREIGN KEY (`location_id`) REFERENCES `tbl_location` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD CONSTRAINT `admin foreign key` FOREIGN KEY (`admin_id`) REFERENCES `tbl_admins` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
