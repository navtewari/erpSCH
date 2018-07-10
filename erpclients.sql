-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2018 at 12:09 PM
-- Server version: 5.6.11-log
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `erpclients`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `CID` int(4) UNSIGNED ZEROFILL NOT NULL,
  `CLIENT_NAME` varchar(150) NOT NULL,
  `ABBREV` varchar(10) NOT NULL,
  `ADDRESS` text NOT NULL,
  `CONTACT` varchar(50) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `DB_` varchar(50) NOT NULL,
  `STATUS` tinyint(1) NOT NULL,
  `USERNAME_` varchar(30) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='This table is used to maintain the school ERP clients';

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`CID`, `CLIENT_NAME`, `ABBREV`, `ADDRESS`, `CONTACT`, `EMAIL`, `DB_`, `STATUS`, `USERNAME_`, `DATE_`) VALUES
(0001, 'The Sunbeam Public School, Haldwnani', 'TSS', 'x', '9410112596, 9897910445', 'thesunbeamschool2006@gmail.com', 'default-sunbeam', 1, 'nitin', '2018-07-06 07:59:15'),
(0002, 'GDJM School, Nandhor', 'GDJM', 'x', '9760020667', 'nitin.d12@gmail.com', 'default-gdjm', 1, 'mamta', '2018-07-06 08:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `USERNAME_` varchar(40) NOT NULL,
  `PASSWORD_` varchar(20) NOT NULL,
  `STATUS` varchar(15) NOT NULL,
  `DATE_` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`USERNAME_`, `PASSWORD_`, `STATUS`, `DATE_`) VALUES
('gopal', '123', 'admin', '2018-07-06 07:56:04'),
('mamta', '123', 'school', '2018-07-07 11:01:34'),
('naveen', '123', 'admin', '2018-07-06 07:55:48'),
('nitin', '123', 'admin', '2018-07-06 07:55:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `USERNAME_` (`USERNAME_`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`USERNAME_`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `CID` int(4) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `user` FOREIGN KEY (`USERNAME_`) REFERENCES `users` (`USERNAME_`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
