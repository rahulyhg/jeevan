-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 28, 2017 at 09:19 AM
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
-- Table structure for table `sramcms_gallary_categories`
--

CREATE TABLE `sramcms_gallary_categories` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
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
(1, '2017-03-27 13:58:02', 1, '::1', '2017-03-27 14:19:24', 1, '::1', 'asdasdasd', 'asdasdasd', 'asdasdasdasdasdasdasdasdaasd as da sd asd', 'gallery/categories/2017/03/3233e4e5ad30c887c7c06cebfa367234_1490617163.jpg', 1, 0),
(2, '2017-03-27 14:19:34', 1, '::1', '0000-00-00 00:00:00', 0, '', 'dfasda', 'dfasda', 'sdasdasd', 'gallery/categories/2017/03/397995360-cute-couples-love-profile-pictures-for-display-profile_1490617173.jpg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_galleries`
--

CREATE TABLE `sramcms_galleries` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT, 
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `gallery_category_id` bigint(20) NOT NULL COMMENT 'Refer from gallery categories table',
  `media_type` int(11) NOT NULL COMMENT '1- Image 2 -Video 3-Video URL',
  `file_name` text NOT NULL,
  `created_on` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `created_ip` varchar(100) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `updated_ip` varchar(100) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_galleries`
--

INSERT INTO `sramcms_galleries` (`id`, `title`, `description`, `gallery_category_id`, `media_type`, `file_name`, `created_on`, `created_by`, `created_ip`, `updated_on`, `updated_by`, `updated_ip`, `is_delete`, `is_active`) VALUES
(2, 'asdasd', 'asdasdasd', 1, 1, 'gallery/medias/images/2017/03/1120520_1490683966.jpg', '2017-03-27 16:23:10', 1, '::1', '2017-03-28 09:08:44', 1, '::1', 0, 1),
(3, 'asdasd', 'asdasd', 1, 1, 'gallery/medias/images/2017/03/HTB1XyudLXXXXXa4XpXXq6xXFXXXd_1490624716.jpg', '2017-03-27 16:25:25', 1, '::1', '2017-03-28 09:08:44', 1, '', 0, 1),
(4, 'asdasd', 'asdasd', 1, 2, 'gallery/medias/videos/2017/03/Wildlife_1490625026.wmv', '2017-03-27 16:30:28', 1, '::1', '2017-03-28 09:08:44', 1, '', 0, 1),
(5, 'asdasd', 'asdasd', 2, 1, 'gallery/medias/images/2017/03/Text_Over_Photo1480126912499_1490625183.jpg', '2017-03-27 16:33:05', 1, '::1', '2017-03-28 09:08:28', 1, '', 0, 1),
(6, 'asdasd', 'asdasdasdasd', 1, 1, 'gallery/medias/images/2017/03/Barbie-Doll-21_1490684378.jpg', '2017-03-28 07:55:38', 1, '::1', '2017-03-28 09:08:44', 1, '::1', 0, 1),
(7, 'asdasdasd', 'asdasdasd', 1, 3, 'https://www.youtube.com/watch?v=tSQSh0Qgm1Y', '2017-03-28 07:56:39', 1, '::1', '2017-03-28 09:08:44', 1, '::1', 0, 1),
(8, 'asdasd', 'asdasd', 1, 1, 'gallery/medias/images/2017/03/Full-HD-with-hd-love_1490681314.jpg', '2017-03-28 08:09:20', 1, '::1', '2017-03-28 09:08:44', 1, '', 0, 1),
(9, 'ewrwer', 'werwerwer', 2, 1, 'gallery/medias/images/2017/03/397995360-cute-couples-love-profile-pictures-for-display-profile_1490684788.jpg', '2017-03-28 09:06:30', 1, '::1', '2017-03-28 09:08:18', 1, '', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_gallary_categories`
--
ALTER TABLE `sramcms_gallary_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sramcms_galleries`
--
ALTER TABLE `sramcms_galleries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_gallary_categories`
--
ALTER TABLE `sramcms_gallary_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sramcms_galleries`
--
ALTER TABLE `sramcms_galleries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
