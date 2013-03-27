-- phpMyAdmin SQL Dump
-- version 3.5.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 26, 2013 at 10:20 PM
-- Server version: 5.5.28
-- PHP Version: 5.3.20

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Hostel2013`
--

-- --------------------------------------------------------

--
-- Table structure for table `hostelDetails`
--

CREATE TABLE IF NOT EXISTS `hostelDetails` (
  `hostelId` int(200) NOT NULL AUTO_INCREMENT COMMENT 'hostel id',
  `hostelName` varchar(100) NOT NULL COMMENT 'hostel name',
  `hostelYear` int(11) NOT NULL,
  `roomNo` int(3) NOT NULL COMMENT 'room  number',
  `capacity` int(1) NOT NULL COMMENT 'room capacity',
  `floorNo` varchar(1) NOT NULL COMMENT 'floor number',
  `type` varchar(1) NOT NULL COMMENT 'hostel type? boys or girls',
  `page_modulecomponentid` int(11) NOT NULL,
  PRIMARY KEY (`hostelId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `hostelDetails`
--

INSERT INTO `hostelDetails` (`hostelId`, `hostelName`, `hostelYear`, `roomNo`, `capacity`, `floorNo`, `type`, `page_modulecomponentid`) VALUES
(1, 'Amber-A', 2, 1, 2, '2', 'M', 1),
(2, 'Amber-B', 2, 1, 2, '2', 'M', 1),
(3, 'Opal-D', 4, 1, 3, '0', 'F', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE IF NOT EXISTS `hostels` (
  `hostelId` int(11) NOT NULL,
  `hostelName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels`
--

INSERT INTO `hostels` (`hostelId`, `hostelName`) VALUES
(1, 'Amber-A'),
(2, 'Amber-B'),
(3, 'Opal-D');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `userId` varchar(100) NOT NULL,
  `roomMateRequestId` varchar(100) NOT NULL,
  `requestTIme` varchar(50) DEFAULT NULL,
  `requestViewed` varchar(100) NOT NULL,
  `accepted` int(11) DEFAULT NULL,
  `page_modulecomponentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`userId`, `roomMateRequestId`, `requestTIme`, `requestViewed`, `accepted`, `page_modulecomponentid`) VALUES
('100001', '100000', '2013-03-26 19:48:55', '', NULL, 1),
('100001', '100002', '2013-03-26 19:48:55', '', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userDetails`
--

CREATE TABLE IF NOT EXISTS `userDetails` (
  `userId` varchar(100) NOT NULL,
  `userName` varchar(100) NOT NULL,
  `rollNo` int(10) NOT NULL,
  `year` int(11) NOT NULL COMMENT 'year of study'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userDetails`
--

INSERT INTO `userDetails` (`userId`, `userName`, `rollNo`, `year`) VALUES
('100000', 'Admin1', 107111027, 2),
('100001', 'Admin2', 107111099, 2),
('100002', 'Admin3', 102111040, 2),
('100004', 'User4', 106109101, 4),
('100005', 'User5', 106109102, 4),
('100006', 'User6', 106109103, 4),
('100007', 'User7', 106109104, 4);

-- --------------------------------------------------------

--
-- Table structure for table `userPreferences`
--

CREATE TABLE IF NOT EXISTS `userPreferences` (
  `userId` varchar(100) NOT NULL COMMENT 'user webmail id',
  `degree` varchar(10) NOT NULL COMMENT 'degree',
  `year` int(10) NOT NULL,
  `department` varchar(100) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `hostelPrefId` int(3) NOT NULL COMMENT 'preferred hostel id',
  `hostelPrefName` varchar(100) NOT NULL COMMENT 'preferred hostel name',
  `floorPref` int(1) NOT NULL COMMENT 'floor preference',
  `roommateId1` varchar(100) DEFAULT NULL COMMENT 'roommate''s webmail id',
  `roommateId2` varchar(100) DEFAULT NULL,
  `roommateId3` varchar(100) DEFAULT NULL,
  `active` int(1) NOT NULL DEFAULT '0' COMMENT 'permission to view page . 1 for yes , 0 for no.',
  `PCP` varchar(100) NOT NULL COMMENT 'physically challenged .',
  `page_modulecomponentid` int(11) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userPreferences`
--

INSERT INTO `userPreferences` (`userId`, `degree`, `year`, `department`, `gender`, `hostelPrefId`, `hostelPrefName`, `floorPref`, `roommateId1`, `roommateId2`, `roommateId3`, `active`, `PCP`, `page_modulecomponentid`) VALUES
('100000', 'Btech', 2, 'EEE', 'M', 1, 'Amber-A', 0, '100001', NULL, NULL, 0, '0', 1),
('100001', 'BTECH', 2, 'EEE', 'M', 1, 'Amber-A', 0, '', NULL, NULL, 0, '0', 1),
('100004', 'Btech', 4, 'ECE', 'F', 3, 'Opal-D', 0, '100006', '100005', NULL, 0, '0', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
