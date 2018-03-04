-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 11, 2016 at 01:54 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `transporter`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userName` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `status` int(11) NOT NULL,
  `type` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `userName`, `email`, `password`, `status`, `type`) VALUES
(1, 'allanmosiro12553@gmail.com', 'allanmosiro12553@gmail.com', '50abf9b68b725787fa55b06dbe087e92', 1, 'super-Admin');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `pickdate` text COLLATE utf8_unicode_ci NOT NULL,
  `picktime` text COLLATE utf8_unicode_ci NOT NULL,
  `pickfrom` text COLLATE utf8_unicode_ci NOT NULL,
  `dropto` text COLLATE utf8_unicode_ci NOT NULL,
  `fleet` text COLLATE utf8_unicode_ci NOT NULL,
  `fare` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `mobile` text COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `payment` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `uid`, `pickdate`, `picktime`, `pickfrom`, `dropto`, `fleet`, `fare`, `name`, `email`, `mobile`, `address`, `payment`, `status`) VALUES
(4, 2, '12/07/2016', '15:30:00 PM', 'Nairobi', 'Naivasha', 'Lorem ipsum dolor sit amet.', '350', 'Allan Mosiro', 'allanmosiro12553@gmail.com', '0711914788', '20500narok', '0', 1),
(5, 2, '14/07/2016', '10:30:29 AM', 'Nairobi', 'Naivasha', 'Zilo bus', '900', 'Allan Mosiro', 'allanmosiro12553@gmail.com', '0711914788', '20500narok', '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `fares`
--

CREATE TABLE IF NOT EXISTS `fares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pickfrom` text COLLATE utf8_unicode_ci NOT NULL,
  `dropto` text COLLATE utf8_unicode_ci NOT NULL,
  `fleet` text COLLATE utf8_unicode_ci NOT NULL,
  `fare` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=30 ;

--
-- Dumping data for table `fares`
--

INSERT INTO `fares` (`id`, `pickfrom`, `dropto`, `fleet`, `fare`) VALUES
(27, 'Nairobi', 'Meru', 'Leemeka', '600'),
(28, 'Nairobi', 'Naivasha', 'Zilo bus', '900'),
(29, 'Nairobi', 'Nyeri', 'ADAC bus', '750'),
(23, 'Nairobi', 'Naivasha', 'Zilo bus', '350'),
(24, 'Nairobi', 'Naivasha', 'vokswagen van', '350'),
(25, 'Naivasha', 'Nairobi', 'Kuola Minibus', '300'),
(26, 'Nairobi', 'Nyeri', 'ADAC bus', '400');

-- --------------------------------------------------------

--
-- Table structure for table `fleets`
--

CREATE TABLE IF NOT EXISTS `fleets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `details` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Dumping data for table `fleets`
--

INSERT INTO `fleets` (`id`, `name`, `img`, `details`) VALUES
(1, 'Leemeka', '5635d8456d592.jpg', 'New SUV.'),
(2, 'Nissan', '5635d89e1455e.jpg', 'Convertible Nissan.'),
(3, 'Aston Martin.', '5635d9d0a90ae.jpg', 'Aston Martin 345G.'),
(4, 'Chevy', '5635da3207bc4.jpg', 'ride in a classy chevy.'),
(5, 'VW', '5635e7ce90cfa.jpeg', 'New vokswagen.'),
(6, 'vokswagen van', '5635e8756dc76.jpg', 'Do you like traveling in low speeds?'),
(7, 'Kuola Minibus', '5635e8f29f232.jpg', 'This minibus is cheap and reliable for family packages.'),
(8, 'Zilo bus', '5635e91e8c8b8.jpg', 'only 22 passengers.'),
(9, 'ADAC bus', '5635ea1ae52cc.jpg', 'This ADAC bus carries 41 passengers.Economy class. '),
(10, 'kilo', '5635ea58d3f38.jpg', 'Are you classy and rich..do you like space?Hire this package.'),
(11, 'HRNQ5', '5635ea8e63881.jpeg', 'This one is mostly hired by the business class'),
(12, 'white Helicopter', '5635ead21997d.jpg', 'white helicopter.One of a kind in our collections. '),
(13, 'Helicopter', '5635eb08a68e5.jpg', '59NH helicopter.'),
(14, 'Carvani jeep', '5635eb51c0a3d.jpg', 'New blue jeep that were managing'),
(15, 'hiking jeep', '5635ebac0ac80.jpg', 'hiking jeep'),
(16, 'super jeep', '5635ec24db31b.jpg', 'this is as super jeep!');

-- --------------------------------------------------------

--
-- Table structure for table `generalsetting`
--

