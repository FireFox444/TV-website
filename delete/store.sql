-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 25, 2025 at 06:35 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `store`
--
CREATE DATABASE IF NOT EXISTS `store` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `store`;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `price`) VALUES
(1, 'Samsung 80 cm (32 inches) HD Ready Smart LED TV (Glossy Black)', 12990),
(2, 'LG 80 cm (32 inches) HD Ready Smart LED TV (Dark Iron Gray)', 13490),
(3, 'Acer 80 cm (32 inches) V Pro Series HD Ready Smart QLED Google TV with Android 14 (Black) | 16GB Storage | 30W Dolby Audio\r\n', 12999),
(4, 'Wobble 80 cm (32 inches) UD Series HD Ready Smart LED Google TV (Black)\r\n', 9499),
(5, 'Mi Xiaomi 108 cm (43 inches) X Series 4K LED Smart Google TV (Black)\r\n', 26999),
(6, 'Samsung 108 cm (43 inches) D Series Brighter Crystal 4K Dynamic Ultra HD Smart LED TV (Titan Gray)\r\n', 35990),
(7, 'Hisense 164 cm (65 inches) Q7N Series 4K Ultra HD Smart QLED TV (Dark Grey)\r\n', 64999),
(8, 'Redmi Xiaomi 138 cm (55 inch) F Series UHD 4K Smart LED Fire TV (Black)\r\n', 32999),
(9, 'Panasonic 108 cm (43 inches) 4K Ultra HD Smart LED Google TV (Black)\r\n', 29990),
(10, 'TCL 139 cm (55 inches) 4K Ultra HD Smart QLED Google TV (Black)\r\n', 32990),
(11, 'TOSHIBA 108 cm (43 inches) C350NP Series 4K Ultra HD Smart LED Google TV (Black)\r\n', 23999),
(12, 'Samsung 214 cm (85 inches) 8K Ultra HD Smart Neo QLED TV (Titan Black)\r\n', 1049990);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `contact`, `city`, `address`) VALUES
(1, 'Man patel', 'man@gmail.com', '1ef6599b0ec60758199c8920db1ed041', '9999999999', 'anand', 'anand');

-- --------------------------------------------------------

--
-- Table structure for table `user_item`
--

CREATE TABLE IF NOT EXISTS `user_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `status` enum('Added to cart','Confirmed','','') NOT NULL,
  `date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `user_item`
--

INSERT INTO `user_item` (`id`, `user_id`, `item_id`, `status`, `date_time`) VALUES
(1, 1, 12, 'Confirmed', '2025-02-25 01:07:22'),
(2, 1, 6, 'Confirmed', '2025-02-25 01:07:44'),
(4, 1, 2, 'Confirmed', '2025-02-25 01:13:53'),
(5, 1, 2, 'Confirmed', '2025-02-25 01:13:56'),
(6, 1, 1, 'Confirmed', '2025-02-25 01:14:07'),
(7, 1, 1, 'Confirmed', '2025-02-25 01:14:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
