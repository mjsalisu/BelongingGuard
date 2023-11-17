-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 17, 2023 at 11:34 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

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
-- Table structure for table `item_tbl`
--

CREATE TABLE `item_tbl` (
  `id` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `trackId` varchar(11) NOT NULL,
  `itemName` varchar(250) NOT NULL,
  `itemType` varchar(250) NOT NULL,
  `itemQuantity` varchar(11) NOT NULL,
  `itemImage` varchar(30) NOT NULL,
  `itemDescription` varchar(250) NOT NULL,
  `checkIn` date DEFAULT NULL,
  `checkOut` date DEFAULT NULL,
  `checkInNote` varchar(250) DEFAULT NULL,
  `status` int(3) NOT NULL COMMENT '0 = waiting review, 1 = rejected, 2 = approved',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_tbl`
--

INSERT INTO `item_tbl` (`id`, `userId`, `trackId`, `itemName`, `itemType`, `itemQuantity`, `itemImage`, `itemDescription`, `checkIn`, `checkOut`, `checkInNote`, `status`, `created_at`) VALUES
(3, 2, 'T1KB11Q', 'A School Bag', 'Bag', '77', '7517-Screenshot 2023-06-11 115', 'Testing', NULL, NULL, NULL, 0, '2023-11-17 00:26:11'),
(4, 2, 'H1IZIEL', 'A Bag of Books', 'Books', '1', '5575-Screenshot 2023-11-12 034', 'A school bag conatinging some books', NULL, NULL, NULL, 0, '2023-11-17 09:39:03');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `regNo` varchar(30) DEFAULT NULL,
  `faculty` varchar(50) DEFAULT NULL,
  `department` varchar(50) DEFAULT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` int(2) NOT NULL COMMENT '0 = user, 1 = admin',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `name`, `email`, `regNo`, `faculty`, `department`, `phone`, `password`, `role`, `created_at`) VALUES
(1, 'Yunus Isah', 'admin@gmail.com', NULL, NULL, NULL, '09033248408', '12345', 1, '2023-11-16 17:06:20'),
(2, 'Yunus Isah', 'yunusisah123@gmail.com', 'CST/17/IFT/00029', 'Faculty Of Computing', 'Information Technology', '09033248408', '1234', 0, '2023-11-16 22:56:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `item_tbl`
--
ALTER TABLE `item_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_tbl`
--
ALTER TABLE `item_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
