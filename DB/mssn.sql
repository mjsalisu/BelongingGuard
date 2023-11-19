-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 17, 2023 at 10:50 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mssn`
--

-- --------------------------------------------------------

--
-- Table structure for table `item_table`
--

CREATE TABLE `item_table` (
  `id` int(11) NOT NULL,
  `regById` int(11) NOT NULL,
  `trackId` varchar(11) NOT NULL,
  `itemName` varchar(250) NOT NULL,
  `itemType` varchar(250) NOT NULL,
  `itemQuantity` varchar(11) NOT NULL,
  `itemImage` varchar(255) NOT NULL,
  `itemDescription` varchar(250) NOT NULL,
  `checkInBy` int(11) DEFAULT NULL,
  `checkInDate` timestamp NULL DEFAULT NULL,
  `checkInNote` varchar(250) DEFAULT NULL,
  `checkOutDate` timestamp NULL DEFAULT NULL,
  `checkOutBy` int(11) DEFAULT NULL,
  `checkOutNote` varchar(255) DEFAULT NULL,
  `status` int(3) NOT NULL COMMENT '0=pending, 1=rejected, 2=approved, 3=retrieved',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `regNo` varchar(30) DEFAULT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(2) NOT NULL COMMENT '0 = user, 1 = admin',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `regNo`, `faculty`, `department`, `phone`, `password`, `role`, `created_at`) VALUES
(4, 'Administrator', 'admin@email.com', NULL, NULL, NULL, '08011223344', 'admin', 1, '2023-11-17 23:32:20'),
(5, 'User', 'user@email.com', NULL, NULL, NULL, '07066778899', 'user', 0, '2023-11-17 23:41:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_table`
--
ALTER TABLE `item_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_table`
--
ALTER TABLE `item_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
