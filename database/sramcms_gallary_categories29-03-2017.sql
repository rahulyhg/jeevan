-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 07:30 AM
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
-- Table structure for table `sramcms_gallary_categories`
--

DROP TABLE IF EXISTS `sramcms_gallary_categories`;
CREATE TABLE `sramcms_gallary_categories` (
  `id` bigint(20) NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_ip` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_ip` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `category_image` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_gallary_categories`
--

INSERT INTO `sramcms_gallary_categories` (`id`, `created_on`, `created_by`, `created_ip`, `updated_on`, `updated_by`, `updated_ip`, `name`, `slug`, `description`, `category_image`, `is_active`, `is_delete`) VALUES
(1, '2017-03-28 12:41:49', 1, '::1', '0000-00-00 00:00:00', 0, '', 'Jeevanachary’s interview with a noted news channel about founding an old age home in Ranchi, Jharkhand', 'jeevanacharys-interview-with-a-noted-news-channel-about-founding-an-old-age-home-in-ranchi-jharkhand', 'Jeevanachary’s interview with a noted news channel about founding an old age home in Ranchi, Jharkhand', 'gallery/categories/2017/03/jeevan1_1490697707.jpg', 1, 0),
(2, '2017-03-28 12:42:09', 1, '::1', '0000-00-00 00:00:00', 0, '', 'Jeevanacharya at Bharat Gaurav Achievement Award 2016', 'jeevanacharya-at-bharat-gaurav-achievement-award-2016', 'Jeevanacharya at Bharat Gaurav Achievement Award 2016', 'gallery/categories/2017/03/jeevan2_1490697728.jpg', 1, 0),
(3, '2017-03-28 12:42:31', 1, '::1', '0000-00-00 00:00:00', 0, '', 'Hyderabad press meet – 2016', 'hyderabad-press-meet-2016', 'Hyderabad press meet – 2016', 'gallery/categories/2017/03/jeevan3_1490697749.jpg', 1, 0),
(4, '2017-03-28 12:43:29', 1, '::1', '0000-00-00 00:00:00', 0, '', 'Jeevancharya Daily Message', 'jeevancharya-daily-message', 'Jeevancharya Daily Message', 'gallery/categories/2017/03/jeevan4_1490697808.jpg', 1, 0),
(5, '2017-03-28 12:45:29', 1, '::1', '0000-00-00 00:00:00', 0, '', 'Jeevanacharya Video', 'jeevanacharya-video', 'Jeevanacharya Video', 'gallery/categories/2017/03/mediab1_1490697926.png', 1, 0),
(6, '2017-03-28 12:45:49', 1, '::1', '0000-00-00 00:00:00', 0, '', 'JyotishSashtra', 'jyotishsashtra', 'JyotishSashtra', 'gallery/categories/2017/03/mediab2_1490697947.png', 1, 0),
(7, '2017-03-28 12:46:15', 1, '::1', '0000-00-00 00:00:00', 0, '', 'Way of Life', 'way-of-life', 'Way of Life', 'gallery/categories/2017/03/mediab3_1490697973.png', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_gallary_categories`
--
ALTER TABLE `sramcms_gallary_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_gallary_categories`
--
ALTER TABLE `sramcms_gallary_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
