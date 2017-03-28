-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2017 at 07:09 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sram_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_menu_groups`
--

DROP TABLE IF EXISTS `sramcms_menu_groups`;
CREATE TABLE `sramcms_menu_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Navigation groupings. Eg, header, sidebar, footer, etc';

--
-- Dumping data for table `sramcms_menu_groups`
--

INSERT INTO `sramcms_menu_groups` (`id`, `title`, `slug`, `abbreviation`, `created_on`, `updated_on`, `created_by`, `updated_by`, `is_active`, `is_delete`) VALUES
(1, 'Header Menu', 'header-menu', '', '2017-02-24 11:49:23', '2017-03-24 11:27:31', 1, 1, 1, 0),
(7, 'Footer Menu', 'footer-menu', '', '2017-03-24 10:34:40', '2017-03-24 10:38:46', 1, 1, 1, 0),
(8, 'Latest Update Menu', 'latest-update-menu', '', '2017-03-24 11:26:28', '2017-03-25 11:55:09', 1, 1, 1, 0),
(9, 'Header Desktop Menu', 'header-desktop-menu', '', '2017-03-25 13:49:24', '2017-03-25 13:49:39', 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_menu_groups`
--
ALTER TABLE `sramcms_menu_groups`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_menu_groups`
--
ALTER TABLE `sramcms_menu_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
