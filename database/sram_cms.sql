-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2017 at 07:40 AM
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
CREATE DATABASE IF NOT EXISTS `sram_cms` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sram_cms`;

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_blocks`
--

CREATE TABLE `sramcms_blocks` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `is_mobile` tinyint(1) NOT NULL,
  `page` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `display` tinyint(2) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL,
  `sort` tinyint(2) NOT NULL,
  `params` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sramcms_blocks`
--

INSERT INTO `sramcms_blocks` (`id`, `title`, `slug`, `is_mobile`, `page`, `position`, `type`, `display`, `is_active`, `is_delete`, `order`, `sort`, `params`, `created`, `modified`) VALUES
(9, 'Mobile Menus', '', 0, 'all', 'site_header', 'menus', 0, 1, 0, 1, 0, '{"menu_group":"1","menus_views":"header","menus_templates":"headermenu","css_id":""}', '2017-03-25 13:57:18', '2017-03-25 13:57:18'),
(10, 'Desktop Menus', '', 0, 'all', 'site_header_desktop', 'menus', 0, 1, 0, 1, 0, '{"menu_group":"1","menus_views":"header","menus_templates":"leftmenusection","css_id":""}', '2017-03-25 13:58:04', '2017-03-25 13:58:04'),
(11, 'Latest Update', '', 0, 'frontend/frontend/index', 'site_latest', 'menus', 1, 1, 0, 1, 0, '{"menu_group":"8","menus_views":"latestupdate","menus_templates":"latestupdate","css_id":""}', '2017-03-25 13:58:44', '2017-03-25 13:58:44'),
(12, 'Quick Links', '', 0, 'all', 'site_footer', 'menus', 0, 1, 0, 2, 0, '{"menu_group":"7","menus_views":"footer","menus_templates":"footermenu","css_id":""}', '2017-03-25 13:59:13', '2017-03-25 13:59:13'),
(13, 'Category', '', 0, 'all', 'site_footer', 'menus', 0, 1, 0, 3, 0, '{"menu_group":"7","menus_views":"footer","menus_templates":"footermenu","css_id":""}', '2017-03-25 14:08:50', '2017-03-25 14:08:50'),
(16, 'Jeevanacharya', '', 0, 'all', 'site_footer', 'textwidgets', 0, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_section\\">\\r\\n<h3><a href=\\"index.php\\">JEEVANACHARYA<\\/a><\\/h3>\\r\\n\\r\\n<p>Jeevanacharya is an embodiment of the almighty himself, who through his awakened self sees the almighty in all hence shows the right &lsquo;way of life&rsquo; to overcome misery or problems of all kinds. His personalized and meticulous approach towards remedial measures and selfless attitude has won him accolades and repute from all quarters of the globe.<\\/p>\\r\\n\\r\\n<div class=\\"col-xs-12 social\\">\\r\\n<h3>FOLLOW US ON<\\/h3>\\r\\n\\r\\n<ul>\\r\\n\\t<li class=\\"animated zoomIn\\">&nbsp;<\\/li>\\r\\n\\t<li class=\\"animated zoomIn\\">&nbsp;<\\/li>\\r\\n\\t<li class=\\"animated zoomIn\\">&nbsp;<\\/li>\\r\\n\\t<li class=\\"animated zoomIn\\">&nbsp;<\\/li>\\r\\n<\\/ul>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:14:46', '2017-03-25 14:14:46'),
(17, 'Twitter Feed', '', 0, 'all', 'site_footer', 'textwidgets', 0, 1, 0, 4, 0, '{"text_content":"<div class=\\"col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_section3\\">\\r\\n<h3>TWITTER FEED<\\/h3>\\r\\n<a class=\\"twitter-timeline\\" data-height=\\"280\\" data-theme=\\"dark\\" data-width=\\"280\\" href=\\"https:\\/\\/twitter.com\\/JeevanacharyaG\\">Tweets by JeevanacharyaG<\\/a> <script async src=\\"\\/\\/platform.twitter.com\\/widgets.js\\" charset=\\"utf-8\\"><\\/script>\\r\\n\\r\\n<div class=\\"tweets_hide\\">&nbsp;<\\/div>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:15:46', '2017-03-25 14:15:46'),
(18, 'Copyright', '', 0, 'all', 'site_copyright', 'textwidgets', 0, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-12 col-md-12 col-sm-12 col-xs-12 copyright\\">\\r\\n<p>JEEVANACHARYA &copy; 2017. ALL RIGHT RESERVED<\\/p>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:20:46', '2017-03-25 14:20:46'),
(19, 'About Short Description Home Page', '', 0, 'frontend/frontend/index', 'content_left', 'textwidgets', 1, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-6 col-md-6 col-sm-6 col-xs-12\\">\\r\\n<h2>About Jeevanacharya<\\/h2>\\r\\n\\r\\n<p>Shri Kumaran Swami Gurujee is a Visionary and a spiritual leader, who dedicated himself to serve the mankind. With his uncommon spiritual gifts and extrasensory power he transforms his devotees spiritually, mentally and physically stronger, which over the years, have earned him worldwide fame and respect.When he travelled across the globe, he was able to see the sufferings of people and understood their problems with his unique instinct. He had mastered himself in studies of Jyotish and Vastu Shastra with his sharp analytical abilities.<\\/p>\\r\\n<a class=\\"read_buuton\\" href=\\"javascript:void(0)\\">READ MORE<\\/a><\\/div>\\r\\n","css_id":""}', '2017-03-25 14:30:29', '2017-03-25 14:30:29'),
(21, 'Home Page Newsletter Content', '', 0, 'frontend/frontend/index', 'content_newsletter', 'textwidgets', 1, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-4 col-md-4 col-sm-4 col-xs-12 news_content\\">\\r\\n<h3>JyotishSashtra<\\/h3>\\r\\n\\r\\n<p>In Vedas, JyotishSashtra is descrided as &quot;third eye&quot; in which there is an unification of all Tenses (Past, Present &amp; Future).Therefore Jyotish may be regarded as &#39;Astrology&#39;, We have certain rules, Principles etc and each and every step taken is very much systematic so, It is a science.Art is a way of doing work with experience and dexterity.<\\/p>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:37:58', '2017-03-25 14:37:58'),
(22, 'JyotishSashtra', '', 0, 'frontend/frontend/index', 'content_newsletter', 'textwidgets', 1, 1, 0, 2, 0, '{"text_content":"<div class=\\"col-lg-3 col-md-3 col-sm-3 col-xs-12 chakra text-center\\"><img alt=\\"\\" src=\\"\\/assets\\/admin\\/js\\/ckfinder\\/userfiles\\/images\\/1.png\\" style=\\"width: 189px; height: 117px;\\" \\/><\\/div>\\r\\n","css_id":""}', '2017-03-25 14:53:15', '2017-03-25 14:53:15'),
(23, 'Way Of Life', '', 0, 'frontend/frontend/index', 'way_circle', 'wayoflife', 1, 1, 0, 1, 0, '{"wayoflife_view":"wayoflife","css_id":""}', '2017-03-25 15:16:53', '2017-03-25 15:16:53'),
(24, 'Jeevanacharya Location', '', 0, 'frontend/frontend/index', 'content_left', 'textwidgets', 1, 1, 0, 2, 0, '{"text_content":"<div class=\\"col-lg-6 col-md-6 col-sm-6 col-xs-12 map_section pop_up\\">\\r\\n<h4>Jeevanacharya Location<\\/h4>\\r\\n<button class=\\"btn btn-primary\\" data-target=\\"#myModal1\\" data-toggle=\\"modal\\" type=\\"button\\">Get your Appointment<\\/button><iframe allowfullscreen=\\"\\" frameborder=\\"0\\" height=\\"200\\" src=\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d30676638.056241818!2d64.43991442110328!3d20.18793007578521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1487134429231\\" style=\\"border:0\\" width=\\"100%\\"><\\/iframe><\\/div>\\r\\n","css_id":""}', '2017-03-25 15:22:35', '2017-03-25 15:22:35'),
(25, 'Home Newsletter', '', 0, 'frontend/frontend/index', 'content_newsletter', 'newsletter', 1, 1, 1, 3, 0, '{"newsletter_view":"newsletter","newsletter_title":"News Letter","newsletter_subtitle":"Enter your email for updates about news in Axemplate","newsletter_email":"info@jeevanacharya.com","newsletter_icon":"show","css_id":""}', '2017-03-25 15:43:07', '2017-03-25 15:45:22'),
(26, 'Home Newsletter', '', 0, 'frontend/frontend/index', 'content_newsletter', 'newsletter', 1, 1, 0, 3, 0, '{"newsletter_view":"newsletter","newsletter_title":"News Letter","newsletter_subtitle":"Enter your email for updates about news in Axemplate","newsletter_email":"info@jeevanacharya.com","newsletter_icon":"show","newsletter_button":"Subcribe","css_id":""}', '2017-03-25 15:46:30', '2017-03-25 15:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_cms_pages`
--

