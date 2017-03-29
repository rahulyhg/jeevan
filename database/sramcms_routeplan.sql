-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 03:36 PM
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
-- Table structure for table `sramcms_routeplan`
--

DROP TABLE IF EXISTS `sramcms_routeplan`;
CREATE TABLE IF NOT EXISTS `sramcms_routeplan` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `map_id` varchar(300) NOT NULL,
  `end_date` date NOT NULL,
  `trip_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `destinations` text NOT NULL,
  `plan_details` text NOT NULL,
  `type` varchar(200) NOT NULL,
  `avoidHighways` varchar(200) NOT NULL,
  `avoidTolls` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_ip` varchar(100) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ip` varchar(100) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_routeplan`
--

INSERT INTO `sramcms_routeplan` (`id`, `start_date`, `map_id`, `end_date`, `trip_name`, `description`, `image`, `destinations`, `plan_details`, `type`, `avoidHighways`, `avoidTolls`, `created_on`, `created_ip`, `created_by`, `updated_on`, `updated_ip`, `updated_by`, `is_active`, `is_delete`) VALUES
(1, '2017-03-14', 'y6s1d5n5t6va7hpsjkib', '2017-03-28', 'Trichy Yoha Trip', 'asdasdasd', '{"files":["events\\/media\\/2017\\/03\\/1120520_1490794227.jpg"]}', 'Pudukkottai, Tamil Nadu, India|*|Tiruchirappalli, Tamil Nadu, India', 'Pudukkottai, Tamil Nadu, India - Tiruchirappalli, Tamil Nadu, India', 'directions', '0', '0', '2017-03-29 15:10:55', '::1', 1, '2017-03-29 15:30:29', '::1', 1, 1, 0),
(6, '2017-03-15', 'izgtx0cr8rft6zynlxm1', '2017-03-29', 'Chennai Astrology Trip', 'asdasdasd', '', 'Chennai, Tamil Nadu, India|*|Delhi, India', 'Chennai, Tamil Nadu, India - Delhi, India', 'directions', '0', '0', '2017-03-29 15:34:38', '::1', 1, '0000-00-00 00:00:00', '', 0, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
