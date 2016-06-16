-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 25, 2015 at 06:56 AM
-- Server version: 5.5.41
-- PHP Version: 5.6.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `verizone`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `get_date` date DEFAULT NULL,
  `get_time` time DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1 COMMENT='dream Factory VZ Customers ';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `customer_id`, `first_name`, `last_name`, `email`, `company_name`, `phone_number`, `get_date`, `get_time`) VALUES
(1, 'FCFVGVHG', 'Scott', 'Adams', 'scott@abc-consulting.com', 'ABC Consulting LLC', '8374837458', '2015-06-18', '07:16:14'),
(2, 'UUJNJNK', 'Roberts', 'Dean', 'dean.roberts@winona.msus.edu', 'Winona State University', '8326784673', '2015-06-18', '17:09:24'),
(3, 'YGHHBH', 'Cecil', 'Renolds', 'crenolds@hnrassociates.com', 'H&R Associates', '873465734', '2015-06-18', '00:35:00'),
(4, 'GHBHBJH', 'Ibrahim', 'Khalil', 'ibrahim@gmail.com', 'ABC Consulting LLC', '4546456', '2015-06-19', '00:13:00'),
(5, 'HGVHBHBJ', 'Zahirul', 'Haque', 'zahirul.arb@gmail.com', 'H&R Associates', '34534646', '2015-06-19', '23:41:21'),
(6, 'YTFYGBHJ', 'Zaker', 'Ullah', 'zaker@gmail.com', 'Something', '98273487238', '2015-05-01', '18:00:00'),
(7, 'TYFYGHJBJHNJ', 'Mahmud', 'Hassan', 'mahmud@gmail.com', 'Something', '386734', '2015-04-01', '16:59:00'),
(8, 'UGUJ', 'Mr.', 'Robo', 'robo@gmail.com', 'Mr. Robo', '8264876238746', '2015-06-24', '00:53:00'),
(9, 'YTFYVHBH', 'Zahira', 'Khatun', 'khatun@gmail.com', 'Zahira', '634873674867', '2015-06-25', '00:32:00'),
(10, 'HYGGHGH', 'Bilash', 'CSE', 'bilash@gmail.com', 'Bilash', '87364587', '2015-06-26', '22:00:00'),
(11, 'YGHVHGHH', 'Mrs.', 'Bina', 'bina@gmail.com', 'Bina', '82635736587', '2015-06-27', '16:00:00'),
(12, 'JHGYGHGHJHJJ', 'Himel', 'Modi', 'himel@gmail.com', 'Himel', '8237823647', '2015-06-23', '12:00:00'),
(13, 'YFGHVHVH', 'Ashikur', 'Rahman', 'ashik@gmail.com', 'Ashik', '387456874635', '2015-06-23', '08:00:00'),
(14, 'YFGVHKHJBH', 'Kaniz', 'Fatema', 'fatema@gmail.com', 'Fatema', '37567436756374', '2015-06-26', '12:00:00'),
(15, 'HGGVHBHJBJB', 'Fuad', 'Hassan', 'fuad@gmail.com', 'Fuad', '357384758', '2015-06-11', '00:18:00'),
(16, 'VGHVHBHJB', 'Afroza', 'Begum', 'afroza@gmail.com', 'Afroza', '378467346576', '2015-06-13', '16:00:00'),
(17, 'HJGHBJN', 'Hello', 'Hi', 'hi@hello.com', 'Hello', '4645656', '2015-07-30', '23:21:00'),
(18, 'FVGVG', 'FCGFCG', 'HUbhbh', 'gvgg@ybhvb.sdv', 'gyvgyv', '354345', '2015-08-28', '23:00:00'),
(19, 'YGUBHB', 'Afroza', 'Yesmin', 'afroza@gmail.com', 'Jams', '354345', '2015-11-13', '23:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` enum('a','b','c') NOT NULL DEFAULT 'a',
  `salt` varchar(255) DEFAULT NULL,
  `log_ip` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `email_activated` enum('0','1','2') NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `last_name`, `first_name`, `email`, `password`, `user_type`, `salt`, `log_ip`, `last_login`, `email_activated`, `created_at`, `updated_at`) VALUES
(42, 'Azizus', 'Salehin', 'azizussalehin@gmail.com', '243c73d4f20a3212a3ec3d2934e288a3', 'b', 'e996ad5580834f83aa2954243e5a984d9f65193a', '72.76.185.150', '2015-06-29 16:51:41', '1', '2015-06-28 11:52:05', NULL),
(43, 'Mohammad', 'Zaman', 'mohammad.zaman@gmail.com', 'acc4fb804ecd730fed1fc8a658406b7f', 'b', '0b439ee7efbcc8b56c49644eea3c34829ffe4f2c', NULL, NULL, '0', '2015-06-28 13:58:00', NULL),
(44, 'molash7', 'Mo', 'lashkar@yahoo.com', '63bbff9e120394b43cf2361d0c9982c5', 'a', '281d849cc829975f0822c6fbbd8c2267a537106b', NULL, NULL, '1', '2015-06-28 17:00:53', NULL),
(49, 'sffnsdfnd', 'fndfndfn', 'wow@wow.com', '33ca601bbfcc5177b78998a69eb47be2', 'b', '59970295e262a32e4a4ec89c04e68f2cc752dafb', '127.0.0.1', '2015-07-02 11:53:46', '1', '2015-06-30 17:10:10', NULL),
(51, 'Md. Zahirul', 'Haque Tihal', 'zahirul.arb@gmail.com', 'cac6f654e42d6e5483a0b811aa5da10d', 'c', '8de99c8a3d21ff6a93cbbd85f5d52bd99e19ad32', '127.0.0.1', '2015-07-02 15:07:17', '1', '2015-06-30 18:29:14', '2015-07-01 12:15:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
