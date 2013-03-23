-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2013 at 08:20 PM
-- Server version: 5.5.25
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `hostelManagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `hostelDetails`
--

CREATE TABLE `hostelDetails` (
  `hostelId` int(200) NOT NULL AUTO_INCREMENT COMMENT 'hostel id',
  `hostelName` varchar(100) NOT NULL COMMENT 'hostel name',
  `hostelYear` int(11) NOT NULL,
  `roomNo` int(3) NOT NULL COMMENT 'room starting number',
  `Capacity` int(1) NOT NULL COMMENT 'room ending number',
  `floorNo` varchar(1) NOT NULL COMMENT 'floor number',
  `type` varchar(1) NOT NULL COMMENT 'hostel type? boys or girls',
  `page_modulecomponentid` int(11) NOT NULL,
  PRIMARY KEY (`hostelId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hostelDetails`
--

INSERT INTO `hostelDetails` (`hostelId`, `hostelName`, `hostelYear`, `roomNo`, `Capacity`, `floorNo`, `type`, `page_modulecomponentid`) VALUES
(1, 'Amber-A', 2, 1, 2, '0', 'M', 1);

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `userId` varchar(100) NOT NULL,
  `roommateId` varchar(100) NOT NULL,
  `accepted` int(11) DEFAULT NULL,
  `page_modulecomponentid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`userId`, `roommateId`, `accepted`, `page_modulecomponentid`) VALUES
('100000', '100001', NULL, 1),
('100001', '100000', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `userPreferences`
--

CREATE TABLE `userPreferences` (
  `userId` varchar(100) NOT NULL COMMENT 'user webmail id',
  `userName` varchar(100) NOT NULL COMMENT 'user full name',
  `degree` varchar(10) NOT NULL COMMENT 'degree',
  `year` int(10) NOT NULL,
  `department` varchar(100) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `hostelPrefId` int(3) NOT NULL COMMENT 'preferred hostel id',
  `hostelPrefName` varchar(100) NOT NULL COMMENT 'preferred hostel name',
  `floorPref` int(1) NOT NULL COMMENT 'floor preference',
  `roommateId` varchar(100) NOT NULL COMMENT 'roommate''s webmail id',
  `active` int(1) NOT NULL DEFAULT '0' COMMENT 'permission to view page . 1 for yes , 0 for no.',
  `PCP` varchar(100) NOT NULL COMMENT 'physically challenged .',
  `page_modulecomponentid` int(11) NOT NULL,
  PRIMARY KEY (`userId`),
  UNIQUE KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userPreferences`
--

INSERT INTO `userPreferences` (`userId`, `userName`, `degree`, `year`, `department`, `gender`, `hostelPrefId`, `hostelPrefName`, `floorPref`, `roommateId`, `active`, `PCP`, `page_modulecomponentid`) VALUES
('100000', 'Admin1', 'Btech', 2, 'EEE', 'M', 1, 'Amber-A', 0, '100001', 0, '0', 1),
('100001', 'Admin2', 'BTECH', 2, 'EEE', 'M', 1, 'Amber-A', 0, '100000', 0, '0', 1);
