-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2017 at 04:23 PM
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
(24, 'Jeevanacharya Location', '', 0, 'frontend/frontend/index', 'content_left', 'textwidgets', 1, 1, 0, 2, 0, '{"text_content":"<div class=\\"col-lg-6 col-md-6 col-sm-6 col-xs-12 map_section pop_up\\">\\r\\n<h4>Jeevanacharya Location<\\/h4>\\r\\n<button class=\\"btn btn-primary\\" data-target=\\"#myModal1\\" data-toggle=\\"modal\\" type=\\"button\\">Get your Appointment<\\/button><iframe allowfullscreen=\\"\\" frameborder=\\"0\\" height=\\"200\\" src=\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d30676638.056241818!2d64.43991442110328!3d20.18793007578521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1487134429231\\" style=\\"border:0\\" width=\\"100%\\"><\\/iframe><\\/div>\\r\\n","css_id":""}', '2017-03-25 15:22:35', '2017-03-25 15:22:35'),
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

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_cms_pages`
--

DROP TABLE IF EXISTS `sramcms_cms_pages`;
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
(1, 'About Us', 'about-us', '<div class="aboutus_section">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 guru_aboutus">\r\n<h2>About Jeevanacharya</h2>\r\n\r\n<p>Jeevanacharya formerly known as Shri Kumaran Swami Gurujee is an eminent and charismatic personality with inborn spiritual abilities and wisdom using which he transforms his followers and devotees from ordinary souls to extra-ordinary ones; physically, mentally and spiritually to achieve acumen in their respective fields. He uses his mastery over ancient Indian scriptures, Vastu shastra, yoga, astrology, five boodhs and in-depth knowledge about the ways of the body, mind, soul and karma to analyze individuals thoroughly and in turn help them overcome their problems or hindrances with utmost precision. Over the years, his exceptional service to mankind has not only earned him popularity in India but also all over the globe.</p>\r\n</div>\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 about_img text-center"><i class="icon-lock" title="Jeevanacharya"><img alt="jevanacharya" src="/assets/admin/js/ckfinder/userfiles/images/aboutus.png" /></i></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="line_content">\r\n<hr /></div>\r\n', '', 'testing about us', 'testing about us', 'testing about us', 'full-width', 1, 0, '2017-03-25 13:44:00', '', '0000-00-00 00:00:00', ''),
(2, 'Way Of Life', 'way-of-life', '<div class="header1">\r\n<div class="row">\r\n<div class="col-lg-12 col-xs-12 round">\r\n<div class="container">\r\n<h3>Way of Life</h3>\r\n\r\n<div class="para">\r\n<p>&ldquo;Life&rdquo; &ndash; What is it and how will you define it? Well, it is not as easy as you think because no one till date have understood how life came into being and what it is made of however we can comprehend that anything that is alive, moves, eats, breathes, uses energy, grows, reproduces, responds to the environment and gets rid of waste. In today&rsquo;s modern, quick paced environment, the actual purpose of life is lost and the focus of life has shifted from achieving significance to mere existence. We are engrossed in day-to-day tasks and head either towards power, money, fame, success and other material possessions. In this process we have forgotten that it is a gift by the creator that binds everyone with the universe and has to be utilized in a proper way before it is taken away.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', '', 'testing way Of Life', 'testing way Of Life', 'testing way Of Life', 'full-width', 1, 0, '2017-03-25 13:44:44', '', '0000-00-00 00:00:00', ''),
(3, 'Program', 'program', '<div class="program">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 program_section">\r\n<h2>Jeevanacharya Program</h2>\r\n\r\n<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>\r\n\r\n<h3>Swamiji-Travel Program</h3>\r\n\r\n<p>Tentative Tour Programme of Jeevanacharya, watch and get connected with his WAY OF LIFE</p>\r\n\r\n<div class="wrapper scrollbar-dynamic">\r\n<div class="bs-example">\r\n<table class="table table-bordered">\r\n	<thead>\r\n		<tr>\r\n			<th>S.No</th>\r\n			<th>Date</th>\r\n			<th>Program and Destination</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>1</td>\r\n			<td>15-20 Jan 2017</td>\r\n			<td>2017-satsang-kualaumber,Malaysia</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2</td>\r\n			<td>20-24 Jan 2017</td>\r\n			<td>Chennai-satsang on Ramayan</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3</td>\r\n			<td>27-28 Feb 2017</td>\r\n			<td>Delhi-satsang on self Realisation</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4</td>\r\n			<td>1-2 Apr 2017</td>\r\n			<td>A Life-Transforming weekend with Jeevanachrya</td>\r\n		</tr>\r\n		<tr>\r\n			<td>5</td>\r\n			<td>1-2 Apr 2017</td>\r\n			<td>A Life-Transforming weekend with Jeevanachrya</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 program_img"><i class="icon-lock" title="Jeevanacharya"><img alt="jeevanachrya" src="/assets/admin/js/ckfinder/userfiles/images/prg_guru.png" /></i></div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="line_content">\r\n<hr /></div>\r\n', '', 'testing program', 'testing program', 'testing program', 'full-width', 1, 0, '2017-03-25 13:45:10', '', '0000-00-00 00:00:00', ''),
(4, 'Watch', 'watch', '<div class="watch_videos">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 watch_section">\r\n<h2>Jeevanacharya Video&#39;s</h2>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.It is a long established fact that a reader will be distracted</p>\r\n<iframe allowfullscreen="" class="frame_video" frameborder="0" height="350" src="https://www.youtube.com/embed/IJhAlI3cO18" width="500"></iframe>\r\n\r\n<div class="col-xs-12 watch_table">\r\n<div class="bs-example">\r\n<table class="table table-bordered table-striped">\r\n	<thead class="thead_inverse" style="background-color: #cecece;">\r\n		<tr>\r\n			<th>S.No</th>\r\n			<th>Swamiji Satsang And Interview Videos</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>1</td>\r\n			<td>Jeevanachrya-Visit Malaysia-2017 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2</td>\r\n			<td>Jeevanacharya-Visit Singapore-2015 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3</td>\r\n			<td>Jeevanacharya-Visit Chennai-2016 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4</td>\r\n			<td>Jeevanacharya-Visit Satsang Delhi-2015 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>5</td>\r\n			<td>Jeevanachrya-Visit Malaysia-2017 Videos</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 watch_img pop_up"><i class="icon-lock" title="Jeevanacharya"><img alt="jeevanachrya" src="/assets/admin/js/ckfinder/userfiles/images/guru_watch.png" /></i>\r\n\r\n<h3>Location</h3>\r\n<button class="btn btn-primary" data-target="#myModal1" data-toggle="modal" type="button">Get your Appointment</button>\r\n\r\n<div id="map_iframe" style="height: 320px;">&nbsp;</div>\r\n\r\n<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade col-xs-12" id="myModal1" role="dialog" tabindex="-1">\r\n<div class="modal-dialog modal-md" role="dialog">\r\n<div class="modal-content">\r\n<div class="modal-header">\r\n<h3 class="modal-title">GET SWAMIJI APPOINTMENT</h3>\r\n<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button></div>\r\n\r\n<div class="modal-body">\r\n<p>Take the simple yet life-changing step by filling up and submitting the appointment form given below. May the grace of Jeevanacharya fall upon you and help you stay connected with his glory.</p>\r\n\r\n<h5>Appointment Form</h5>\r\n\r\n<form action="gurujee_form.php" class="form-horizontal" id="contact_form" method="post" name="contact_form">\r\n<div class="form-group"><label class="col-xs-4 control-label">First name </label>\r\n\r\n<div class="col-xs-6"><input class="form-control" id="firstname" name="firstname" placeholder="First name" type="text" /></div>\r\n</div>\r\n\r\n<div class="form-group"><label class="col-xs-4 control-label">Email </label>\r\n\r\n<div class="col-xs-6"><input class="form-control" id="email" name="email" placeholder="Email" type="text" /></div>\r\n</div>\r\n\r\n<div class="form-group"><label class="col-xs-4 control-label">Phone number</label>\r\n\r\n<div class="col-xs-6"><input class="form-control" id="phonenumber" name="phonenumber" placeholder="Phonenumber" type="text" /></div>\r\n</div>\r\n\r\n<div class="form-group"><label class="col-xs-4 control-label">Appointment date</label>\r\n\r\n<div class="col-xs-6 dateContainer">\r\n<div class="input-group date" id="datetimepicker"><input class="form-control" name="dob" placeholder="MM/DD/YYYY h:m A" type="text" /></div>\r\n</div>\r\n</div>\r\n\r\n<div class="form-group"><label class="col-xs-4 control-label">Purpose of Appointment</label>\r\n\r\n<div class="col-xs-6">\r\n<div class="checkbox"><label><input id="purpose" name="purpose[]" type="checkbox" value="Astrology" />Astrology</label></div>\r\n\r\n<div class="checkbox"><label><input id="purpose" name="purpose[]" type="checkbox" value="Business Problem" /> Business Problem</label></div>\r\n\r\n<div class="checkbox"><label><input id="purpose" name="purpose[]" type="checkbox" value="Marriage Problem" />Marriage Problem</label></div>\r\n\r\n<div class="checkbox"><label><input id="purpose" name="purpose[]" type="checkbox" value="Family Problem" /> Family Problem</label></div>\r\n\r\n<div class="checkbox"><label><input id="purpose" name="purpose[]" type="checkbox" value="Other Problem" /> Other Problem</label></div>\r\n</div>\r\n</div>\r\n\r\n<div class="form-group"><label class="col-xs-4 control-label">Message</label>\r\n\r\n<div class="col-xs-6"><textarea class="form-control" id="message" name="message" rows="3"></textarea></div>\r\n</div>\r\n\r\n<div class="form-group">\r\n<div class="col-xs-6 col-xs-offset-3"><button class="btn btn-default" id="contact_submit" name="contact_submit" type="submit" value="submit">Submit</button></div>\r\n</div>\r\n</form>\r\n\r\n<div class="contact_gurujee">&nbsp;</div>\r\n\r\n<div class="modal-footer">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="line_content">\r\n<hr /></div>\r\n', '', 'testing watch', 'testing watch', 'testing watch', 'full-width', 1, 1, '2017-03-25 13:45:31', '', '2017-03-27 16:09:09', ''),
(5, 'Media', 'media', '', '', 'testing media', 'testing media', 'testing media', 'full-width', 1, 0, '2017-03-25 13:45:50', '', '0000-00-00 00:00:00', ''),
(6, 'Ashiram', 'ashiram', '<div class="ashram_header">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ashram_div">\r\n<div class="col-lg-4 col-md-6 col-sm-6 col-xs-12"><img alt="ashram" src="/assets/admin/js/ckfinder/userfiles/images/ashram1.png" /></div>\r\n\r\n<div class="col-lg-8 col-md-6 col-sm-6 col-xs-12 ashram_section1">\r\n<h3>JEEVANACHARYA - JYOTISH &amp;ADHYATMA KENDRA WPAJTRUST(REG.80G)</h3>\r\n\r\n<p>The WPAJT (World Peace &amp; Adhyatma Jyotish Trust) works towards the betterment of humanity and global harmony. Its two pronged approach aimed at development and charitable activities has been a source of inspiration for many and therefore has been attracting alms and financial assistance from like-minded corporate giants, individuals and celebrities. Located and effectively operating from Mumbai &ndash; the financial hub of India, this registered trust accepts generous financial support and offers tax exemption to all its contributors under the 80G clause.</p>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n', '', 'testing Ashiram', 'testing Ashiram', 'testing Ashiram', 'full-width', 1, 0, '2017-03-25 13:46:15', '', '0000-00-00 00:00:00', ''),
(7, 'Contact us', 'contact-us', '<div class="contactus_header">\r\n<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contact_section">\r\n<h1>Contact - Jeevanacharaya</h1>\r\n\r\n<p>Your search for self-realization, self-improvement and solutions for all your marriage, health, career, and business problems ends here. You can establish direct contact with Jeevanacharya himself by filling up the &ldquo;get in touch&rdquo; form or can even fill up the &ldquo;book appointment&rdquo; form for a personal interaction with him depending on his availability and location of visit. The map given below shows jeevanacharya&rsquo;s place of visit on a particular day and time and hence is updated regularly on a timely basis.</p>\r\n<iframe allowfullscreen="" frameborder="0" height="450" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30676638.056241818!2d64.43991442110328!3d20.18793007578521!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30635ff06b92b791%3A0xd78c4fa1854213a6!2sIndia!5e0!3m2!1sen!2sin!4v1487134429231" style="border:0" width="100%"></iframe></div>\r\n</div>\r\n', '', 'testing Contact us', 'testing Contact us', 'testing Contact us', 'left-sidebar', 1, 0, '2017-03-25 13:46:34', '', '0000-00-00 00:00:00', ''),
(8, 'Watch', 'watch', '<div class="watch_videos">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 watch_section">\r\n<h2>Jeevanacharya Video&#39;s</h2>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.It is a long established fact that a reader will be distracted</p>\r\n<iframe allowfullscreen="" class="frame_video" frameborder="0" height="350" src="https://www.youtube.com/embed/IJhAlI3cO18" width="500"></iframe>\r\n\r\n<div class="col-xs-12 watch_table">\r\n<div class="bs-example">\r\n<table class="table table-bordered table-striped">\r\n	<thead class="thead_inverse" style="background-color: #cecece;">\r\n		<tr>\r\n			<th>S.No</th>\r\n			<th>Swamiji Satsang And Interview Videos</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>1</td>\r\n			<td>Jeevanachrya-Visit Malaysia-2017 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2</td>\r\n			<td>Jeevanacharya-Visit Singapore-2015 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3</td>\r\n			<td>Jeevanacharya-Visit Chennai-2016 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4</td>\r\n			<td>Jeevanacharya-Visit Satsang Delhi-2015 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>5</td>\r\n			<td>Jeevanachrya-Visit Malaysia-2017 Videos</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 watch_img pop_up"><i class="icon-lock" title="Jeevanacharya"><img alt="jeevanachrya" src="/assets/admin/js/ckfinder/userfiles/images/guru_watch.png" /></i>\r\n\r\n<h3>Location</h3>\r\n<button class="btn btn-primary" data-target="#myModal1" data-toggle="modal" type="button">Get your Appointment</button>\r\n\r\n<div id="map_iframe" style="height: 320px;">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="line_content">\r\n<hr /></div>\r\n', '', 'Watch', 'Watch', 'Watch', 'full-width', 1, 0, '2017-03-27 16:09:27', '', '0000-00-00 00:00:00', ''),
(9, 'Chakra', 'chakra', '', '', 'Chakra', 'Chakra', 'Chakra', 'full-width', 1, 0, '2017-03-28 07:29:43', '', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_email_templates`
--

