-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2017 at 09:29 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeevanacharya`
--

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_photo_oftheday`
--

CREATE TABLE `sramcms_photo_oftheday` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `date` date NOT NULL,
  `image` mediumtext NOT NULL,
  `created_on` datetime NOT NULL,
  `created_ip` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ip` varchar(50) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_photo_oftheday`
--
ALTER TABLE `sramcms_photo_oftheday`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_photo_oftheday`
--
ALTER TABLE `sramcms_photo_oftheday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
