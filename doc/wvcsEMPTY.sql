-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2011 at 08:25 AM
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `task`
--


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

