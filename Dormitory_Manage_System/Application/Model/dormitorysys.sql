/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : dormitorysys

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2019-04-15 00:06:36
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `ID` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `identify` varchar(16) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for adminsdetail
-- ----------------------------
DROP TABLE IF EXISTS `adminsdetail`;
CREATE TABLE `adminsdetail` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `sexX` varchar(255) NOT NULL,
  `addressX` varchar(255) DEFAULT NULL,
  `iphoneX` varchar(255) NOT NULL,
  `identify` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for housing
-- ----------------------------
DROP TABLE IF EXISTS `housing`;
CREATE TABLE `housing` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `houseIDX` int(8) NOT NULL DEFAULT '0',
  `stateX` int(2) NOT NULL DEFAULT '0' COMMENT '0',
  `iphoneX` varchar(255) NOT NULL,
  `is_Del` int(2) NOT NULL DEFAULT '0',
  `identify` varchar(255) NOT NULL,
  `timenow` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for repair
-- ----------------------------
DROP TABLE IF EXISTS `repair`;
CREATE TABLE `repair` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `houseIDX` int(8) NOT NULL DEFAULT '0',
  `iphoneX` varchar(255) NOT NULL,
  `repairX` varchar(255) DEFAULT NULL,
  `stateX` int(1) NOT NULL DEFAULT '0',
  `is_Del` int(1) NOT NULL DEFAULT '0',
  `identify` varchar(255) NOT NULL,
  `nowtime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `identify` varchar(16) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for usersdetail
-- ----------------------------
DROP TABLE IF EXISTS `usersdetail`;
CREATE TABLE `usersdetail` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `sexX` varchar(255) NOT NULL,
  `addressX` varchar(255) DEFAULT NULL,
  `iphoneX` varchar(255) NOT NULL,
  `identify` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
