-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2017 at 04:12 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeevanacharya_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_donation`
--

CREATE TABLE `sramcms_donation` (
  `id` bigint(20) NOT NULL,
  `fund_type` varchar(255) NOT NULL,
  `donation_amount` int(11) NOT NULL,
  `resident` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `home_phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `work_phone` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `state_province_county` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pan_number` varchar(255) NOT NULL,
  `work_detail` text NOT NULL,
  `designation` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_donation`
--

INSERT INTO `sramcms_donation` (`id`, `fund_type`, `donation_amount`, `resident`, `first_name`, `last_name`, `address`, `home_phone`, `city`, `work_phone`, `postal_code`, `mobile`, `state_province_county`, `email`, `country`, `pan_number`, `work_detail`, `designation`, `location`, `is_active`, `is_delete`, `created_on`, `updated_on`, `updated_by`) VALUES
(1, 'General Fund', 123, '', 'asdasd', 'asdasd', 'asdasd', 'asd', 'asdasd', '', '423423', '423423423', '', 'asdasdas@gmail.com', '234234234', '', '', '345345345', '345345345', 1, 0, '2017-06-21 15:56:54', '0000-00-00 00:00:00', 0),
(2, 'General Fund', 12, '', 'asdas', 'dasd', 'asdasd', 'asdasda', 'asdas', 'dasd', 'asdasd', '423423423', 'asdasd', 'asdasd@gmail.com', 'asdasd', '1231223', '', 'asdasd', 'asdasdasd', 1, 0, '2017-06-21 15:59:13', '0000-00-00 00:00:00', 0),
(3, 'General Fund', 231, '', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdasd', 'asdas', 'asdasd', '234234', 'asdasd', 'asdasdasdas@gmail.com', 'asdasd', '312312321', '', 'asdasd', 'asdasd', 1, 0, '2017-06-21 16:00:59', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_donation`
--
ALTER TABLE `sramcms_donation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_donation`
--
ALTER TABLE `sramcms_donation`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