DROP TABLE IF EXISTS `sramcms_email_templates`;
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
(1, '2017-03-29 16:56:28', '0000-00-00 00:00:00', 'ananthan@srammram.com', 'ananthan@srammram.com', 'Newsletter Subscribe', 'newsletter-subscribe', 'Newsletter Subscribe Template', 'Newsletter Subscibe', '<div style="width:600px; margin:0px; padding:0px; margin:0 auto; border:1px solid #C8040A;">\r\n<table border="0" cellpadding="0" cellspacing="0" width="600">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center" style=" border-bottom:1px solid #ededed; line-height:1px; font-size:1px; background:#C8040A; padding: 8px; text-align: center" valign="top"><a href="[BASEURL]"><img alt="" height="" src="http://jeevanacharya.com/img/logo.png" width="" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:bold 16px Arial, Helvetica, sans-serif; color:#5D5D5D; padding-left:12px;" valign="top">Hello [NAME],</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:left; line-height:18px; padding:12px 19px 0px 12px;" valign="top">\r\n			<p>Thank you for confirming your subscription with us. You will now be able to receive news, special offers, and more!</p>\r\n\r\n			<p>Unsubscribe Links :&nbsp; <a href="[ACTIVATIONLINK]" target="_blank">[ACTIVATIONLINK]</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">Thanks &amp; Regards,<br />\r\n			Web Site Name - [SITE-TITLE]</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" style="font:normal 11px Arial, Helvetica, sans-serif; color:#fff; background:#C8040A; padding:11px 0px 11px 0px; margin:15px 0px 0px 0px;border-top: 1px solid #C8040A;" valign="top">[COPY-CONTENT]</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '[NAME],[ACTIVATIONLINK], [SITE-TITLE]', 0, 1, 0),
(2, '2017-03-30 11:00:12', '0000-00-00 00:00:00', 'ananthan@srammram.com', 'ananthan@srammram.com', 'Newsletter Unsubscribe', 'newsletter-unsubscribe', 'Newsletter Unsubscribe Template', 'Newsletter Unsubscribe', '<div style="width:600px; margin:0px; padding:0px; margin:0 auto; border:1px solid #C8040A;">\r\n<table border="0" cellpadding="0" cellspacing="0" width="600">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center" style=" border-bottom:1px solid #ededed; line-height:1px; font-size:1px; background:#C8040A; padding: 8px; text-align: center" valign="top"><a href="[BASEURL]"><img alt="" height="" src="http://jeevanacharya.com/img/logo.png" width="" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:bold 16px Arial, Helvetica, sans-serif; color:#5D5D5D; padding-left:12px;" valign="top">Hello [NAME],</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:left; line-height:18px; padding:12px 19px 0px 12px;" valign="top">\r\n			<p>Thank you for confirming your unsubscription with us.</p>\r\n\r\n			<p>Subscribe Links :&nbsp; <a href="[ACTIVATIONLINK]" target="_blank">[ACTIVATIONLINK]</a></p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">Thanks &amp; Regards,<br />\r\n			Web Site Name - [SITE-TITLE]</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" style="font:normal 11px Arial, Helvetica, sans-serif; color:#fff; background:#C8040A; padding:11px 0px 11px 0px; margin:15px 0px 0px 0px;border-top: 1px solid #C8040A;" valign="top">[COPY-CONTENT]</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '[NAME],[ACTIVATIONLINK], [SITE-TITLE]', 0, 1, 0),
(3, '2017-03-30 15:30:17', '0000-00-00 00:00:00', 'ananthan@srammram.com', 'ananthan@srammram.com', 'Feedback Admin', 'feedback-admin', 'Feedback Template', 'Feedback', '<div style="width:600px; margin:0px; padding:0px; margin:0 auto; border:1px solid #C8040A;">\r\n<table border="0" cellpadding="0" cellspacing="0" width="600">\r\n	<tbody>\r\n		<tr>\r\n			<td align="center" style=" border-bottom:1px solid #ededed; line-height:1px; font-size:1px; background:#C8040A; padding: 8px; text-align: center" valign="top"><a href="[BASEURL]"><img alt="" height="" src="http://jeevanacharya.com/img/logo.png" width="" /></a></td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:bold 16px Arial, Helvetica, sans-serif; color:#5D5D5D; padding-left:12px;" valign="top">Dear [NAME],</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:left; line-height:18px; padding:12px 19px 0px 12px;" valign="top">\r\n			<p>Feedback Form details below.</p>\r\n\r\n			<p>Firstname :&nbsp; [FIRSTNAME]</p>\r\n\r\n			<p>Lastname :&nbsp; [LASTNAME]</p>\r\n\r\n			<p>Email :&nbsp; [EMAIL]</p>\r\n\r\n			<p>Message :&nbsp; [CONTENT]</p>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">Thanks &amp; Regards,<br />\r\n			Web Site Name - [SITE-TITLE]</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="left" style="font:normal 12px Arial, Helvetica, sans-serif; color:#3a3a3a; text-align:justify; line-height:18px; padding:12px 19px 0px 12px;" valign="top">&nbsp;</td>\r\n		</tr>\r\n		<tr>\r\n			<td align="center" style="font:normal 11px Arial, Helvetica, sans-serif; color:#fff; background:#C8040A; padding:11px 0px 11px 0px; margin:15px 0px 0px 0px;border-top: 1px solid #C8040A;" valign="top">[COPY-CONTENT]</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<p>&nbsp;</p>\r\n', '[NAME], [EMAIL], [FIRSTNAME],[LASTNAME], [CONTENT], [SITE-TITLE]', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_feedback`
--

DROP TABLE IF EXISTS `sramcms_feedback`;
CREATE TABLE `sramcms_feedback` (
  `id` int(11) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `message_text` text NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_log`
--

DROP TABLE IF EXISTS `sramcms_log`;
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
(63, '2017-03-25 13:54:36', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(64, '2017-03-28 10:52:52', 'A New Menu Groups Category has been added by admin :tksubhashraj14@gmail.com', 'Menu Groups', 1, 1, '::1'),
(65, '2017-03-28 10:53:19', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(66, '2017-03-28 10:53:32', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(67, '2017-03-28 10:53:47', 'A New Menushas been added by admin :tksubhashraj14@gmail.com', 'Menus', 1, 1, '::1'),
(68, '2017-03-28 10:54:01', 'A Menus Watch has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(69, '2017-03-28 10:54:03', 'A Menus Media has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(70, '2017-03-28 10:54:06', 'A Menus Ashiram has been deleted  by admin :tksubhashraj14@gmail.com', 'Menus', 3, 1, '::1'),
(71, '2017-03-28 12:31:50', 'A New Gallery Categories Jeevanachary’s interview with a noted news channel about founding an old age home in Ranchi, Jharkhand has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(72, '2017-03-28 12:34:21', 'A New Gallery Categories Jeevanachary’s interview with a noted news channel about founding an old age home in Ranchi, Jharkhand has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(73, '2017-03-28 12:37:30', 'A New Gallery Categories Jeevanachary’s interview with a noted news channel about founding an old age home in Ranchi, Jharkhand has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(74, '2017-03-28 12:40:54', 'A New Gallery Categories test has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(75, '2017-03-28 12:41:13', 'A Gallery Categories  has been edited by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 2, 1, '::1'),
(76, '2017-03-28 12:41:49', 'A New Gallery Categories Jeevanachary’s interview with a noted news channel about founding an old age home in Ranchi, Jharkhand has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(77, '2017-03-28 12:42:09', 'A New Gallery Categories Jeevanacharya at Bharat Gaurav Achievement Award 2016 has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(78, '2017-03-28 12:42:31', 'A New Gallery Categories Hyderabad press meet – 2016 has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(79, '2017-03-28 12:43:29', 'A New Gallery Categories Jeevancharya Daily Message has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(80, '2017-03-28 12:45:29', 'A New Gallery Categories Jeevanacharya Video has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(81, '2017-03-28 12:45:49', 'A New Gallery Categories JyotishSashtra has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(82, '2017-03-28 12:46:15', 'A New Gallery Categories Way of Life has been added by admin :tksubhashraj14@gmail.com', 'Gallery Categories', 1, 1, '::1'),
(83, '2017-03-28 14:57:23', 'A New Gallery itemhas been added by admin :tksubhashraj14@gmail.com', 'Gallery item', 1, 1, '::1'),
(84, '2017-03-28 14:57:49', 'A New Gallery itemhas been added by admin :tksubhashraj14@gmail.com', 'Gallery item', 1, 1, '::1'),
(85, '2017-03-28 14:59:13', 'A New Gallery itemhas been added by admin :tksubhashraj14@gmail.com', 'Gallery item', 1, 1, '::1'),
(86, '2017-03-28 14:59:43', 'A New Gallery itemhas been added by admin :tksubhashraj14@gmail.com', 'Gallery item', 1, 1, '::1');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_master_admin`
--

DROP TABLE IF EXISTS `sramcms_master_admin`;
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

DROP TABLE IF EXISTS `sramcms_master_admin_login_history`;
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
(116, '2017-03-27 07:12:48', '::1', 1),
(117, '2017-03-28 07:01:45', '127.0.0.1', 1),
(118, '2017-03-28 09:28:58', '127.0.0.1', 1),
(119, '2017-03-28 10:47:17', '::1', 1),
(120, '2017-03-29 12:58:18', '127.0.0.1', 1),
(121, '2017-03-29 16:27:23', '127.0.0.1', 1),
(122, '2017-03-30 08:08:14', '127.0.0.1', 1);

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
(27, 'Watch', 'page', 4, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 13:54:06', 1, '2017-03-28 10:54:01', 1, 1, 1),
(28, 'Media', 'page', 5, '', 7, 0, '_blank', '', '', 0, 0, '2017-03-25 13:54:25', 1, '2017-03-28 10:54:03', 1, 1, 1),
(29, 'Ashiram', 'page', 6, '', 7, 0, '_top', '', '', 0, 0, '2017-03-25 13:54:36', 1, '2017-03-28 10:54:06', 1, 1, 1),
(30, 'Media', 'page', 5, '', 10, 0, '_blank', '', '', 0, 0, '2017-03-28 10:53:19', 1, '0000-00-00 00:00:00', 0, 1, 0),
(31, 'Watch', 'page', 8, '', 10, 0, '_blank', '', '', 0, 0, '2017-03-28 10:53:32', 1, '0000-00-00 00:00:00', 0, 1, 0),
(32, 'Ashiram', 'page', 6, '', 10, 0, '_blank', '', '', 0, 0, '2017-03-28 10:53:47', 1, '0000-00-00 00:00:00', 0, 1, 0);

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
(9, 'Header Desktop Menu', 'header-desktop-menu', '', '2017-03-25 13:49:24', '2017-03-25 13:49:39', 1, 1, 1, 1),
(10, 'Category', 'category', '', '2017-03-28 10:52:52', '0000-00-00 00:00:00', 1, 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_newsletter`
--

DROP TABLE IF EXISTS `sramcms_newsletter`;
CREATE TABLE `sramcms_newsletter` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `activation_code` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sramcms_newsletter`
--

INSERT INTO `sramcms_newsletter` (`id`, `name`, `email`, `activation_code`, `status`, `is_active`, `is_delete`, `created`) VALUES
(1, 'Ananthan', 'ananthan@srammram.com', '033a9dae26cf7eae0c2254b8725ed77b', 0, 1, 0, '2017-03-30 10:56:06'),
(2, 'sdsfdsfsf', 'ssada@fdsffs.dgffg', 'eb72a4d0569f3a8b3a3730ac1a44bf23', 1, 1, 0, '2017-03-30 07:56:38'),
(3, 'sdfsdfds sdfdsf', 'sdsdfdsfdsdfsdfs@cdf.bnjb', '0573af235db89368f9a72960d250a1f1', 1, 1, 0, '2017-03-30 07:58:48'),
(4, 'asdsa', 'adas@gdf.c', '2f380546812314b2ddef5fac42ab156e', 1, 1, 0, '2017-03-30 08:00:27'),
(5, 'dsf fdsfs', 'sdsf@fdg.vv', 'f779db7c5db96e8641ee9103ec17d8e2', 1, 1, 0, '2017-03-30 08:02:14'),
(6, 'sd asdsadasd', 'adsad@dfgdfg.gg', 'b9ccc76c9300da7f872d0b264b5a16ef', 1, 1, 0, '2017-03-30 08:05:21'),
(7, 'Mani', 'mani@srammram.com', '0aab7343fa47566aa5e4e47110c2ddc1', 1, 1, 0, '2017-03-30 08:06:17'),
(8, 'sfsff', 'sdfsd@fsd.ggh', '73a5034d1ea0f34dceacfeb663a83128', 0, 1, 0, '2017-03-30 08:06:29'),
(9, 'Ananthan', 'kannan@srammram.com', 'ab27e65729ed9c70590692e297d6ad87', 1, 1, 0, '2017-03-30 12:27:13'),
(10, 'mohamed', 'mohamed@srammram.com', 'a68dc7d13113ca86bec6f538d58b452f', 1, 1, 0, '2017-03-30 12:28:09'),
(11, 'sdfdsf', 'sdfsd@sdfds.xcg', '65cebb43bef8a311debd171d0c95c4b6', 1, 1, 0, '2017-03-30 12:28:47'),
(12, 'bala', 'bala@gmail.com', '80e3c197c716cb87662f6e56f90084b5', 1, 1, 0, '2017-03-30 12:42:12'),
(13, 'bala', 'bal1a@gmail.com', '1d5088f5b45da18a3907875e8d354661', 1, 1, 0, '2017-03-30 12:43:55'),
(14, 'sddsf sfs', 'sfs@gfh.g', 'f62d78f0ed6e032415023ca20787d9de', 1, 1, 0, '2017-03-30 12:45:07'),
(15, 'ssfs', 'sdf@fg.g', '92d0233eef02e7e0145310c3b509a9d0', 1, 1, 0, '2017-03-30 12:46:39'),
(16, 'vcxvxcv', 'xcvxc@dsfsd.h', 'ee5773573c86a9ba531c96372d8f57f2', 1, 1, 0, '2017-03-30 13:31:58');

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_photo_oftheday`
--

DROP TABLE IF EXISTS `sramcms_photo_oftheday`;
CREATE TABLE `sramcms_photo_oftheday` (
  `id` bigint(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` mediumtext NOT NULL,
  `date` date NOT NULL,
  `image` mediumtext NOT NULL,
  `created_on` datetime NOT NULL,
  `created_ip` varchar(50) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_on` datetime NOT NULL,
  `updated_ip` varchar(50) NOT NULL,
  `updated_by` bigint(20) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `is_delete` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sramcms_site_setting`
--

DROP TABLE IF EXISTS `sramcms_site_setting`;
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

DROP TABLE IF EXISTS `sramcms_users`;
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
(37, 'Burhan', 'Khalib', '$2a$08$LKfkiW5Lb7yxG2/5VA0kqOUBfOqYrTkqDxXAq1aVkFuqMOESlH8pW', 'burhan@fanxt.com', '1F563298', NULL, NULL, NULL, NULL, 'great', NULL, 'J43rzDb8gPNivcwhI9TjA7fXy6toOR201EQlqVnapULZYsdWCM.png', 50, 0, 'thLGA0yFS91olVxs5KMOHY2fWm6vJqXaZTjpriezPEgBNdw7DC', 0, 0, 0, 0, 0, 'D', '2016-03-07 18:17:35', '175.136.214.244', 1, '2016-11-09 06:13:39', '::1'),
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
-- Indexes for table `sramcms_email_templates`
--
ALTER TABLE `sramcms_email_templates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `sramcms_feedback`
--
ALTER TABLE `sramcms_feedback`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `sramcms_newsletter`
--
ALTER TABLE `sramcms_newsletter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sramcms_photo_oftheday`
--
ALTER TABLE `sramcms_photo_oftheday`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `sramcms_cms_pages`
--
ALTER TABLE `sramcms_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `sramcms_email_templates`
--
ALTER TABLE `sramcms_email_templates`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sramcms_feedback`
--
ALTER TABLE `sramcms_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sramcms_gallary_categories`
--
ALTER TABLE `sramcms_gallary_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `sramcms_galleries`
--
ALTER TABLE `sramcms_galleries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `sramcms_log`
--
ALTER TABLE `sramcms_log`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `sramcms_master_admin`
--
ALTER TABLE `sramcms_master_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sramcms_master_admin_login_history`
--
ALTER TABLE `sramcms_master_admin_login_history`
  MODIFY `login_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `sramcms_menus`
--
ALTER TABLE `sramcms_menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `sramcms_menu_groups`
--
ALTER TABLE `sramcms_menu_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `sramcms_newsletter`
--
ALTER TABLE `sramcms_newsletter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `sramcms_photo_oftheday`
--
ALTER TABLE `sramcms_photo_oftheday`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sramcms_site_setting`
--
ALTER TABLE `sramcms_site_setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
