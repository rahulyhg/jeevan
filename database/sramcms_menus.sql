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
-- Table structure for table `sramcms_menus`
--

DROP TABLE IF EXISTS `sramcms_menus`;
CREATE TABLE `sramcms_menus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `link_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'uri',
  `page_id` int(11) NOT NULL DEFAULT '0',
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `menu_group_id` int(11) NOT NULL DEFAULT '0',
  `position` int(5) NOT NULL DEFAULT '0',
  `target` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `extra_attributes` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `menu_class` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `is_parent` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sramcms_menus`
--

INSERT INTO `sramcms_menus` (`id`, `name`, `link_type`, `page_id`, `url`, `menu_group_id`, `position`, `target`, `extra_attributes`, `menu_class`, `parent_id`, `is_parent`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_active`, `is_delete`) VALUES
(1, 'About us', 'page', 1, '', 1, 0, '', 'test', 'menu_class', 0, 0, '2017-03-24 10:30:16', 1, '2017-03-24 11:45:16', 1, 0, 1),
(2, 'Corrections and Clarifications', 'page', 3, '', 1, 0, '', 'test', 'menu_class', 0, 0, '2017-03-24 10:30:30', 1, '2017-03-25 12:45:16', 1, 0, 1),
(3, 'Terms of Use and Disclaimer', 'page', 6, '', 1, 0, '', 'test', 'menu_class', 0, 0, '2017-03-24 10:32:23', 1, '2017-03-25 12:45:18', 1, 1, 1),
(4, 'About Us', 'page', 1, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 12:46:27', 1, '2017-03-25 13:47:05', 1, 1, 1),
(5, 'Corrections and Clarifications', 'page', 3, '', 1, 0, '_blank', '', '', 0, 0, '2017-03-25 12:46:54', 1, '2017-03-25 13:47:03', 1, 1, 1),
(6, 'Jobs', 'page', 5, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 12:47:10', 1, '2017-03-25 13:47:01', 1, 1, 1),
(7, 'Terms of Use and Disclaimer', 'page', 6, '', 1, 0, '_blank', '', '', 0, 0, '2017-03-25 12:47:26', 1, '2017-03-25 13:47:00', 1, 1, 1),
(8, 'Privacy Policy', 'page', 7, '', 1, 0, '_blank', '', '', 0, 0, '2017-03-25 12:47:43', 1, '2017-03-25 13:46:58', 1, 1, 1),
(9, 'About Us', 'page', 1, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 12:48:05', 1, '2017-03-25 13:49:44', 1, 1, 1),
(10, 'Corrections and Clarifications', 'page', 3, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 12:48:16', 1, '2017-03-25 13:49:46', 1, 1, 1),
(11, 'Jobs', 'page', 5, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 12:48:26', 1, '2017-03-25 13:49:48', 1, 1, 1),
(12, 'Terms of Use and Disclaimer', 'page', 6, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 12:48:40', 1, '2017-03-25 13:49:50', 1, 1, 1),
(13, 'Privacy Policy', 'page', 7, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 12:48:54', 1, '2017-03-25 13:49:51', 1, 1, 1),
(14, 'Jeevanachary’s interview with a noted news channel about founding an old age home in Ranchi,Jharkhan', 'custom_link', 0, 'https://www.youtube.com/watch?v=syrttPQtHc4', 8, 0, '_blank', '', '', 0, 0, '2017-03-25 12:49:45', 1, '0000-00-00 00:00:00', 0, 1, 0),
(15, 'Jeevanacharya at Bharat Gaurav Achievement Award 2016', 'custom_link', 0, 'https://www.youtube.com/watch?v=p53Vj_76Khc', 8, 0, '_blank', '', '', 0, 0, '2017-03-25 12:50:10', 1, '0000-00-00 00:00:00', 0, 1, 0),
(16, 'Hyderabad press meet – 2016', 'custom_link', 0, 'https://www.youtube.com/watch?v=YJeI1aNT664', 8, 0, '_blank', '', '', 0, 0, '2017-03-25 12:50:32', 1, '0000-00-00 00:00:00', 0, 1, 0),
(17, 'About Us', 'page', 1, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 13:47:28', 1, '0000-00-00 00:00:00', 0, 1, 0),
(18, 'Way Of Life', 'page', 2, '', 1, 0, '_blank', '', '', 0, 0, '2017-03-25 13:47:38', 1, '0000-00-00 00:00:00', 0, 1, 0),
(19, 'Program', 'page', 3, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 13:47:53', 1, '0000-00-00 00:00:00', 0, 1, 0),
(20, 'Watch', 'page', 4, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 13:48:14', 1, '0000-00-00 00:00:00', 0, 1, 0),
(21, 'Media', 'page', 5, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 13:48:24', 1, '0000-00-00 00:00:00', 0, 1, 0),
(22, 'Ashiram', 'page', 6, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 13:48:37', 1, '0000-00-00 00:00:00', 0, 1, 0),
(23, 'Contact us', 'page', 7, '', 1, 0, '_top', '', '', 0, 0, '2017-03-25 13:48:54', 1, '0000-00-00 00:00:00', 0, 1, 0),
(24, 'About Us', 'page', 1, '', 7, 0, '_top', '', '', 0, 0, '2017-03-25 13:50:46', 1, '0000-00-00 00:00:00', 0, 1, 0),
(25, 'Way Of Life', 'page', 2, '', 7, 0, '_top', '', '', 0, 0, '2017-03-25 13:51:17', 1, '0000-00-00 00:00:00', 0, 1, 0),
(26, 'Program', 'page', 3, '', 7, 0, '_top', '', '', 0, 0, '2017-03-25 13:51:28', 1, '0000-00-00 00:00:00', 0, 1, 0),
(27, 'Watch', 'page', 4, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 13:54:06', 1, '0000-00-00 00:00:00', 0, 1, 0),
(28, 'Media', 'page', 5, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 13:54:25', 1, '0000-00-00 00:00:00', 0, 1, 0),
(29, 'Ashiram', 'page', 6, '', 7, 0, '_top', '', '', 0, 0, '2017-03-25 13:54:36', 1, '0000-00-00 00:00:00', 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_menus`
--
ALTER TABLE `sramcms_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_group_id - normal` (`menu_group_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_menus`
--
ALTER TABLE `sramcms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
