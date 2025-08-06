-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2025 at 05:16 PM
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
-- Database: `lotushoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `message` text NOT NULL,
  `cdate` date DEFAULT NULL,
  `is_read` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_no` int(11) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `cccd` varchar(20) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `no_of_days` int(11) NOT NULL,
  `room_price` double(10,2) NOT NULL,
  `water` int(11) DEFAULT 0,
  `soft_drink` int(11) DEFAULT 0,
  `beer` int(11) DEFAULT 0,
  `minibar_price` double(10,2) DEFAULT 0.00,
  `total_price` double(12,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(10) UNSIGNED NOT NULL,
  `contact_id` int(10) UNSIGNED NOT NULL,
  `admin_username` varchar(50) NOT NULL,
  `reply` text NOT NULL,
  `rdate` date DEFAULT NULL,
  `is_seen_by_customer` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roombook`
--

CREATE TABLE `roombook` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `cccd` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `room_type` varchar(50) NOT NULL,
  `checkin` date NOT NULL,
  `checkout` date NOT NULL,
  `nodays` int(11) DEFAULT NULL,
  `total_price` bigint(20) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(10) UNSIGNED NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `room_type` enum('Single','Guest','Deluxe','Luxury') NOT NULL,
  `price_per_day` double(10,2) NOT NULL,
  `customer_name` varchar(100) DEFAULT NULL,
  `cccd` varchar(20) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `water` int(11) DEFAULT 0,
  `soft_drink` int(11) DEFAULT 0,
  `beer` int(11) DEFAULT 0,
  `minibar_price` double(10,2) DEFAULT 0.00,
  `total_price` double(12,2) DEFAULT 0.00,
  `state` enum('available','booked','clear') DEFAULT 'available',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_number`, `room_type`, `price_per_day`, `customer_name`, `cccd`, `phone`, `email`, `address`, `check_in`, `check_out`, `water`, `soft_drink`, `beer`, `minibar_price`, `total_price`, `state`, `created_at`) VALUES
(1, '601', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(2, '602', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(3, '603', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(4, '604', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(5, '605', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(6, '606', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(7, '607', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(8, '608', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(9, '501', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(10, '502', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(11, '503', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(12, '504', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(13, '505', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(14, '506', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(15, '507', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(16, '508', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(17, '401', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(18, '402', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(19, '403', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(20, '404', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(21, '405', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(22, '406', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(23, '407', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(24, '408', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(25, '301', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(26, '302', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(27, '303', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(28, '304', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(29, '305', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(30, '306', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(31, '307', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(32, '308', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(33, '201', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(34, '202', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(35, '203', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(36, '204', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(37, '205', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(38, '206', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(39, '207', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(40, '208', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(41, '101', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(42, '102', 'Single', 500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(43, '103', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(44, '104', 'Guest', 770000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(45, '105', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(46, '106', 'Deluxe', 1000000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(47, '107', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22'),
(48, '108', 'Luxury', 1500000.00, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0.00, 0.00, 'available', '2025-06-30 13:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `role` enum('admin','receptionist','customer') NOT NULL DEFAULT 'customer',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `phone`, `role`, `created_at`) VALUES
(1, 'admin', '$2y$10$YSlMzkCd.4QHt51KKa9RfeQlVAcmtYNUXqXBkrItj/tKgRLuJ4ngC', '0896468675', 'admin', '2025-07-04 15:09:53'),
(2, 'customer01', '$2y$10$mRqyfXc27nV2J1F2UTqxeu1ME77AR5o1PXTP2X6TZEwtbEO5UqgsS', '0805013508', 'customer', '2025-07-04 15:10:50'),
(3, 'receptionist01', '$2y$10$0eVF269.diPGQHL7H7RTEuwvHos2A9xrW7HNHD5pyHYi8ph1ofUoe', '0808012004', 'receptionist', '2025-07-04 15:14:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_id` (`contact_id`);

--
-- Indexes for table `roombook`
--
ALTER TABLE `roombook`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `room_number` (`room_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roombook`
--
ALTER TABLE `roombook`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
