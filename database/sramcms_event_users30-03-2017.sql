-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2017 at 03:35 PM
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
-- Table structure for table `sramcms_event_users`
--

CREATE TABLE `sramcms_event_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_no` varchar(100) NOT NULL,
  `event_id` bigint(20) NOT NULL COMMENT 'reference by routeplan table',
  `purpose_of_appointment` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `booked_date` date NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_ip` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ip` varchar(100) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_event_users`
--

INSERT INTO `sramcms_event_users` (`id`, `name`, `email`, `phone_no`, `event_id`, `purpose_of_appointment`, `message`, `booked_date`, `created_on`, `created_by`, `created_ip`, `updated_on`, `updated_ip`, `updated_by`, `is_active`, `is_delete`) VALUES
(1, 'asdasd', 'asdasdasd@gmail.com', '3423423434234', 6, '["Astrology","Business Problem","Marriage Problem","Family Problem","Other Problem"]', 'sadasdasd', '2017-04-14', '2017-03-30 12:29:21', 1, '::1', '2017-03-30 15:14:35', '', 1, 1, 0),
(2, 'aaasdasdasd', 'asdasdasdasdasd@gmail.com', '34234234234', 6, '["Business Problem","Marriage Problem","Family Problem","Other Problem"]', 'asdasdasd', '2017-04-04', '2017-03-30 12:29:45', 1, '::1', '2017-03-30 15:14:35', '::1', 1, 1, 0),
(3, 'asdasdasd', 'asdasdasdasdasdasd@gmail.com', 'asdasdasd', 6, '["Astrology","Business Problem","Marriage Problem","Other Problem"]', 'asdasdasd', '2017-04-04', '2017-03-30 14:37:46', 1, '::1', '2017-03-30 15:16:13', '::1', 1, 1, 0),
(4, 'asdasdasd', 'asdasdasdasdasdasd@gmail.com', 'asdasdasd', 6, '["Business Problem","Marriage Problem","Other Problem"]', 'asdasdasd', '2017-04-12', '2017-03-30 14:38:13', 1, '::1', '2017-03-30 15:16:47', '::1', 1, 1, 0),
(5, 'asdasdasdasdasd', 'asdasdasdasdasdasd123@gmail.com', '345234234234', 6, '["Business Problem","Marriage Problem"]', 'asdasdasd', '2017-04-13', '2017-03-30 14:48:12', 1, '::1', '2017-03-30 15:14:35', '::1', 1, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_event_users`
--
ALTER TABLE `sramcms_event_users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_event_users`
--
ALTER TABLE `sramcms_event_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
