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
-- Table structure for table `sramcms_galleries`
--

DROP TABLE IF EXISTS `sramcms_galleries`;
CREATE TABLE `sramcms_galleries` (
  `id` bigint(20) NOT NULL,
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
(1, 'test image1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centurie', 1, 1, 'gallery/medias/images/2017/03/Gurujee_01_1490705841.png', '2017-03-28 14:57:23', 1, '::1', '0000-00-00 00:00:00', 0, '', 0, 1),
(2, 'test image2', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centurie', 1, 1, 'gallery/medias/images/2017/03/guru1_1490705866.png', '2017-03-28 14:57:48', 1, '::1', '0000-00-00 00:00:00', 0, '', 0, 1),
(3, 'test Video Url1', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centurie', 1, 3, 'https://www.youtube.com/embed/IJhAlI3cO18', '2017-03-28 14:59:13', 1, '::1', '0000-00-00 00:00:00', 0, '', 0, 1),
(4, 'test Video path', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centurie', 1, 2, 'gallery/medias/videos/2017/03/videoplayback_1_1490705980.mp4', '2017-03-28 14:59:43', 1, '::1', '0000-00-00 00:00:00', 0, '', 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_galleries`
--
ALTER TABLE `sramcms_galleries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_galleries`
--
ALTER TABLE `sramcms_galleries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
