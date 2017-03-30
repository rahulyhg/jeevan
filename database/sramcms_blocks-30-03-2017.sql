-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2017 at 04:47 PM
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
-- Table structure for table `sramcms_blocks`
--

DROP TABLE IF EXISTS `sramcms_blocks`;
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
(13, 'Category', '', 0, 'all', 'site_footer', 'menus', 0, 1, 0, 3, 0, '{"menu_group":"10","menus_views":"footer","menus_templates":"footermenu","css_id":""}', '2017-03-25 14:08:50', '2017-03-28 10:54:58'),
(16, 'Jeevanacharya', '', 0, 'all', 'site_footer', 'textwidgets', 0, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_section\\">\\r\\n<h3>JEEVANACHARYA<\\/h3>\\r\\n\\r\\n<p>Jeevanacharya is an embodiment of the almighty himself, who through his awakened self sees the almighty in all hence shows the right &lsquo;way of life&rsquo; to overcome misery or problems of all kinds. His personalized and meticulous approach towards remedial measures and selfless attitude has won him accolades and repute from all quarters of the globe.<\\/p>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:14:46', '2017-03-28 10:52:01'),
(17, 'Twitter Feed', '', 0, 'all', 'site_footer', 'textwidgets', 0, 1, 0, 4, 0, '{"text_content":"<div class=\\"col-lg-3 col-md-3 col-sm-3 col-xs-12 footer_section3\\">\\r\\n<h3>TWITTER FEED<\\/h3>\\r\\n<a class=\\"twitter-timeline\\" data-height=\\"280\\" data-theme=\\"dark\\" data-width=\\"280\\" href=\\"https:\\/\\/twitter.com\\/JeevanacharyaG\\">Tweets by JeevanacharyaG<\\/a> <script async src=\\"\\/\\/platform.twitter.com\\/widgets.js\\" charset=\\"utf-8\\"><\\/script>\\r\\n\\r\\n<div class=\\"tweets_hide\\">&nbsp;<\\/div>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:15:46', '2017-03-25 14:15:46'),
(18, 'Copyright', '', 0, 'all', 'site_copyright', 'textwidgets', 0, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-12 col-md-12 col-sm-12 col-xs-12 copyright\\">\\r\\n<p>JEEVANACHARYA &copy; 2017. ALL RIGHT RESERVED<\\/p>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:20:46', '2017-03-25 14:20:46'),
(19, 'About Short Description Home Page', '', 0, 'frontend/frontend/index', 'content_left', 'textwidgets', 1, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-6 col-md-6 col-sm-6 col-xs-12\\">\\r\\n<h2>About Jeevanacharya<\\/h2>\\r\\n\\r\\n<p>Shri Kumaran Swami Gurujee is a Visionary and a spiritual leader, who dedicated himself to serve the mankind. With his uncommon spiritual gifts and extrasensory power he transforms his devotees spiritually, mentally and physically stronger, which over the years, have earned him worldwide fame and respect.When he travelled across the globe, he was able to see the sufferings of people and understood their problems with his unique instinct. He had mastered himself in studies of Jyotish and Vastu Shastra with his sharp analytical abilities.<\\/p>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-25 14:30:29', '2017-03-30 14:33:47'),
(21, 'Newsletter Content', '', 0, 'all', 'content_newsletter', 'textwidgets', 0, 1, 0, 1, 0, '{"text_content":"<div class=\\"col-lg-4 col-md-4 col-sm-4 col-xs-12 news_content\\"> <h3>JyotishSashtra<\\/h3> <p>In Vedas, JyotishSashtra is descrided as \\"third eye\\" in which there is an unification of all Tenses (Past, Present & Future).Therefore Jyotish may be regarded as ''Astrology'', We have certain rules, Principles etc and each and every step taken is very much systematic so, It is a science.Art is a way of doing work with experience and dexterity.<\\/p> <\\/div> ","css_id":""}', '2017-03-25 14:37:58', '2017-03-27 12:09:58'),
(22, 'JyotishSashtra', '', 0, 'all', 'content_newsletter', 'textwidgets', 0, 1, 0, 2, 0, '{"text_content":"<div class=\\"col-lg-3 col-md-3 col-sm-3 col-xs-12 chakra text-center\\"><img alt=\\"\\" src=\\"\\/assets\\/admin\\/js\\/ckfinder\\/userfiles\\/images\\/1.png\\" style=\\"width: 189px; height: 117px;\\" \\/><\\/div> ","css_id":""}', '2017-03-25 14:53:15', '2017-03-27 12:10:17'),
(24, 'Jeevanacharya Location', '', 0, 'frontend/frontend/index', 'content_left', 'textwidgets', 1, 1, 0, 2, 0, '{"text_content":"<div class=\\"col-lg-6 col-md-6 col-sm-6 col-xs-12 map_section pop_up\\">\\r\\n<h4>Jeevanacharya Location<\\/h4>\\r\\n<iframe allowfullscreen=\\"\\" frameborder=\\"0\\" height=\\"200\\" src=\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d30676638.056241818!2d64.43991442110328!3d20.18793007578521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1487134429231\\" style=\\"border:0\\" width=\\"100%\\"><\\/iframe><\\/div>\\r\\n","css_id":""}', '2017-03-25 15:22:35', '2017-03-30 16:41:23'),
(25, 'Home Newsletter', '', 0, 'frontend/frontend/index', 'content_newsletter', 'newsletter', 1, 1, 1, 3, 0, '{"newsletter_view":"newsletter","newsletter_title":"News Letter","newsletter_subtitle":"Enter your email for updates about news in Axemplate","newsletter_email":"info@jeevanacharya.com","newsletter_icon":"show","css_id":""}', '2017-03-25 15:43:07', '2017-03-25 15:45:22'),
(26, 'Newsletter Form', '', 0, 'all', 'content_newsletter', 'newsletter', 0, 1, 0, 3, 0, '{"newsletter_view":"newsletter","newsletter_title":"News Letter","newsletter_subtitle":"Enter your email for updates about news in Axemplate","newsletter_email":"info@jeevanacharya.com","newsletter_icon":"show","newsletter_button":"Subcribe","css_id":""}', '2017-03-25 15:46:30', '2017-03-27 12:10:50'),
(27, 'Breadcrumbs', '', 0, 'all', 'inner_top', 'breadcrumbs', 0, 1, 0, 1, 0, '{"cms_type":["1","2","3","4","5","6","7"],"css_id":""}', '2017-03-27 11:02:21', '2017-03-27 11:24:38'),
(28, 'Home Wayoflife', '', 0, 'frontend/frontend/index', 'way_circle', 'wayoflife', 1, 1, 0, 1, 0, '{"wayoflife_view":"wayoflife","css_id":""}', '2017-03-27 15:00:12', '2017-03-27 15:00:12'),
(29, 'Wayoflife', '', 0, 'frontend/frontend/pages/way-of-life', 'inner_bottom', 'wayoflife', 1, 1, 0, 1, 0, '{"wayoflife_view":"inner_wayoflife","css_id":""}', '2017-03-27 15:01:12', '2017-03-27 15:01:46'),
(30, 'Contact Forms', '', 0, 'frontend/frontend/pages/contact-us', 'inner_right', 'contactforms', 1, 1, 0, 1, 0, '{"css_id":""}', '2017-03-27 15:52:26', '2017-03-27 15:52:26'),
(31, 'JEEVANACHARYA – ANCIENT HANDWRITTEN RAVAN SANHITA', '', 0, 'frontend/frontend/pages/ashiram', 'inner_bottom', 'textwidgets', 1, 1, 0, 2, 0, '{"text_content":"<div class=\\"ashram_footer\\">\\r\\n<div class=\\"container\\">\\r\\n<div class=\\"row\\">\\r\\n<div class=\\"col-lg-12 col-md-12 col-sm-12 col-xs-12 ashram_sec\\">\\r\\n<div class=\\"col-lg-4 col-md-6 col-sm-6 col-xs-12\\"><img alt=\\"ravansanhita\\" src=\\"\\/assets\\/admin\\/js\\/ckfinder\\/userfiles\\/images\\/ravan_sanhita.png\\" \\/><\\/div>\\r\\n\\r\\n<div class=\\"col-lg-8 col-md-6 col-sm-6 col-xs-12 ashram_section1\\">\\r\\n<h3>JEEVANACHARYA &ndash; ANCIENT HANDWRITTEN RAVAN SANHITA<\\/h3>\\r\\n\\r\\n<p>Jeevanacharya hails the ancient handwritten scripture called Ravan Sanhita that talks about the various facets of astrology and tantric practices honed by Ravana &ndash; the demon king who ruled lanka as mentioned in the great epic &ldquo;Ramayana&rdquo;. Gurujee&rsquo;s positive thinking and approach sees the key points and wisdom the scripture offers for instilling and fortifying the confidence and performance of the masses. Click on the link to know more.<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n\\r\\n<div class=\\"line_content\\">\\r\\n<hr \\/><\\/div>\\r\\n","css_id":""}', '2017-03-27 15:58:47', '2017-03-27 15:58:47'),
(32, 'Wayoflife Bottom Content', '', 0, 'frontend/frontend/pages/way-of-life', 'inner_bottom', 'textwidgets', 1, 1, 0, 2, 0, '{"text_content":"<div class=\\"header1\\">\\r\\n<div class=\\"container\\">\\r\\n<div class=\\"row\\">\\r\\n<div class=\\"col-lg-6 para1\\">\\r\\n<p>For better understanding of this concept, jeevanacharya breaks down &ldquo;way of life&rdquo; into simpler components as Body, mind and Soul where &lsquo;body&rsquo; is termed as the vehicle for the &lsquo;soul&rsquo; that lives forever and &lsquo;mind&rsquo; as the driver of the vehicle. Though these are termed as different entities they are intertwined with each other and are influenced by past karmas and five boodhs viz Fire, Ether, Air, Water and Earth. Accordingly a person is born under any one of the twelve zodiac signs, each with its unique strengths and weaknesses having specific desires, traits and attitudes based on the four elements they belong to.<\\/p>\\r\\n\\r\\n<p>Most of the time our precious body is either under-utilized or over-utilized and often end up spoiling it. Not many understand the need to eat properly, take rest and stay in shape because only a healthy body can serve as a place for a healthy soul to reside in.<\\/p>\\r\\n<\\/div>\\r\\n\\r\\n<div class=\\"col-lg-6 para2\\">\\r\\n<p>Hitting a gym, walking or doing stretches might not produce optimum results because modern exercising techniques do not involve the soul with the body, whereas our yogic stances and Mudras can. The same way the soul and the mind too are not nurtured the right way hence lot of complications arises related to business, marriage, health or career. Whatever it might be, jeevanacharya offers his guidance in the form of yoga and mudras for body related problems, pranayama and meditation for mind related issues and karmic insights and blessings for soul related issues. Having spent more than a decade in the Himalayas, jeevanacharya analyses a person based on the zodiac sign he or she is born in and provides solutions so that they can focus their energies towards positivity and understand their potential to the fullest extent.<\\/p>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n<\\/div>\\r\\n","css_id":""}', '2017-03-27 16:15:05', '2017-03-27 16:15:05'),
(34, 'Chakra Circle', '', 0, 'frontend/frontend/pages/chakra', 'inner_bottom', 'chakra', 1, 1, 0, 1, 0, '{"css_id":""}', '2017-03-28 07:44:30', '2017-03-28 07:44:30'),
(35, 'Album', '', 0, 'frontend/frontend/pages/media', 'inner_bottom', 'gallery', 1, 1, 0, 1, 0, '{"gallery_view":"gallery_slider_one","css_id":""}', '2017-03-28 11:22:17', '2017-03-29 12:58:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_blocks`
--
ALTER TABLE `sramcms_blocks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_blocks`
--
ALTER TABLE `sramcms_blocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
