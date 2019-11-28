-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2019 at 07:46 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `customer`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `photo_name` varchar(100) DEFAULT NULL,
  `status` varchar(10) NOT NULL DEFAULT 'active',
  `role` varchar(11) NOT NULL DEFAULT 'admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `lastname`, `username`, `password`, `photo_name`, `status`, `role`) VALUES
(1, 'maahii', 'mah', 'mah', 'homeir', 'f96ebcb3e56ab1daf429326006f1623a.png', 'Active', 'member'),
(2, 'test', 'test', 'test', 'test', '3b98289498eadfeb0e4cb683351f2a6b.jpg', 'active', 'member'),
(3, 'jhsdj', 'hhjhsaj', 'jhjassdcdf', 'jhjhds', 'a4105cd92510afddc101916a4bbf7d74.jpg', 'active', 'admin'),
(4, 'dxsd', 'sdf', 'sdfsdf', 'dfd', 'user.png', 'active', 'admin'),
(5, 'ds', 'df', 'fdg', 'fg', 'user.png', 'active', 'admin'),
(6, 'Homaira', 'Haidari', 'homei', '1234', 'd7cf2901cfac754fb5928ef747dc62b8.jpg', 'active', 'member'),
(7, 'ali', 'haidari', 'aliAhmad', '1234', '4eed061b6f5ea09a0443d9392a034a57.jpg', 'active', 'member');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE IF NOT EXISTS `car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `palete` varchar(20) NOT NULL,
  `car_type_id` int(11) NOT NULL,
  `status` char(8) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `car_type_id` (`car_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`id`, `palete`, `car_type_id`, `status`) VALUES
(1, '2345445', 2, 'active'),
(3, '123565632', 1, 'active'),
(4, '43545645', 1, 'active'),
(5, '23435667', 4, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `car_type`
--

CREATE TABLE IF NOT EXISTS `car_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `car_type`
--

INSERT INTO `car_type` (`id`, `type_name`) VALUES
(1, 'corolla'),
(2, 'bus'),
(3, 'saracheh'),
(4, 'tonis');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE IF NOT EXISTS `driver` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text,
  `status` char(8) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `name`, `lastname`, `phone`, `address`, `status`) VALUES
(1, 'ahmad', 'ahmadi', '456789', '', 'active'),
(2, 'akbar', 'akbari', '54-054', 'klfkjfd', 'active'),
(3, 'ahmad', 'haidari', '0786409028', 'herat', 'active');

-- --------------------------------------------------------

--
-- Stand-in structure for view `list_car`
--
CREATE TABLE IF NOT EXISTS `list_car` (
`id` int(11)
,`palete` varchar(20)
,`type_name` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `list_passenger`
--
CREATE TABLE IF NOT EXISTS `list_passenger` (
`p_id` int(11)
,`p_name` varchar(50)
,`p_lastname` varchar(50)
,`p_gender` varchar(6)
,`p_passportNumber` varchar(100)
,`p_phone` varchar(15)
,`p_address` text
,`admin_id` int(11)
,`admin_name` varchar(50)
,`admin_lastname` varchar(50)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `list_ticket`
--
CREATE TABLE IF NOT EXISTS `list_ticket` (
`ticket_id` int(11)
,`ticket_rigister_date` datetime
,`from_to` varchar(100)
,`ticket_travel_date` datetime
,`driver_id` int(11)
,`driver_name` varchar(50)
,`driver_lastname` varchar(50)
,`passenger_id` int(11)
,`passenger_name` varchar(50)
,`passenger_lastname` varchar(50)
,`p_passportNumber` varchar(100)
,`p_gender` varchar(6)
,`passenger_phone` varchar(15)
,`passenger_address` text
,`admin_id` int(11)
,`admin_name` varchar(50)
,`admin_lastname` varchar(50)
,`car_id` int(11)
,`car_palete` varchar(20)
,`car_type_name` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE IF NOT EXISTS `passenger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `gender` varchar(6) NOT NULL DEFAULT 'Male',
  `passportNumber` varchar(100) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text,
  `admin_id` int(11) NOT NULL,
  `status` char(8) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`id`, `name`, `lastname`, `gender`, `passportNumber`, `phone`, `address`, `admin_id`, `status`) VALUES
