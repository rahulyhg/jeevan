-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2017 at 02:28 PM
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
-- Table structure for table `sramcms_discourse`
--

CREATE TABLE `sramcms_discourse` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `shortdesc` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image` text NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `created` date NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_discourse`
--

INSERT INTO `sramcms_discourse` (`id`, `title`, `slug`, `shortdesc`, `description`, `image`, `is_active`, `is_delete`, `created`, `modified`) VALUES
(1, 'asdasd', 'asdasd', 'asdasd', '<p>asdasdasd</p>\r\n\r\n<p>asdasd</p>\r\n', 'f4721e5c39f36869f4851ff2d40dc2e2-discourse-1120520.jpg', 1, 0, '2017-04-18', '2017-04-18 10:53:44'),
(2, 'qweqwe', 'qweqwe', 'qweqwe', '<p>qweqwe</p>\r\n', 'daUEtroLWOw7cnHPFpiuV2J5N3X1bzTjk0BQ4hYR96evDqKGmC.jpg', 1, 0, '2017-04-18', '2017-04-18 10:54:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_discourse`
--
ALTER TABLE `sramcms_discourse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_discourse`
--
ALTER TABLE `sramcms_discourse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
