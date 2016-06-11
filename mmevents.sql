-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2016 at 06:59 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mmevents`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `phone`, `email`, `username`, `password`, `address`) VALUES
(1, 'admin', '', '', 'admin', '202cb962ac59075b964b07152d234b70', '');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`category_id` int(11) NOT NULL,
  `category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`) VALUES
(1, 'Conferences'),
(2, 'Trade Shows'),
(3, 'Opening Ceremonies'),
(4, 'Product Launches');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
`city_id` int(11) NOT NULL,
  `city_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'Yangon'),
(2, 'Mandalay');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE IF NOT EXISTS `event` (
`event_id` int(11) NOT NULL,
  `organizer_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `venue_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `township_id` int(11) NOT NULL,
  `imgfile` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `fb_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `fax` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `map_lat` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `map_lng` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `eperiod_id` int(11) NOT NULL,
  `price_chk` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `organizer_id`, `sub_category_id`, `venue_id`, `city_id`, `township_id`, `imgfile`, `fb_link`, `email`, `phone`, `fax`, `website`, `contact`, `map_lat`, `map_lng`, `eperiod_id`, `price_chk`) VALUES
(1, 0, 3, 1, 1, 1, '2013641371296694.jpg', 'facebook.com', '', '', '', 'eunovate.com', '', '', '', 0, 0),
(2, 1, 2, 1, 1, 2, 'eimage2.jpg', 'facebook.com', '', '', '', 'eunovate.com', '', '', '', 0, 0),
(3, 0, 1, 1, 1, 1, '2013641371296694.jpg', 'facebook.com', '', '', '', '', '', '', '', 0, 0),
(4, 0, 1, 1, 1, 2, '2013641371296694.jpg', '', '', '', '', 'eunovate.com', '', '', '', 0, 0),
(5, 0, 1, 1, 1, 1, '2013641371296694.jpg', '', '', '', '', '', '', '', '', 0, 0),
(6, 1, 3, 1, 1, 2, 'eimage6.jpg', 'facebook.comm', 'test@gmail.comm', '54323122', '12344', 'eunovate.comm', 'test cc', '16.791599580659', '96.170883178711', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_by_date`
--

CREATE TABLE IF NOT EXISTS `event_by_date` (
`event_by_date_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_by_date`
--

INSERT INTO `event_by_date` (`event_by_date_id`, `event_id`, `start_date`, `end_date`, `start_time`, `end_time`) VALUES
(6, 6, '2016-06-06', '2016-06-10', '2016-06-06 04:00:00', '2016-06-06 05:20:00');

-- --------------------------------------------------------

--
-- Table structure for table `event_content`
--

CREATE TABLE IF NOT EXISTS `event_content` (
`event_content_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ec_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_content`
--

INSERT INTO `event_content` (`event_content_id`, `event_id`, `title`, `ec_description`) VALUES
(1, 1, 'ICT Show 2016', 'The International Myanmar ICT Exhibition will return 15 to 17 November 2016 taking place at Myanmar Event Park (MEP), Yangon and is co-organised for its 2nd successful edition by the Myanmar Computer Federation (MCF) and Bangkok Exhibition Services (BES) Ltd, An Allworld Exhibitions Member.'),
(2, 2, 'Trade Show 2016', 'The International Myanmar ICT Exhibition will return 15 to 17 November 2016 taking place at Myanmar Event Park (MEP), Yangon and is co-organised for its 2nd successful edition by the Myanmar Computer Federation (MCF) and Bangkok Exhibition Services (BES) Ltd, An Allworld Exhibitions Member.'),
(3, 3, 'Fashion Show 2016', ''),
(4, 4, 'Meeting 2016', ''),
(5, 6, 'Mon soon IT Show', 'test dd');

-- --------------------------------------------------------

--
-- Table structure for table `event_facilities`
--

CREATE TABLE IF NOT EXISTS `event_facilities` (
`event_fact_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ef_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_images`
--

CREATE TABLE IF NOT EXISTS `event_images` (
`eimg_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `imgfile` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `event_images`
--

INSERT INTO `event_images` (`eimg_id`, `event_id`, `imgfile`, `user_id`) VALUES
(4, 6, 'eimage6-g6qx.jpg', 1),
(5, 6, 'eimage6-g86o.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `event_status`
--

CREATE TABLE IF NOT EXISTS `event_status` (
`status_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `status_description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status_flag` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organizer`
--

CREATE TABLE IF NOT EXISTS `organizer` (
`organizer_id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `google_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fb_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `town` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organizer`
--

INSERT INTO `organizer` (`organizer_id`, `name`, `phone`, `email`, `google_link`, `fb_link`, `twitter_link`, `username`, `password`, `address`, `company_name`, `city_id`, `town`) VALUES
(1, 'Mr. leo', '', '', '', '', '', 'leo', '202cb962ac59075b964b07152d234b70', '', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE IF NOT EXISTS `sub_category` (
`sub_category_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `category_id`, `sub_category_name`) VALUES
(1, 1, 'academic'),
(2, 1, 'medical'),
(3, 2, 'business');

-- --------------------------------------------------------

--
-- Table structure for table `township`
--

CREATE TABLE IF NOT EXISTS `township` (
`township_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `township_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `township`
--

INSERT INTO `township` (`township_id`, `city_id`, `township_name`) VALUES
(1, 1, 'Tawme'),
(2, 1, 'other');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`user_id` int(11) NOT NULL,
  `name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `google_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fb_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `twitter_link` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `single` int(11) NOT NULL,
  `occupation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `monthly_income` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `town` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE IF NOT EXISTS `venue` (
`venue_id` int(11) NOT NULL,
  `v_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `map` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `v_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `del` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`venue_id`, `v_name`, `map`, `city_id`, `v_description`, `del`) VALUES
(1, 'Tamadaw Hall', '', 1, 'Show, Event', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`city_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
 ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `event_by_date`
--
ALTER TABLE `event_by_date`
 ADD PRIMARY KEY (`event_by_date_id`);

--
-- Indexes for table `event_content`
--
ALTER TABLE `event_content`
 ADD PRIMARY KEY (`event_content_id`);

--
-- Indexes for table `event_facilities`
--
ALTER TABLE `event_facilities`
 ADD PRIMARY KEY (`event_fact_id`);

--
-- Indexes for table `event_images`
--
ALTER TABLE `event_images`
 ADD PRIMARY KEY (`eimg_id`);

--
-- Indexes for table `event_status`
--
ALTER TABLE `event_status`
 ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `organizer`
--
ALTER TABLE `organizer`
 ADD PRIMARY KEY (`organizer_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
 ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `township`
--
ALTER TABLE `township`
 ADD PRIMARY KEY (`township_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
 ADD PRIMARY KEY (`venue_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `event_by_date`
--
ALTER TABLE `event_by_date`
MODIFY `event_by_date_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `event_content`
--
ALTER TABLE `event_content`
MODIFY `event_content_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `event_facilities`
--
ALTER TABLE `event_facilities`
MODIFY `event_fact_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `event_images`
--
ALTER TABLE `event_images`
MODIFY `eimg_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `event_status`
--
ALTER TABLE `event_status`
MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `organizer`
--
ALTER TABLE `organizer`
MODIFY `organizer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `township`
--
ALTER TABLE `township`
MODIFY `township_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
MODIFY `venue_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
