/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : dormitorysys

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2019-03-07 16:48:22
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `identify` varchar(8) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admins
-- ----------------------------

-- ----------------------------
-- Table structure for adminsdetail
-- ----------------------------
DROP TABLE IF EXISTS `adminsdetail`;
CREATE TABLE `adminsdetail` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `sexX` varchar(255) NOT NULL,
  `addressX` varchar(255) DEFAULT NULL,
  `iphoneX` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adminsdetail
-- ----------------------------

-- ----------------------------
-- Table structure for housing
-- ----------------------------
DROP TABLE IF EXISTS `housing`;
CREATE TABLE `housing` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `houseIDX` int(8) NOT NULL DEFAULT '0',
  `stateX` bit(1) NOT NULL DEFAULT b'0' COMMENT '0：为租房。1：为买房。',
  `iphoneX` varchar(255) NOT NULL,
  `is_Del` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of housing
-- ----------------------------

-- ----------------------------
-- Table structure for repair
-- ----------------------------
DROP TABLE IF EXISTS `repair`;
CREATE TABLE `repair` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `houseIDX` int(8) NOT NULL DEFAULT '0',
  `iphoneX` varchar(255) NOT NULL,
  `repairX` varchar(255) DEFAULT NULL,
  `stateX` bit(1) NOT NULL DEFAULT b'0',
  `is_Del` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of repair
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `identify` varchar(8) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------

-- ----------------------------
-- Table structure for usersdetail
-- ----------------------------
DROP TABLE IF EXISTS `usersdetail`;
CREATE TABLE `usersdetail` (
  `ID` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `sexX` varchar(255) NOT NULL,
  `addressX` varchar(255) DEFAULT NULL,
  `iphoneX` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of usersdetail
-- ----------------------------
