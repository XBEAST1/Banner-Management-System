-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2024 at 06:16 PM
-- Server version: 11.5.2-MariaDB
-- PHP Version: 8.3.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bannerimg`
--

-- --------------------------------------------------------

--
-- Table structure for table `bannerpage1`
--

CREATE TABLE `bannerpage1` (
  `bannerpage1_Id` int(11) NOT NULL,
  `banner_name` varchar(100) NOT NULL,
  `submission_date` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `expired` varchar(255) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bannerpage1`
--

INSERT INTO `bannerpage1` (`bannerpage1_Id`, `banner_name`, `submission_date`, `start_date`, `expiry_date`, `path`, `image_url`, `status`, `expired`) VALUES
(6, 'Cyber Sec', '01-11-2024', '01-11-2024', '02-05-2030', '../uploads/1730483190.jpg', 'https://www.offsec.com/', 'inactive', 'no'),
(7, 'Kali Linux', '01-11-2024', '05-11-2024', '12-05-2030', '../uploads/1730483232.jpg', 'https://www.kali.org/', 'active', 'no'),
(8, 'World Map', '01-11-2024', '08-11-2024', '25-05-2030', '../uploads/1730483267.jpg', 'https://www.kali.org/', 'active', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `bannerpage2`
--

CREATE TABLE `bannerpage2` (
  `bannerpage2_Id` int(11) NOT NULL,
  `banner_name` varchar(100) NOT NULL,
  `submission_date` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `expired` varchar(255) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bannerpage2`
--

INSERT INTO `bannerpage2` (`bannerpage2_Id`, `banner_name`, `submission_date`, `start_date`, `expiry_date`, `path`, `image_url`, `status`, `expired`) VALUES
(4, 'Servers', '01-11-2024', '14-11-2024', '19-06-2030', '../uploads/1730483407.jpg', 'https://www.offsec.com/', 'inactive', 'no'),
(5, 'Black Arch', '01-11-2024', '19-11-2024', '25-06-2030', '../uploads/1730483457.jpg', 'https://blackarch.org/', 'active', 'no'),
(6, 'Data Security', '01-11-2024', '14-11-2024', '25-06-2030', '../uploads/1730483514.jpg', 'https://www.offsec.com/', 'inactive', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `bannerpage3`
--

CREATE TABLE `bannerpage3` (
  `bannerpage3_Id` int(11) NOT NULL,
  `banner_name` varchar(100) NOT NULL,
  `submission_date` varchar(100) NOT NULL,
  `start_date` varchar(100) NOT NULL,
  `expiry_date` varchar(100) NOT NULL,
  `path` varchar(255) NOT NULL,
  `image_url` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'active',
  `expired` varchar(255) NOT NULL DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bannerpage3`
--

INSERT INTO `bannerpage3` (`bannerpage3_Id`, `banner_name`, `submission_date`, `start_date`, `expiry_date`, `path`, `image_url`, `status`, `expired`) VALUES
(4, 'Anonymous', '01-11-2024', '14-11-2024', '25-06-2030', '../uploads/1730483853.jpg', 'https://www.offsec.com/', 'active', 'no'),
(5, 'Parrot Sec', '01-11-2024', '08-11-2024', '25-05-2030', '../uploads/1730483901.jpg', 'https://parrotsec.org/', 'inactive', 'no'),
(6, 'Programming', '01-11-2024', '19-11-2024', '19-06-2030', '../uploads/1730484028.jpg', 'https://www.php.net/', 'active', 'no'),
(7, 'Home', '01-11-2024', '19-11-2024', '25-08-2030', '../uploads/1730484853.jpg', 'http://127.0.0.1/', 'active', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bannerpage1`
--
ALTER TABLE `bannerpage1`
  ADD PRIMARY KEY (`bannerpage1_Id`);

--
-- Indexes for table `bannerpage2`
--
ALTER TABLE `bannerpage2`
  ADD PRIMARY KEY (`bannerpage2_Id`);

--
-- Indexes for table `bannerpage3`
--
ALTER TABLE `bannerpage3`
  ADD PRIMARY KEY (`bannerpage3_Id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bannerpage1`
--
ALTER TABLE `bannerpage1`
  MODIFY `bannerpage1_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bannerpage2`
--
ALTER TABLE `bannerpage2`
  MODIFY `bannerpage2_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bannerpage3`
--
ALTER TABLE `bannerpage3`
  MODIFY `bannerpage3_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