CREATE TABLE IF NOT EXISTS `generalsetting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `keyword` text NOT NULL,
  `logo` varchar(100) NOT NULL,
  `favicon` varchar(100) NOT NULL,
  `rootpath` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `generalsetting`
--

INSERT INTO `generalsetting` (`id`, `title`, `description`, `keyword`, `logo`, `favicon`, `rootpath`) VALUES
(1, 'fleetmanagement', 'come work with the professionals in the game.we do what we say.', 'Jobs, online portfolios, find job, jobs search', 'logo.png', 'favicon.png', 'http://localhost/transporterfleet');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` text COLLATE utf8_unicode_ci NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `enterDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `details` text NOT NULL,
  `location` text NOT NULL,
  `salary` int(11) NOT NULL,
  `status` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `title`, `details`, `location`, `salary`, `status`) VALUES
(2, 'driver', 'experienced driver(minimum of 3years)\r\nmust have a a driving license.\r\nmust be 28years and above.', 'Nairobi', 500, 'Available'),
(5, 'IT Specialist', 'we''re looking for an IT specialist who''ll work in our headquarters in Nairobi.\r\n*Must be a degree holder in (bbit or computer science).\r\n*3years experience.\r\n*Portfolio of some hosted projects', 'Nairobi', 867, 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(15, 'Nairobi'),
(16, 'Naivasha'),
(17, 'Nyeri'),
(18, 'Meru');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `contents` text NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `title`, `contents`, `status`) VALUES
(1, 'About Us', '<p>we are a <strong>fleet management company</strong> in kenya.We offer the best fleet management services.</p>\r\n', 1),
(2, 'How it works?', '<p>You have a number of taxis that need management?Then gives us a call.will help you manage your small business.</p>\r\n', 1),
(3, 'Privacy Policy', '<p>Our customers information is not shared with third parties.our system is highly secured,it has been tested and proven.</p>\r\n', 1),
(5, 'Services', '<p>we offer the best fleet management services in kenya.we&#39;re dedicated in what we do.so enabling our customers access fast and reliable services across the country.</p>\r\n', 1);

-- --------------------------------------------------------

--
-- Table structure for table `paypalsettings`
--

CREATE TABLE IF NOT EXISTS `paypalsettings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `paypalsettings`
--

INSERT INTO `paypalsettings` (`id`, `email`) VALUES
(1, 'allanmosiro12553@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `social`
--

CREATE TABLE IF NOT EXISTS `social` (
  `id` int(11) NOT NULL,
  `facebook` varchar(200) NOT NULL,
  `twitter` varchar(200) NOT NULL,
  `googlePlus` varchar(200) NOT NULL,
  `linkedIn` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social`
--

INSERT INTO `social` (`id`, `facebook`, `twitter`, `googlePlus`, `linkedIn`) VALUES
(1, 'https://www.facebook.com', 'https://twitter.com', 'https://plus.google.com', 'https://www.linkedin.com'),
(1, 'https://www.facebook.com', 'https://twitter.com', 'https://plus.google.com', 'https://www.linkedin.com');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hits` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `statistics`
--

INSERT INTO `statistics` (`id`, `hits`, `views`, `date`) VALUES
(1, 0, 17, '2016-07-09'),
(2, 0, 13, '2016-07-10'),
(3, 2, 104, '2016-07-11');

-- --------------------------------------------------------

--
-- Table structure for table `theme`
--

CREATE TABLE IF NOT EXISTS `theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dark` varchar(200) NOT NULL,
  `defaultColor` varchar(200) NOT NULL,
  `success` varchar(200) NOT NULL,
  `danger` varchar(200) NOT NULL,
  `warning` varchar(200) NOT NULL,
  `info` varchar(200) NOT NULL,
  `successText` varchar(200) NOT NULL,
  `warningText` varchar(200) NOT NULL,
  `dangerText` varchar(200) NOT NULL,
  `infoText` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `theme`
--

INSERT INTO `theme` (`id`, `dark`, `defaultColor`, `success`, `danger`, `warning`, `info`, `successText`, `warningText`, `dangerText`, `infoText`) VALUES
(1, '#FFAE1E', 'rgb(255, 211, 57)', '#5AB95A', '#DD524E', '#F0CF4E', '#59C2E1', '#3C763D', '#8A6D3B', '#A94442', '#31708F');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `mobile` varchar(200) NOT NULL,
  `dp` varchar(200) NOT NULL,
  `status` int(11) NOT NULL,
  `joinDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `address`, `mobile`, `dp`, `status`, `joinDate`) VALUES
(2, 'Allan Mosiro', 'allanmosiro12553@gmail.com', '50abf9b68b725787fa55b06dbe087e92', '20500narok', '0711914788', 'userDp.jpg', 1, '2016-07-09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
