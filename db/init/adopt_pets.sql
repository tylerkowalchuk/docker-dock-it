-- phpMyAdmin SQL Dump
-- version 5.1.4-dev+20220331.b9ddf0b305
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 08, 2025 at 04:12 PM
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
-- Table structure for table `adopt_pets`
--

CREATE TABLE `adopt_pets` (
  `petID` int(11) UNSIGNED NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Birthday` date NOT NULL,
  `Sex` varchar(10) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Donation_Fee` varchar(11) NOT NULL,
  `Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `adopt_pets`
--

INSERT INTO `adopt_pets` (`petID`, `Name`, `Birthday`, `Sex`, `Description`, `Donation_Fee`, `Status`) VALUES
(1, 'Bella', '2022-05-01', 'F', 'Fun and Playful', '$100', 'Not Adopted'),
(2, 'Bailey', '2022-04-01', 'F', 'Stubborn', '$100', 'Not Adopted'),
(3, 'Max', '2022-03-01', 'M', 'Independent and Aloof', '$100', 'Not Adopted'),
(4, 'Chloe', '2022-02-01', 'F', 'Active and Outgoing', '$100', 'Not Adopted'),
(5, 'Honey', '2020-05-01', 'F', 'Sweet and Friendly', '$150', 'Not Adopted'),
(6, 'Buddy', '2019-05-05', 'M', 'Goofy and Sweet', '$150', 'Not Adopted'),
(7, 'Stella', '2018-10-12', 'F', 'Naughty', '$100', 'Not Adopted'),
(8, 'Bear', '2019-05-01', 'M', 'Playful and Perfect', '$50', 'Not Adopted'),
(9, 'Wolf', '2018-05-06', 'M', 'Lazy and Calm', '$80', 'Not Adopted'),
(10, 'Moose', '2018-04-01', 'M', 'Loving and Chubby', '$50', 'Not Adopted'),
(11, 'Chuck', '2018-02-05', 'M', 'Well-trained and Kid-friendly', '$100', 'Adopted'),
(12, 'Sadie', '2021-07-07', 'F', 'Quirky and Happy', '$100', 'Not Adopted'),
(13, 'Lola', '2022-03-11', 'F', 'Joyful and Sneaky', '$100', 'Adopted'),
(14, 'Rocky', '2021-09-24', 'M', 'Trainable and Tough', '$50', 'Not Adopted'),
(15, 'Vecna', '2017-11-24', 'F', 'Calm and Cat-friendly', '$100', 'Adopted'),
(16, 'Bluey', '2013-01-06', 'M', 'Cuddly and Likable', '$100', 'Not Adopted'),
(17, 'Dutton', '2022-10-24', 'M', 'Fluffy and Fun', '$100', 'Adopted'),
(18, 'Stormi ', '2016-05-02', 'F', 'Quick and Protective', '$100', 'Not Adopted'),
(19, 'Mirabel ', '2022-04-06', 'F', 'Loving and Clever', '$100', 'Not Adopted'),
(20, 'Priscilla ', '2018-10-12', 'F', 'Silly and Hyper', '$30', 'Adopted');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adopt_pets`
--
ALTER TABLE `adopt_pets`
  ADD PRIMARY KEY (`petID`),
  ADD KEY `Name` (`Name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adopt_pets`
--
ALTER TABLE `adopt_pets`
  MODIFY `petID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
