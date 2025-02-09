-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220331.b9ddf0b305
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2025 at 06:51 PM
-- Server version: 10.4.34-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mchkhetia`
--

-- --------------------------------------------------------

--
-- Table structure for table `dog_breed`
--

CREATE TABLE `dog_breed` (
  `dog_breed_id` int(11) UNSIGNED NOT NULL,
  `petID` int(11) NOT NULL,
  `breed_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dog_breed`
--

INSERT INTO `dog_breed` (`dog_breed_id`, `petID`, `breed_id`) VALUES
(1, 1, 7),
(2, 2, 1),
(3, 3, 5),
(4, 4, 2),
(5, 5, 13),
(6, 6, 18),
(7, 7, 6),
(8, 8, 8),
(9, 9, 15),
(10, 10, 9),
(11, 11, 19),
(12, 12, 17),
(13, 13, 4),
(14, 14, 4),
(15, 15, 1),
(16, 16, 1),
(17, 17, 12),
(18, 18, 14),
(19, 19, 3),
(20, 20, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dog_breed`
--
ALTER TABLE `dog_breed`
  ADD PRIMARY KEY (`dog_breed_id`),
  ADD KEY `dog_id` (`petID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dog_breed`
--
ALTER TABLE `dog_breed`
  MODIFY `dog_breed_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
