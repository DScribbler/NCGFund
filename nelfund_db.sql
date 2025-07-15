-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 05:27 PM
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
-- Database: `nelfund_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicants`
--

CREATE TABLE `applicants` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nin` varchar(20) NOT NULL,
  `bvn` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicants`
--

INSERT INTO `applicants` (`id`, `name`, `phone`, `email`, `nin`, `bvn`, `created_at`) VALUES
(43, 'Damian Joshua', '08139955846', 'damienjosh10@gmail.com', '24267461708', '12347123123', '2025-07-15 14:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `grant_applications`
--

CREATE TABLE `grant_applications` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `nin` varchar(20) DEFAULT NULL,
  `bvn` varchar(20) DEFAULT NULL,
  `education` varchar(100) DEFAULT NULL,
  `institution` varchar(100) DEFAULT NULL,
  `graduation_year` varchar(10) DEFAULT NULL,
  `field_of_study` varchar(100) DEFAULT NULL,
  `business_name` varchar(100) DEFAULT NULL,
  `sector` varchar(50) DEFAULT NULL,
  `project_title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `amount_requested` decimal(15,2) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL,
  `status` varchar(50) DEFAULT 'Under Review'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applicants`
--
ALTER TABLE `applicants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grant_applications`
--
ALTER TABLE `grant_applications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applicants`
--
ALTER TABLE `applicants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `grant_applications`
--
ALTER TABLE `grant_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
