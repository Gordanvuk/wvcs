-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2011 at 02:16 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `wvcs`
--

-- --------------------------------------------------------

--
-- Table structure for table `directory`
--

CREATE TABLE IF NOT EXISTS `directory` (
  `did` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of the directory',
  `tid` int(8) NOT NULL COMMENT 'ID of task which this directory belong to',
  `description` varchar(8000) DEFAULT NULL COMMENT 'description',
  PRIMARY KEY (`did`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `directory`
--

INSERT INTO `directory` (`did`, `tid`, `description`) VALUES
(1, 1, 'test dir'),
(2, 1, 'test upper dir');

-- --------------------------------------------------------

--
-- Table structure for table `directory_change`
--

CREATE TABLE IF NOT EXISTS `directory_change` (
  `dcid` int(12) NOT NULL AUTO_INCREMENT COMMENT 'ID of the directory modification',
  `did` int(11) NOT NULL COMMENT 'ID of which directory is related to',
  `did_base` int(11) DEFAULT NULL COMMENT 'Upper level directory ID',
  `uid` int(8) NOT NULL COMMENT 'ID of user who did this modification',
  `hid` int(12) NOT NULL COMMENT 'ID of task change history record which the directory related to',
  `name` varchar(259) NOT NULL COMMENT 'directory name',
  `version` int(5) NOT NULL COMMENT 'version of this modification',
  `type` int(1) NOT NULL COMMENT 'type of operation of the modification',
  `time` datetime NOT NULL COMMENT 'time of commit',
  `ip` varchar(30) DEFAULT NULL COMMENT 'IP record of the modification',
  `description` varchar(8000) DEFAULT NULL COMMENT 'description',
  PRIMARY KEY (`dcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `directory_change`
--

INSERT INTO `directory_change` (`dcid`, `did`, `did_base`, `uid`, `hid`, `name`, `version`, `type`, `time`, `ip`, `description`) VALUES
(1, 1, 2, 1, 1, 'test_dir', 1, 1, '2011-09-01 23:52:56', NULL, 'test_dir'),
(2, 2, NULL, 1, 1, 'test_dir_upper', 1, 1, '2011-09-15 23:53:32', NULL, 'test_dir_upper');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
  `fid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ID of the file',
  `tid` int(10) NOT NULL COMMENT 'ID of task which this file belong to',
  `description` varchar(8000) DEFAULT NULL COMMENT 'description',
  PRIMARY KEY (`fid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `file`
--

INSERT INTO `file` (`fid`, `tid`, `description`) VALUES
(1, 1, 'testfile'),
(2, 1, 'a second test file');

-- --------------------------------------------------------

--
-- Table structure for table `file_change`
--

CREATE TABLE IF NOT EXISTS `file_change` (
  `fcid` int(12) NOT NULL AUTO_INCREMENT COMMENT 'ID of the file modification',
  `hid` int(12) NOT NULL COMMENT 'ID of task change history record which this file related to',
  `fid` int(11) NOT NULL COMMENT 'ID of the file record',
  `uid` int(8) NOT NULL COMMENT 'ID of user who did this modification',
  `did` int(11) DEFAULT NULL COMMENT 'ID of which directory the file modification belong to',
  `name` varchar(259) NOT NULL COMMENT 'file name in this modification',
  `version` int(5) NOT NULL COMMENT 'version number',
  `size` int(25) NOT NULL COMMENT 'file size',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT 'type of operation',
  `time` datetime NOT NULL COMMENT 'time record of the modification',
  `ip` varchar(30) DEFAULT NULL COMMENT 'IP log',
  `description` varchar(8000) DEFAULT NULL COMMENT 'description',
  PRIMARY KEY (`fcid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `file_change`
--

INSERT INTO `file_change` (`fcid`, `hid`, `fid`, `uid`, `did`, `name`, `version`, `size`, `type`, `time`, `ip`, `description`) VALUES
(1, 1, 1, 1, NULL, 'test.txt', 1, 1, 1, '2011-08-01 23:47:42', NULL, NULL),
(2, 1, 1, 1, 1, 'test.txt', 2, 1, 4, '2011-09-01 23:58:15', NULL, 'move test.txt to new dir'),
(3, 1, 2, 1, 1, 'test2.txt', 1, 123456789, 0, '2011-09-04 02:01:39', NULL, 'file2change1');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `pid` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID of the project',
  `uid` int(8) DEFAULT NULL COMMENT 'ID of group leader',
  `name` varchar(250) NOT NULL COMMENT 'project name',
  `private` int(1) NOT NULL DEFAULT '0' COMMENT 'identify private project or not',
  `start` datetime DEFAULT NULL COMMENT 'start time',
  `end` datetime DEFAULT NULL COMMENT 'due time',
  `description` varchar(8000) DEFAULT NULL COMMENT 'description',
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`pid`, `uid`, `name`, `private`, `start`, `end`, `description`) VALUES
(1, NULL, 'test project', 0, '2011-09-01 23:49:12', '2011-11-03 23:49:18', 'test project description');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `tid` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID of the task',
  `pid` int(8) NOT NULL COMMENT 'ID of project which the task belong to',
  `uid` int(8) NOT NULL COMMENT 'ID of user which responsible to',
  `name` varchar(500) NOT NULL COMMENT 'task name',
  `predecessor` int(8) DEFAULT NULL COMMENT 'ID of predecessor task',
  `priority` int(1) NOT NULL DEFAULT '1' COMMENT 'task priority',
  `start` datetime DEFAULT NULL COMMENT 'start time',
  `end` datetime DEFAULT NULL COMMENT 'due time',
  `lock` int(1) NOT NULL DEFAULT '0' COMMENT 'status of locked or not',
  `description` varchar(8000) DEFAULT NULL COMMENT 'description',
  PRIMARY KEY (`tid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`tid`, `pid`, `uid`, `name`, `predecessor`, `priority`, `start`, `end`, `lock`, `description`) VALUES
(1, 1, 1, 'test task', NULL, 1, '2011-09-04 23:50:08', '2011-09-23 23:50:11', 1, 'test task description'),
(2, 1, 1, 'test task2', 1, 1, '2011-09-06 02:09:30', '2011-09-21 02:09:42', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_history`
--

CREATE TABLE IF NOT EXISTS `task_history` (
  `hid` int(12) NOT NULL AUTO_INCREMENT COMMENT 'ID of this task history',
  `tid` int(10) NOT NULL COMMENT 'ID of task which the history related to',
  `uid` int(8) NOT NULL COMMENT 'ID of user who updated the task history',
  `version` int(5) NOT NULL COMMENT 'version number of the history',
  `percent` int(3) DEFAULT NULL COMMENT 'percentage finished predict',
  `time` datetime NOT NULL COMMENT 'time of the history submitted',
  `ip` varchar(30) DEFAULT NULL COMMENT 'IP log',
  `description` varchar(8000) DEFAULT NULL COMMENT 'description',
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `task_history`
--

INSERT INTO `task_history` (`hid`, `tid`, `uid`, `version`, `percent`, `time`, `ip`, `description`) VALUES
(1, 1, 1, 1, 10, '2011-09-01 23:50:59', NULL, 'test task change'),
(2, 1, 1, 2, 99, '2011-09-06 03:00:19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(8) NOT NULL AUTO_INCREMENT COMMENT 'ID of user',
  `name_first` varchar(100) NOT NULL COMMENT 'first name',
  `name_middle` varchar(100) DEFAULT NULL COMMENT 'middle name',
  `name_last` varchar(100) NOT NULL COMMENT 'last name',
  `password` varchar(50) NOT NULL COMMENT 'nick name',
  `email` varchar(100) NOT NULL COMMENT 'email address',
  `type` int(1) NOT NULL DEFAULT '1' COMMENT 'type of user (0=admin, 1=regular)',
  `name_nickname` varchar(50) NOT NULL COMMENT 'nick name',
  `title` varchar(30) DEFAULT NULL COMMENT 'title',
  `telephone` varchar(30) DEFAULT NULL COMMENT 'contact number',
  `address_1` varchar(60) DEFAULT NULL COMMENT 'address line 1',
  `address_2` varchar(60) DEFAULT NULL COMMENT 'address line 2',
  `address_3` varchar(60) DEFAULT NULL COMMENT 'address line 3',
  `address_city` varchar(40) DEFAULT NULL COMMENT 'city',
  `address_county` varchar(40) DEFAULT NULL COMMENT 'county',
  `address_country` varchar(40) DEFAULT NULL COMMENT 'country',
  `address_postcode` varchar(15) DEFAULT NULL COMMENT 'post code',
  `lastlogin_time` datetime DEFAULT NULL COMMENT 'last log-in time',
  `lastlogin_ip` varchar(50) DEFAULT NULL COMMENT 'last log-in IP address',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT 'status (0=disabled, 1=active)',
  `valid_start` datetime NOT NULL COMMENT 'register time or valid from time',
  `valid_end` datetime DEFAULT NULL COMMENT 'invalid time',
  `description` mediumtext COMMENT 'description',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='user information' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name_first`, `name_middle`, `name_last`, `password`, `email`, `type`, `name_nickname`, `title`, `telephone`, `address_1`, `address_2`, `address_3`, `address_city`, `address_county`, `address_country`, `address_postcode`, `lastlogin_time`, `lastlogin_ip`, `status`, `valid_start`, `valid_end`, `description`) VALUES
(1, 'Sheng', NULL, 'Yu', 'c3b29ce20ce560efdc6f6714612a1156', 'sy595@cs.york.ac.uk', 1, 'sy595', 'Mr', '07760650866', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2011-09-12 13:39:06', '127.0.0.1', 1, '2011-08-31 08:46:42', NULL, 'Hi, I am Sheng Yu, the developer of WVCS.');
