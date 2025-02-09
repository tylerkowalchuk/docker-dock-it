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
-- Table structure for table `dog_color`
--

CREATE TABLE `dog_color` (
  `dog_colorID` int(11) UNSIGNED NOT NULL,
  `petID` int(11) NOT NULL,
  `color_id` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `dog_color`
--

INSERT INTO `dog_color` (`dog_colorID`, `petID`, `color_id`) VALUES
(1, 2, '2'),
(2, 1, '2'),
(3, 4, '1'),
(4, 3, '1'),
(5, 6, '3'),
(6, 5, '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dog_color`
--
ALTER TABLE `dog_color`
  ADD PRIMARY KEY (`dog_colorID`),
  ADD KEY `petID` (`petID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dog_color`
--
ALTER TABLE `dog_color`
  MODIFY `dog_colorID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
