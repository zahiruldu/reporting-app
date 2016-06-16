-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2015 at 11:49 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1 COMMENT='dream Factory VZ Customers ';

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
(16, 'VGHVHBHJB', 'Afroza', 'Begum', 'afroza@gmail.com', 'Afroza', '378467346576', '2015-06-13', '16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
