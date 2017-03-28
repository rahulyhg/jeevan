-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 28, 2017 at 12:12 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeevan`
--

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_routeplan`
--

DROP TABLE IF EXISTS `sramcms_routeplan`;
CREATE TABLE `sramcms_routeplan` (
  `id` bigint(20) NOT NULL,
  `start_date` date NOT NULL,
  `map_id` varchar(300) NOT NULL,
  `end_date` date NOT NULL,
  `description` text NOT NULL,
  `destinations` text NOT NULL,
  `plan_details` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `avoidHighways` varchar(200) NOT NULL,
  `avoidTolls` varchar(200) NOT NULL,
  `created_at` bigint(20) NOT NULL,
  `created_ip` bigint(20) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_routeplan`
--
ALTER TABLE `sramcms_routeplan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_routeplan`
--
ALTER TABLE `sramcms_routeplan`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
