/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : phone

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2019-05-02 16:25:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for phonedata
-- ----------------------------
DROP TABLE IF EXISTS `phonedata`;
CREATE TABLE `phonedata` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `Date` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`,`Phone`)
) ENGINE=MyISAM AUTO_INCREMENT=1146 DEFAULT CHARSET=utf8;
