-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2017 at 04:58 PM
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
-- Table structure for table `sramcms_email_templates`
--

CREATE TABLE `sramcms_email_templates` (
  `id` int(11) UNSIGNED NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `from_email` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply_to` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_content` text COLLATE utf8_unicode_ci,
  `email_variables` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_html` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL,
  `is_delete` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Site Email Templates';

--
-- Dumping data for table `sramcms_email_templates`
--

INSERT INTO `sramcms_email_templates` (`id`, `created`, `modified`, `from_email`, `reply_to`, `name`, `slug`, `description`, `subject`, `email_content`, `email_variables`, `is_html`, `is_active`, `is_delete`) VALUES
(1, '2017-03-29 16:56:28', '0000-00-00 00:00:00', 'ananthan@srammram.com', 'ananthan@srammram.com', 'Newsletter Subscribe', 'newsletter-subscribe', 'Newsletter Subscribe Template', 'Newsletter Subscibe', '<div style="width:600px; margin:0px; padding:0px; margin:0 auto; border:1px solid #C8040A;">\r\n<table border="0" cellpadding="0" cellspacing="0" width="600">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center" style=" border-bottom:1px solid #ededed; line-height:1px; font-size:1px; background:#C8040A; padding: 8px; text-align: center" valign="top"><a href="[BASEURL]"><img alt="" height="" src="http://jeevanacharya.com/img/logo.png" width="" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:bold 16px Arial, Helvetica, sans-serif; color:#5D5D5D; padding-left:12px;" valign="top">Hello [NAME],</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:left; line-height:18px; padding:12px 19px 0px 12px;" valign="top">\r\n			<p>Thank you for confirming your subscription with us. You will now be able to receive news, special offers, and more!</p>\r\n\r\n			<p>Unsubscribe Links :&nbsp; <a href="[ACTIVATIONLINK]" target="_blank">[ACTIVATIONLINK]</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">Thanks &amp; Regards,<br />\r\n			Web Site Name - [SITE-TITLE]</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" style="font:normal 11px Arial, Helvetica, sans-serif; color:#fff; background:#C8040A; padding:11px 0px 11px 0px; margin:15px 0px 0px 0px;border-top: 1px solid #C8040A;" valign="top">[COPY-CONTENT]</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '[NAME],[ACTIVATIONLINK], [SITE-TITLE]', 0, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_email_templates`
--
ALTER TABLE `sramcms_email_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_email_templates`
--
ALTER TABLE `sramcms_email_templates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
