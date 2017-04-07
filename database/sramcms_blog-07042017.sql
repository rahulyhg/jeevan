-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2017 at 02:49 PM
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
-- Table structure for table `sramcms_blog`
--

DROP TABLE IF EXISTS `sramcms_blog`;
CREATE TABLE `sramcms_blog` (
  `id` int(11) NOT NULL,
  `blog_title` varchar(255) NOT NULL,
  `blog_slug` varchar(255) NOT NULL,
  `blog_shortdesc` varchar(255) NOT NULL,
  `blog_description` text NOT NULL,
  `blog_image` text NOT NULL,
  `author` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `created` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_blog`
--

INSERT INTO `sramcms_blog` (`id`, `blog_title`, `blog_slug`, `blog_shortdesc`, `blog_description`, `blog_image`, `author`, `is_active`, `is_delete`, `created`) VALUES
(1, 'JEEVANACHARYA - JYOTISH &ADHYATMA KENDRA WPAJTRUST(REG.80G)', 'jeevanacharya-jyotish-adhyatma-kendra-wpajtrust-reg-80g', 'The WPAJT (World Peace & Adhyatma Jyotish Trust) works towards the betterment of humanity and global harmony. Its two pronged approach aimed at development and charitable activities has been a source of inspiration for many and therefore has been att', '<p>The WPAJT (World Peace &amp; Adhyatma Jyotish Trust) works towards the betterment of humanity and global harmony. Its two pronged approach aimed at development and charitable activities has been a source of inspiration for many and therefore has been attracting alms and financial assistance from like-minded corporate giants, individuals and celebrities. Located and effectively operating from Mumbai &ndash; the financial hub of India, this registered trust accepts generous financial support and offers tax exemption to all its contributors under the 80G clause.</p>\r\n', 'iy4IWGYwNzoD0m5vaQEZcbAUPT9n6OpuS7lRLKBjkxtJX81Hdg.png', 'Admin Master', 1, 0, '2017-04-07'),
(2, 'JEEVANACHARYA – ANCIENT HANDWRITTEN RAVAN SANHITA', 'jeevanacharya-ancient-handwritten-ravan-sanhita', 'Jeevanacharya hails the ancient handwritten scripture called Ravan Sanhita that talks about the various facets of astrology and tantric practices honed by Ravana – the demon king who ruled lanka as mentioned in the great epic “Ramayana”. Gurujee’s po', '<p>Jeevanacharya hails the ancient handwritten scripture called Ravan Sanhita that talks about the various facets of astrology and tantric practices honed by Ravana &ndash; the demon king who ruled lanka as mentioned in the great epic &ldquo;Ramayana&rdquo;. Gurujee&rsquo;s positive thinking and approach sees the key points and wisdom the scripture offers for instilling and fortifying the confidence and performance of the masses. Click on the link to know more.</p>\r\n', 'r8epB4gXbcPdCG7NuOzsywYfA51W0ThKvILnSVjHZQlE9oMi2t.png', 'Admin Master', 1, 0, '2017-04-07');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
