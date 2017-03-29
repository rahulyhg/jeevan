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
(7, 'Contact us', 'contact-us', '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contactus_header contact_section">\r\n<h1>Contact - Jeevanacharaya</h1>\r\n\r\n<p>Your search for self-realization, self-improvement and solutions for all your marriage, health, career, and business problems ends here. You can establish direct contact with Jeevanacharya himself by filling up the &ldquo;get in touch&rdquo; form or can even fill up the &ldquo;book appointment&rdquo; form for a personal interaction with him depending on his availability and location of visit. The map given below shows jeevanacharya&rsquo;s place of visit on a particular day and time and hence is updated regularly on a timely basis.</p>\r\n\r\n<div id="map_iframe" style="height: 400px;">&nbsp;</div>\r\n</div>\r\n', '', 'testing Contact us', 'testing Contact us', 'testing Contact us', 'left-sidebar', 1, 0, '2017-03-25 13:46:34', '', '0000-00-00 00:00:00', ''),
(8, 'Watch', 'watch', '<div class="watch_videos">\r\n<div class="container">\r\n<div class="row">\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 watch_section">\r\n<h2>Jeevanacharya Video&#39;s</h2>\r\n\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.It is a long established fact that a reader will be distracted</p>\r\n<iframe allowfullscreen="" class="frame_video" frameborder="0" height="350" src="https://www.youtube.com/embed/IJhAlI3cO18" width="500"></iframe>\r\n\r\n<div class="col-xs-12 watch_table">\r\n<div class="bs-example">\r\n<table class="table table-bordered table-striped">\r\n	<thead class="thead_inverse" style="background-color: #cecece;">\r\n		<tr>\r\n			<th>S.No</th>\r\n			<th>Swamiji Satsang And Interview Videos</th>\r\n		</tr>\r\n	</thead>\r\n	<tbody>\r\n		<tr>\r\n			<td>1</td>\r\n			<td>Jeevanachrya-Visit Malaysia-2017 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>2</td>\r\n			<td>Jeevanacharya-Visit Singapore-2015 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>3</td>\r\n			<td>Jeevanacharya-Visit Chennai-2016 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>4</td>\r\n			<td>Jeevanacharya-Visit Satsang Delhi-2015 Videos</td>\r\n		</tr>\r\n		<tr>\r\n			<td>5</td>\r\n			<td>Jeevanachrya-Visit Malaysia-2017 Videos</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 watch_img pop_up"><i class="icon-lock" title="Jeevanacharya"><img alt="jeevanachrya" src="/assets/admin/js/ckfinder/userfiles/images/guru_watch.png" /></i>\r\n\r\n<h3>Location</h3>\r\n<button class="btn btn-primary" data-target="#myModal1" data-toggle="modal" type="button">Get your Appointment</button>\r\n\r\n<div id="map_iframe" style="height: 320px;">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\r\n<div class="line_content">\r\n<hr /></div>\r\n', '', 'Watch', 'Watch', 'Watch', 'full-width', 1, 0, '2017-03-27 16:09:27', '', '0000-00-00 00:00:00', ''),
(9, 'Chakra', 'chakra', '', '', 'Chakra', 'Chakra', 'Chakra', 'full-width', 1, 0, '2017-03-28 07:29:43', '', '0000-00-00 00:00:00', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sramcms_cms_pages`
--
ALTER TABLE `sramcms_cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sramcms_cms_pages`
--
ALTER TABLE `sramcms_cms_pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
