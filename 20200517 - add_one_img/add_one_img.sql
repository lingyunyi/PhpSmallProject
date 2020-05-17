/*
Navicat MySQL Data Transfer

Source Server         : A
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : add_one_img

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2020-05-17 18:33:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `is_who` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(255) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `userpasswd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
