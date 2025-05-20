-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2025 at 07:49 AM
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
-- Database: `sendmoney`
--

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE `transaction` (
  `id` int(11) NOT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `amount` decimal(5,2) DEFAULT NULL,
  `password` varchar(10) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `phone`, `amount`, `password`, `created_at`) VALUES
(1, '01753594577', 999.99, '25d55ad283', '2025-05-19 05:31:06'),
(2, '01753594577', 100.00, '25d55ad283', '2025-05-19 05:31:55'),
(3, '01753594577', 34.00, '25d55ad283', '2025-05-19 05:32:37'),
(4, '01753594577', 34.00, '25d55ad283', '2025-05-19 05:35:53'),
(5, '01753594577', 34.00, '25d55ad283', '2025-05-19 05:42:02'),
(6, '01720830330', 3.00, '25d55ad283', '2025-05-19 05:42:26'),
(7, '01753594577', 12.00, '3c37ccb276', '2025-05-19 05:43:02'),
(8, '01753594577', 12.00, '3c37ccb276', '2025-05-19 05:44:03'),
(9, '01753594577', 12.00, '3c37ccb276', '2025-05-19 05:46:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction`
--
ALTER TABLE `transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
