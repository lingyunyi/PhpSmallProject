/*
Navicat MySQL Data Transfer

Source Server         : A
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : student_manager

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2020-06-06 15:32:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for login_users
-- ----------------------------
DROP TABLE IF EXISTS `login_users`;
CREATE TABLE `login_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `passwd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of login_users
-- ----------------------------
INSERT INTO `login_users` VALUES ('1', '123', '123');
INSERT INTO `login_users` VALUES ('2', '123456', '123456');

-- ----------------------------
-- Table structure for student_info
-- ----------------------------
DROP TABLE IF EXISTS `student_info`;
CREATE TABLE `student_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_sex` varchar(255) DEFAULT NULL,
  `student_class` varchar(255) DEFAULT NULL,
  `student_phone` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_info
-- ----------------------------
INSERT INTO `student_info` VALUES ('11', '312', '132', '321', '231', '132');