(1, 'NJHDSH', 'JJJ', 'Male', 'HJHSDJJ', 'HJAJS', 'HJJHJAS', 1, 'active'),
(2, 'ahmad', 'ahmadi', 'Male', '34543', '345465', 'fdfgg', 1, 'active'),
(3, 'ahmad', 'ahmadi', 'Male', '34543', '345465', 'fdfgg', 1, 'active'),
(4, 'wqd', 'dsads', 'Male', 'saddsa', 'sad', 'dsa', 1, 'active'),
(5, 'wqd', 'dsads', 'Male', 'saddsa', 'sad', 'dsa', 1, 'active'),
(7, 'a', 'b', 'Male', 'c', 'd', 'e', 1, 'active'),
(8, 'a', 'b', 'Male', 'c', 'd', 'e', 1, 'active'),
(9, 'r', 't', 'Male', 'yurtref', '435345', 'fcdsdsd', 1, 'active'),
(10, 'sdafdsf', 'fdsdfgfd', 'Male', 'dggdsfg', '344325', 'rewerre', 1, 'active'),
(11, 'aaaaaaaaaaaaaaa', 'bbbbbb', 'Male', 'dggdsfg', '344325', 'rewerre', 1, 'active'),
(12, 'hmeir', 'haidary', 'Male', '45565t656', '565756', 'dthgfhgfhh', 1, 'active');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `rigister_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `travel_date` datetime DEFAULT NULL,
  `from_to` varchar(100) DEFAULT NULL,
  `car_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `passenger_id` (`passenger_id`),
  KEY `driver_id` (`driver_id`),
  KEY `car_id` (`car_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ticket`
--

INSERT INTO `ticket` (`id`, `rigister_date`, `travel_date`, `from_to`, `car_id`, `driver_id`, `passenger_id`) VALUES
(1, '2019-11-23 17:31:08', '2019-11-25 23:23:00', 'herat_mashhad', 1, 1, 1),
(2, '2019-11-23 17:59:47', '1979-09-13 09:55:00', NULL, 1, 1, 1),
(5, '2019-11-25 15:21:17', '2019-11-25 15:21:00', 'mashhad_herat', 1, 1, 9),
(7, '2019-11-25 16:40:23', '2019-11-25 16:40:00', 'herat_tehran', 1, 1, 11),
(8, '2019-11-27 10:42:00', '2019-11-27 10:41:00', 'herat_mashhad', 3, 1, 12);

-- --------------------------------------------------------

--
-- Structure for view `list_car`
--
DROP TABLE IF EXISTS `list_car`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_car` AS select `c`.`id` AS `id`,`c`.`palete` AS `palete`,`ct`.`type_name` AS `type_name` from (`car` `c` join `car_type` `ct` on(((`c`.`car_type_id` = `ct`.`id`) and (`c`.`status` = 'active'))));

-- --------------------------------------------------------

--
-- Structure for view `list_passenger`
--
DROP TABLE IF EXISTS `list_passenger`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_passenger` AS select `p`.`id` AS `p_id`,`p`.`name` AS `p_name`,`p`.`lastname` AS `p_lastname`,`p`.`gender` AS `p_gender`,`p`.`passportNumber` AS `p_passportNumber`,`p`.`phone` AS `p_phone`,`p`.`address` AS `p_address`,`a`.`id` AS `admin_id`,`a`.`name` AS `admin_name`,`a`.`lastname` AS `admin_lastname` from (`passenger` `p` join `admin` `a` on(((`p`.`admin_id` = `a`.`id`) and (`p`.`status` = 'active'))));

-- --------------------------------------------------------

--
-- Structure for view `list_ticket`
--
DROP TABLE IF EXISTS `list_ticket`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `list_ticket` AS select `t`.`id` AS `ticket_id`,`t`.`rigister_date` AS `ticket_rigister_date`,`t`.`from_to` AS `from_to`,`t`.`travel_date` AS `ticket_travel_date`,`d`.`id` AS `driver_id`,`d`.`name` AS `driver_name`,`d`.`lastname` AS `driver_lastname`,`lp`.`p_id` AS `passenger_id`,`lp`.`p_name` AS `passenger_name`,`lp`.`p_lastname` AS `passenger_lastname`,`lp`.`p_passportNumber` AS `p_passportNumber`,`lp`.`p_gender` AS `p_gender`,`lp`.`p_phone` AS `passenger_phone`,`lp`.`p_address` AS `passenger_address`,`lp`.`admin_id` AS `admin_id`,`lp`.`admin_name` AS `admin_name`,`lp`.`admin_lastname` AS `admin_lastname`,`lc`.`id` AS `car_id`,`lc`.`palete` AS `car_palete`,`lc`.`type_name` AS `car_type_name` from (((`ticket` `t` join `list_car` `lc` on((`t`.`car_id` = `lc`.`id`))) join `driver` `d` on((`t`.`driver_id` = `d`.`id`))) join `list_passenger` `lp` on((`t`.`passenger_id` = `lp`.`p_id`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `car`
--
ALTER TABLE `car`
  ADD CONSTRAINT `car_ibfk_1` FOREIGN KEY (`car_type_id`) REFERENCES `car_type` (`id`);

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`car_id`) REFERENCES `car` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`passenger_id`) REFERENCES `passenger` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