CREATE TABLE `sramcms_cms_pages` (
  `id` int(11) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_description` longtext NOT NULL,
  `page_image` varchar(255) NOT NULL,
  `page_meta_title` varchar(255) NOT NULL,
  `page_meta_keyword` varchar(255) NOT NULL,
  `page_meta_description` varchar(255) NOT NULL,
  `page_template` varchar(55) NOT NULL DEFAULT 'full-width',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_delete` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_cms_pages`
--

INSERT INTO `sramcms_cms_pages` (`id`, `page_title`, `page_slug`, `page_description`, `page_image`, `page_meta_title`, `page_meta_keyword`, `page_meta_description`, `page_template`, `is_active`, `is_delete`, `created`, `created_ip`, `modified`, `modified_ip`) VALUES
(1, 'About Us', 'about-us', '<p>testing about us</p>\r\n', '', 'testing about us', 'testing about us', 'testing about us', 'full-width', 1, 0, '2017-03-25 13:44:00', '', '0000-00-00 00:00:00', ''),
(2, 'Way Of Life', 'way-of-life', '<p>testing&nbsp;way Of Life</p>\r\n', '', 'testing way Of Life', 'testing way Of Life', 'testing way Of Life', 'full-width', 1, 0, '2017-03-25 13:44:44', '', '0000-00-00 00:00:00', ''),
(3, 'Program', 'program', '<p>testing program</p>\r\n', '', 'testing program', 'testing program', 'testing program', 'full-width', 1, 0, '2017-03-25 13:45:10', '', '0000-00-00 00:00:00', ''),
(4, 'Watch', 'watch', '<p>testing watch</p>\r\n', '', 'testing watch', 'testing watch', 'testing watch', 'full-width', 1, 0, '2017-03-25 13:45:31', '', '0000-00-00 00:00:00', ''),
(5, 'Media', 'media', '<p>testing media</p>\r\n', '', 'testing media', 'testing media', 'testing media', 'full-width', 1, 0, '2017-03-25 13:45:50', '', '0000-00-00 00:00:00', ''),
(6, 'Ashiram', 'ashiram', '<p>testing&nbsp;Ashiram</p>\r\n', '', 'testing Ashiram', 'testing Ashiram', 'testing Ashiram', 'full-width', 1, 0, '2017-03-25 13:46:15', '', '0000-00-00 00:00:00', ''),
(7, 'Contact us', 'contact-us', '<p>testing&nbsp;Contact us</p>\r\n', '', 'testing Contact us', 'testing Contact us', 'testing Contact us', 'full-width', 1, 0, '2017-03-25 13:46:34', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_log`
--

CREATE TABLE `sramcms_log` (
  `id` bigint(20) NOT NULL,
  `created` datetime NOT NULL,
  `msg` text NOT NULL,
  `type` varchar(255) NOT NULL,
  `action_type_id` int(11) NOT NULL COMMENT '1=>Add,2=>Edit,3=>Delete,4=>Status change',
  `login_id` bigint(20) NOT NULL,
  `ip_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_log`
--

INSERT INTO `sramcms_log` (`id`, `created`, `msg`, `type`, `action_type_id`, `login_id`, `ip_address`) VALUES
(1, '2017-03-24 11:16:22', 'A Menu Groups  has been edited by admin :', 'Menu Groups', 2, 1, '::1'),
(2, '2017-03-24 11:17:13', 'A Menu Groups  has been edited by admin :', 'Menu Groups', 2, 1, '::1'),
(3, '2017-03-24 11:17:43', 'A Menu Groups  has been edited by admin :tksubhashraj14@gmail.com', 'Menu Groups', 2, 1, '::1'),
(4, '2017-03-24 11:17:49', 'A Menu Groups  has been edited by admin :tksubhashraj14@gmail.com', 'Menu Groups', 2, 1, '::1'),
(5, '2017-03-24 11:17:56', 'A Menu Groups  has been edited by admin :tksubhashraj14@gmail.com', 'Menu Groups', 2, 1, '::1'),
(6, '2017-03-24 11:18:03', 'A Menus About us has been edited by admin :tksubhashraj14@gmail.com', 'Menus', 2, 1, '::1'),
(7, '2017-03-24 11:18:11', 'A Menus About us has been edited by admin :tksubhashraj14@gmail.com', 'Menus', 2, 1, '::1'),
(8, '2017-03-24 11:18:26', 'A Menus  has been edited by admin :tksubhashraj14@gmail.com', 'Menus', 2, 1, '::1'),
(9, '2017-03-24 11:18:35', 'A Menus About us has been edited by admin :tksubhashraj14@gmail.com', 'Menus', 2, 1, '::1'),
(10, '2017-03-24 11:18:43', 'A Menus  has been edited by admin :tksubhashraj14@gmail.com', 'Menus', 2, 1, '::1'),
(11, '2017-03-24 11:20:22', 'A Menus About us has been Deactivated  by admin :tksubhashraj14@gmail.com', 'Menus', 4, 1, '::1'),
(12, '2017-03-24 11:20:34', 'A Menus About us has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(13, '2017-03-24 11:26:28', 'A New Menu Groups Fooadasd asdasdasd has been added by admin :tksubhashraj14@gmail.com', 'Menu Groups', 1, 1, '::1'),
(14, '2017-03-24 11:26:32', 'A Menu Groups  has been deleted  by admin :tksubhashraj14@gmail.com', 'Menu Groups', 3, 1, '::1'),
(15, '2017-03-24 11:26:53', 'A Menu Groups  has been deleted  by admin :tksubhashraj14@gmail.com', 'Menu Groups', 3, 1, '::1'),
(16, '2017-03-24 11:27:31', 'A Menu Groups Header Menu has been deleted  by admin :tksubhashraj14@gmail.com', 'Menu Groups', 3, 1, '::1'),
(17, '2017-03-24 11:29:15', 'A Menus About us has been Activated  by admin :tksubhashraj14@gmail.com', 'Menus', 4, 1, '::1'),
(18, '2017-03-24 11:40:30', 'A Menus About us has been Deactivated  by admin :tksubhashraj14@gmail.com', 'Menus', 4, 1, '::1'),
(19, '2017-03-24 11:41:08', 'A Menus Corrections and Clarifications has been Deactivated  by admin :tksubhashraj14@gmail.com', 'Menus', 4, 1, '::1'),
(20, '2017-03-24 11:41:25', 'A Menus Corrections and Clarifications has been Activated  by admin :tksubhashraj14@gmail.com', 'Menus', 4, 1, '::1'),
(21, '2017-03-24 11:41:55', 'A Menus Corrections and Clarifications has been Deactivated  by admin :tksubhashraj14@gmail.com', 'Menus', 4, 1, '::1'),
(22, '2017-03-24 11:45:16', 'A Menus About us has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(23, '2017-03-25 11:55:09', 'A Menu Groups  has been edited by admin :tksubhashraj14@gmail.com', 'Menu Groups', 2, 1, '::1'),
(24, '2017-03-25 12:45:16', 'A Menus Corrections and Clarifications has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(25, '2017-03-25 12:45:18', 'A Menus Terms of Use and Disclaimer has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(26, '2017-03-25 12:46:27', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(27, '2017-03-25 12:46:54', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(28, '2017-03-25 12:47:10', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(29, '2017-03-25 12:47:26', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(30, '2017-03-25 12:47:43', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(31, '2017-03-25 12:48:05', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(32, '2017-03-25 12:48:16', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(33, '2017-03-25 12:48:26', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(34, '2017-03-25 12:48:40', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(35, '2017-03-25 12:48:54', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(36, '2017-03-25 12:49:45', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(37, '2017-03-25 12:50:10', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(38, '2017-03-25 12:50:32', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(39, '2017-03-25 13:46:58', 'A Menus Privacy Policy has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(40, '2017-03-25 13:47:00', 'A Menus Terms of Use and Disclaimer has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(41, '2017-03-25 13:47:02', 'A Menus Jobs has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(42, '2017-03-25 13:47:03', 'A Menus Corrections and Clarifications has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(43, '2017-03-25 13:47:05', 'A Menus About Us has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(44, '2017-03-25 13:47:28', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(45, '2017-03-25 13:47:39', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(46, '2017-03-25 13:47:53', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(47, '2017-03-25 13:48:14', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(48, '2017-03-25 13:48:24', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(49, '2017-03-25 13:48:37', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(50, '2017-03-25 13:48:54', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(51, '2017-03-25 13:49:24', 'A New Menu Groups Header Desktop Menu has been added by admin :tksubhashraj14@gmail.com', 'Menu Groups', 1, 1, '::1'),
(52, '2017-03-25 13:49:39', 'A Menu Groups Header Desktop Menu has been deleted  by admin :tksubhashraj14@gmail.com', 'Menu Groups', 3, 1, '::1'),
(53, '2017-03-25 13:49:44', 'A Menus About Us has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(54, '2017-03-25 13:49:46', 'A Menus Corrections and Clarifications has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(55, '2017-03-25 13:49:48', 'A Menus Jobs has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(56, '2017-03-25 13:49:50', 'A Menus Terms of Use and Disclaimer has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(57, '2017-03-25 13:49:51', 'A Menus Privacy Policy has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(58, '2017-03-25 13:50:46', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(59, '2017-03-25 13:51:17', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(60, '2017-03-25 13:51:29', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(61, '2017-03-25 13:54:07', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(62, '2017-03-25 13:54:25', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(63, '2017-03-25 13:54:36', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_master_admin`
--

CREATE TABLE `sramcms_master_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(100) DEFAULT NULL,
  `admin_email_address` varchar(100) DEFAULT NULL,
  `admin_password` varchar(155) DEFAULT NULL,
  `admin_status` enum('A','I') NOT NULL DEFAULT 'I',
  `admin_pass_key` varchar(50) DEFAULT NULL,
  `admin_updated_on` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_master_admin`
--

INSERT INTO `sramcms_master_admin` (`admin_id`, `admin_username`, `admin_email_address`, `admin_password`, `admin_status`, `admin_pass_key`, `admin_updated_on`) VALUES
(1, 'admin', 'tksubhashraj14@gmail.com', '$2a$08$RLbVYes/SDUgUxbwxAbgX.FAyPqFX5ZgkEtJmRD4UkgSkYm0S4kS.', 'A', NULL, '2016-02-02 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_master_admin_login_history`
--

CREATE TABLE `sramcms_master_admin_login_history` (
  `login_id` bigint(20) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `login_ip` varchar(20) DEFAULT NULL,
  `login_admin_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_master_admin_login_history`
--

INSERT INTO `sramcms_master_admin_login_history` (`login_id`, `login_time`, `login_ip`, `login_admin_id`) VALUES
(12, '2016-02-19 13:10:46', '::1', 1),
(13, '2016-02-19 13:48:45', '::1', 1),
(14, '2016-02-19 15:36:28', '::1', 1),
(15, '2016-02-20 06:55:26', '::1', 1),
(16, '2016-02-20 10:45:49', '::1', 1),
(17, '2016-02-20 10:48:13', '::1', 1),
(18, '2016-02-22 06:16:15', '::1', 1),
(19, '2016-02-22 07:59:41', '::1', 1),
(20, '2016-02-22 10:05:35', '192.168.2.65', 1),
(21, '2016-02-22 14:44:36', '127.0.0.1', 1),
(22, '2016-02-22 14:57:39', '127.0.0.1', 1),
(23, '2016-02-22 10:52:19', '::1', 1),
(24, '2016-02-22 10:52:55', '::1', 1),
(25, '2016-02-22 10:53:28', '::1', 1),
(26, '2016-02-22 10:55:29', '::1', 1),
(27, '2016-02-22 10:55:49', '::1', 1),
(28, '2016-02-22 15:41:23', '127.0.0.1', 1),
(29, '2016-02-23 05:42:04', '192.168.2.69', 1),
(30, '2016-02-23 06:35:16', '192.168.2.69', 1),
(31, '2016-02-23 06:38:49', '192.168.2.69', 1),
(32, '2016-02-24 05:58:47', '::1', 1),
(33, '2016-02-24 06:05:36', '::1', 1),
(34, '2016-02-24 06:06:08', '::1', 1),
(35, '2016-02-24 06:07:19', '::1', 1),
(36, '2016-02-24 10:17:29', '::1', 1),
(37, '2016-02-24 10:45:13', '192.168.2.113', 1),
(38, '2016-02-24 11:04:21', '::1', 1),
(39, '2016-02-24 11:21:19', '::1', 1),
(40, '2016-02-24 11:54:32', '192.168.2.113', 1),
(41, '2016-02-24 11:56:30', '192.168.2.113', 1),
(42, '2016-02-24 12:02:27', '192.168.2.113', 1),
(43, '2016-02-24 12:50:55', '::1', 1),
(44, '2016-02-24 13:00:39', '192.168.2.113', 1),
(45, '2016-02-24 13:02:58', '192.168.2.113', 1),
(46, '2016-02-24 13:03:23', '192.168.2.113', 1),
(47, '2016-02-24 13:09:58', '192.168.2.113', 1),
(48, '2016-02-24 13:11:38', '192.168.2.113', 1),
(49, '2016-02-24 14:01:35', '192.168.2.113', 1),
(50, '2016-02-24 15:04:45', '192.168.2.113', 1),
(51, '2016-02-24 15:08:49', '192.168.2.113', 1),
(52, '2016-02-24 15:30:37', '192.168.2.113', 1),
(53, '2016-02-25 06:17:48', '::1', 1),
(54, '2016-02-25 06:21:35', '192.168.2.113', 1),
(55, '2016-02-25 07:28:55', '192.168.2.65', 1),
(56, '2016-02-25 08:17:53', '192.168.2.65', 1),
(57, '2016-02-25 08:39:54', '192.168.2.113', 1),
(58, '2016-02-25 09:43:07', '192.168.2.65', 1),
(59, '2016-02-25 10:52:51', '192.168.2.113', 1),
(60, '2016-02-25 13:21:58', '192.168.2.113', 1),
(61, '2016-02-25 15:21:06', '::1', 1),
(62, '2016-02-26 06:06:42', '::1', 1),
(63, '2016-02-26 06:20:21', '::1', 1),
(64, '2016-02-26 13:02:30', '127.0.0.1', 1),
(65, '2016-02-26 09:08:35', '192.168.2.65', 1),
(66, '2016-03-01 05:13:55', '::1', 1),
(67, '2016-03-01 07:21:24', '::1', 1),
(68, '2016-03-01 07:39:01', '::1', 1),
(69, '2016-03-01 08:04:48', '::1', 1),
(70, '2016-03-01 18:08:43', '::1', 1),
(71, '2016-03-02 16:36:24', '::1', 1),
(72, '2016-03-02 16:54:53', '::1', 1),
(73, '2016-03-02 18:30:56', '::1', 1),
(74, '2016-03-03 03:19:57', '::1', 1),
(75, '2016-03-03 14:23:46', '::1', 1),
(76, '2016-03-04 04:45:31', '::1', 1),
(77, '2016-03-04 17:30:19', '::1', 1),
(78, '2016-03-04 17:35:52', '::1', 1),
(79, '2016-03-04 20:19:00', '::1', 1),
(80, '2016-03-05 02:26:54', '::1', 1),
(81, '2016-03-05 17:46:16', '::1', 1),
(82, '2016-03-05 19:09:20', '1.39.60.155', 1),
(83, '2016-03-06 10:58:12', '1.39.63.182', 1),
(84, '2016-03-06 19:30:15', '1.39.60.147', 1),
(85, '2016-03-06 19:48:54', '1.39.60.147', 1),
(86, '2016-03-06 20:01:04', '175.136.214.244', 1),
(87, '2016-03-06 21:09:04', '1.39.63.170', 1),
(88, '2016-03-06 22:03:10', '1.39.60.77', 1),
(89, '2016-03-07 00:46:27', '1.39.60.77', 1),
(90, '2016-03-12 09:40:46', '1.39.80.35', 1),
(91, '2016-03-21 09:01:54', '113.193.147.168', 1),
(92, '2016-03-25 05:18:47', '60.52.64.71', 1),
(93, '2016-04-07 04:26:25', '14.140.167.94', 1),
(94, '2016-07-27 13:29:08', '122.174.67.249', 1),
(95, '2016-07-27 14:07:12', '108.247.232.35', 1),
(96, '2016-10-19 04:32:13', '182.65.99.183', 1),
(97, '2016-11-09 06:07:32', '::1', 1),
(98, '2017-03-13 11:09:31', '::1', 1),
(99, '2017-03-14 06:05:32', '::1', 1),
(100, '2017-03-14 08:29:23', '::1', 1),
(101, '2017-03-14 08:46:02', '::1', 1),
(102, '2017-03-23 11:02:13', '::1', 1),
(103, '2017-03-23 12:45:46', '::1', 1),
(104, '2017-03-23 13:16:20', '::1', 1),
(105, '2017-03-23 13:38:24', '::1', 1),
(106, '2017-03-24 06:32:55', '::1', 1),
(107, '2017-03-24 06:37:58', '::1', 1),
(108, '2017-03-24 06:42:24', '::1', 1),
(109, '2017-03-24 07:45:00', '::1', 1),
(110, '2017-03-24 10:05:03', '::1', 1),
(111, '2017-03-24 11:46:40', '::1', 1),
(112, '2017-03-25 06:15:31', '::1', 1),
(113, '2017-03-25 10:29:06', '::1', 1),
(114, '2017-03-25 11:26:39', '::1', 1),
(115, '2017-03-27 07:12:48', '::1', 1),
(116, '2017-03-27 07:12:48', '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_menus`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_menu_groups`
--

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

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_site_setting`
--

CREATE TABLE `sramcms_site_setting` (
  `setting_id` int(11) NOT NULL,
  `setting_key` varchar(55) NOT NULL,
  `setting_value` text NOT NULL,
  `setting_modify_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_site_setting`
--

INSERT INTO `sramcms_site_setting` (`setting_id`, `setting_key`, `setting_value`, `setting_modify_date`) VALUES
(1, 'mail_from_name', 'jeevanacharya.com', '2017-03-24 07:42:32'),
(2, 'from_email', 'admin@jeevanacharya.com', '2017-03-24 07:42:32'),
(3, 'to_email', 'admin@jeevanacharya.com', '2017-03-24 07:42:32'),
(4, 'mail_subject', 'Welcome jeevanacharya.com', '2017-03-24 07:42:32'),
(5, 'email_template', 'Welcome jeevanacharya.com', '2017-03-24 07:42:32'),
(6, 'login_points', 'sdasd', '2017-03-24 07:42:32'),
(7, 'new_user_points', 'asdasd', '2017-03-24 07:42:32'),
(8, 'referral_points', 'asdasd', '2017-03-24 07:42:32'),
(9, 'referred_user_register_points', 'asdasd', '2017-03-24 07:42:32'),
(10, 'submit', 'Submit', '2017-03-24 07:42:32'),
(11, 'action', 'settings', '2017-03-24 07:42:32');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_users`
--

CREATE TABLE `sramcms_users` (
  `user_id` bigint(20) NOT NULL,
  `user_name` varchar(155) DEFAULT NULL,
  `user_username` varchar(255) DEFAULT NULL,
  `user_password` varchar(255) DEFAULT NULL,
  `user_email_address` varchar(255) DEFAULT NULL,
  `user_referral_id` varchar(255) DEFAULT NULL,
  `user_company_name` varchar(255) DEFAULT NULL,
  `user_address_line1` varchar(255) DEFAULT NULL,
  `user_address_line2` varchar(255) DEFAULT NULL,
  `user_postal_code` varchar(255) DEFAULT NULL,
  `user_info` text,
  `user_date_format` varchar(20) DEFAULT NULL,
  `user_profile_image` varchar(100) DEFAULT NULL,
  `user_credit_points` int(11) NOT NULL,
  `user_referred_by` int(11) DEFAULT NULL,
  `user_folder_name` varchar(50) DEFAULT NULL,
  `user_brand_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_beacon_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_loyality_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_gift_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_whishlist_enable` tinyint(1) NOT NULL DEFAULT '0',
  `user_status` enum('A','I','D') NOT NULL DEFAULT 'I' COMMENT 'A-active, I- Inactive, D-Deleted',
  `user_created_on` datetime DEFAULT NULL,
  `user_created_ip` varchar(20) DEFAULT NULL,
  `user_updated_by` int(11) NOT NULL,
  `user_updated_on` datetime DEFAULT NULL,
  `user_updated_ip` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_users`
--

INSERT INTO `sramcms_users` (`user_id`, `user_name`, `user_username`, `user_password`, `user_email_address`, `user_referral_id`, `user_company_name`, `user_address_line1`, `user_address_line2`, `user_postal_code`, `user_info`, `user_date_format`, `user_profile_image`, `user_credit_points`, `user_referred_by`, `user_folder_name`, `user_brand_enable`, `user_beacon_enable`, `user_loyality_enable`, `user_gift_enable`, `user_whishlist_enable`, `user_status`, `user_created_on`, `user_created_ip`, `user_updated_by`, `user_updated_on`, `user_updated_ip`) VALUES
(32, 'mytest', 'mytest', '$2a$08$sACiqFX310nbuaLp6nfuFugrqOPRzM5VzWzVUoK1cr.T.y93ufuTu', 'mytest@gmail.com', '4F6C07F2', NULL, NULL, NULL, NULL, 'I am a Php developer', NULL, 'xCVglnYctXfkPHpJvNFK9AE16shwO5Gz87ToS4IuaZMWiLDd2r.jpg', 170, 0, 'f0Zkx1BMgqFRLG2O4uzTDltmHUEeWwa76cSVs5NyPhjn9KpIJA', 0, 0, 0, 0, 0, 'A', '2016-03-06 18:29:43', '1.39.60.147', 1, '2016-03-06 19:52:32', '1.39.60.147'),
(33, 'Subhash Raj', 'subhash', '$2a$08$TH0ZajfTLnjZBgCM5US/hujrqbItbPwrI01fkNWa/iHYfGXdgh.r.', 'tksubhashraj14@gmail.com', '5A5CA5DB', NULL, NULL, NULL, NULL, 'I am webdeveloper', NULL, 'WQ0H95ACu2qjyvgFRxL3KmesMtcDwaENdP1k8pIh6BlXOfGozZ.jpg', 80, 32, 'iSObeVLjgmT3ZGD9dqaPHMfCBkh5cyRznAJE0ItUvWQNw61rYo', 0, 0, 0, 0, 0, 'D', '2016-03-06 18:56:59', '1.39.60.147', 1, '2016-03-06 19:47:22', '1.39.60.147'),
(34, 'Test', 'tester', '$2a$08$DugIeYKxISG58iteGW4r/O1Eunj42jZrHhNHTK4TN3vh/VobrEZya', 'ain@justmobileinc.com', '8A424551', NULL, NULL, NULL, NULL, '', NULL, '', 100, 0, 'PmlSYpx9BMDq8jL5kbNaTzowG4i0KRVXhJOCF3dv7eAcr6UtsE', 0, 0, 0, 0, 0, 'A', '2016-03-06 20:02:37', '175.136.214.244', 1, '2016-11-09 06:13:39', '::1'),
(35, 'tester 2', 'tester2', '$2a$08$cHgVMvH2NcbYQTiZdftxqOWUbD7KoFf9tEk/Tfsix3FYBJyS1gZva', 'test@justmobileinc.com', '7FCF5F25', NULL, NULL, NULL, NULL, '', NULL, '', 50, 34, '4r5cQAa9qef6THyFv1mdNuRCpZxDOitYn8PsLjKhwoXIB7Vl20', 0, 0, 0, 0, 0, 'A', '2016-03-06 20:07:06', '175.136.214.244', 1, '2016-11-09 06:13:39', '::1'),
(36, 'vijayabharathi', 'bharathi', '$2a$08$DN0bYqz2kflnH/VUnO3QOutgthGVpGmlXPY2M9qWposBnf2M461Am', 'vijayabharathi91@gmail.com', '6DEFCE97', NULL, NULL, NULL, NULL, 'No one is going to hand me success. I must go out & get it myself.', NULL, 'iem904NfIKQs8tSB6p31WFYqJZGVbruLxOavzClw7jnoycHghR.jpg', 50, 0, 'vpu4TkHc02lnJM6ejqZULDXV3WmryOs1hoSG9xQPEFbRNBfA8I', 0, 0, 0, 0, 0, 'D', '2016-03-06 23:28:30', '122.174.182.118', 1, '2016-11-09 06:13:39', '::1'),
(37, 'Burhan', 'Khalib', '$2a$08$LKfkiW5Lb7yxG2/5VA0kqOUBfOqYrTkqDxXAq1aVkFuqMOESlH8pW', 'burhan@fanxt.com', '1F563298', NULL, NULL, NULL, NULL, 'great', NULL, 'J43rzDb8gPNivcwhI9TjA7fXy6toOR201EQlqVnapULZYsdWCM.png', 50, 0, 'thLGA0yFS91olVxs5KMOHY2fWm6vJqXaZTjpriezPEgBNdw7DC', 0, 0, 0, 0, 0, 'A', '2016-03-07 18:17:35', '175.136.214.244', 1, '2016-11-09 06:13:39', '::1'),
(38, 'subhash', 'subhashraj', '$2a$08$SHcm9nAIX6.V5ObHdYRiseAzPI.emCJ.x4S16LiGVp6gIHvmSWUPi', 'tksubhashraj124@gmail.com', 'EE067168', NULL, NULL, NULL, NULL, '', NULL, 'huEw69735pBVySLCZjdleosMFTnX1N2cQJfbYqOmvRG0iUgWK8.jpg', 140, 0, '0tgjhFdacrZTemfsHnQEAX9NvMGzYIbSB7kPRJ6i1LD2l5pWoV', 0, 0, 0, 0, 0, 'D', '2016-04-07 04:23:55', '14.140.167.94', 1, '2016-11-09 06:13:39', '::1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_blocks`
--
ALTER TABLE `sramcms_blocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sramcms_cms_pages`
--
ALTER TABLE `sramcms_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sramcms_log`
--
ALTER TABLE `sramcms_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sramcms_master_admin`
--
ALTER TABLE `sramcms_master_admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_username` (`admin_username`),
  ADD KEY `admin_password` (`admin_password`),
  ADD KEY `admin_ststus` (`admin_status`);

--
-- Indexes for table `sramcms_master_admin_login_history`
--
ALTER TABLE `sramcms_master_admin_login_history`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `sramcms_menus`
--
ALTER TABLE `sramcms_menus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_group_id - normal` (`menu_group_id`);

--
-- Indexes for table `sramcms_menu_groups`
--
ALTER TABLE `sramcms_menu_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sramcms_site_setting`
--
ALTER TABLE `sramcms_site_setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_blocks`
--
ALTER TABLE `sramcms_blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `sramcms_cms_pages`
--
ALTER TABLE `sramcms_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sramcms_log`
--
ALTER TABLE `sramcms_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
--
-- AUTO_INCREMENT for table `sramcms_master_admin`
--
ALTER TABLE `sramcms_master_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sramcms_master_admin_login_history`
--
ALTER TABLE `sramcms_master_admin_login_history`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT for table `sramcms_menus`
--
ALTER TABLE `sramcms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `sramcms_menu_groups`
--
ALTER TABLE `sramcms_menu_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sramcms_site_setting`
--
ALTER TABLE `sramcms_site_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
