-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 02:53 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `balut_business`
--

-- --------------------------------------------------------

--
-- Table structure for table `duck_batches`
--

CREATE TABLE `duck_batches` (
  `id` int(11) NOT NULL,
  `batch_name` varchar(100) NOT NULL,
  `type` enum('layering','future') NOT NULL,
  `count` int(11) DEFAULT 0,
  `male_count` int(11) DEFAULT 0,
  `female_count` int(11) DEFAULT 0,
  `status` enum('active','inactive','future') DEFAULT 'active',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `duck_batches`
--

INSERT INTO `duck_batches` (`id`, `batch_name`, `type`, `count`, `male_count`, `female_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Batch 1', 'layering', 50, 0, 0, 'active', '2025-09-23 12:29:10', '2025-09-23 12:29:10'),
(2, 'Batch 1', 'future', 0, 20, 30, 'future', '2025-09-23 12:34:42', '2025-09-23 12:34:42');

-- --------------------------------------------------------

--
-- Table structure for table `egg_batches`
--

CREATE TABLE `egg_batches` (
  `id` int(11) NOT NULL,
  `batch_name` varchar(100) NOT NULL,
  `egg_count` int(11) NOT NULL,
  `incubation_start` date NOT NULL,
  `status` enum('in_progress','completed','failed') DEFAULT 'in_progress',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `item_sold` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `sale_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `vendor_name`, `item_sold`, `amount`, `sale_date`, `created_at`) VALUES
(1, 'Lloyd', '50', '5000.00', '2025-09-23', '2025-09-23 12:28:21'),
(2, 'Thrik', '69', '9000.00', '2025-08-19', '2025-09-23 12:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('farmer','vendor','staff') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'farmer123', '$2y$10$/4iNMSIt31nTDrOreVrzhuy98OP.l1lqidSTLlt8maDfDISeY65VK', 'farmer', '2025-09-23 12:28:04'),
(2, 'vendor123', '$2y$10$.IpizwSRi9XhyF5dWwR5h.4/MDxyWNxZe39/SYzgbKR3TJa1suRQ.', 'vendor', '2025-09-23 12:28:04'),
(3, 'staff123', '$2y$10$0tbn5KiOwlXW6l5hlvoFb.Jrl0OJALqg.a0ydB3JbjxDDhqURTWDe', 'staff', '2025-09-23 12:46:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `duck_batches`
--
ALTER TABLE `duck_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `egg_batches`
--
ALTER TABLE `egg_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `duck_batches`
--
ALTER TABLE `duck_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `egg_batches`
--
ALTER TABLE `egg_batches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
