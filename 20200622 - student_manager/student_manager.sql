/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : student_manager

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2020-06-21 17:40:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for account_list
-- ----------------------------
DROP TABLE IF EXISTS `account_list`;
CREATE TABLE `account_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `login_account` varchar(255) NOT NULL,
  `login_name` varchar(255) DEFAULT NULL,
  `login_passwd` varchar(255) DEFAULT NULL,
  `account_type` varchar(10) DEFAULT NULL COMMENT 'C 为超级管理员\r\nB 为老师\r\n A 为学生',
  `is_delete` bit(1) DEFAULT b'0',
  PRIMARY KEY (`id`,`login_account`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of account_list
-- ----------------------------
INSERT INTO `account_list` VALUES ('5', '1702010033', '王小狗', '123456', 'A', '\0');
INSERT INTO `account_list` VALUES ('4', '1702010032', '张三丰', '123456', 'A', '\0');
INSERT INTO `account_list` VALUES ('6', '1702010036', '张靓颖', '123456', 'A', '\0');
INSERT INTO `account_list` VALUES ('7', '10001', '黎老师', '1234567', 'B', '\0');
INSERT INTO `account_list` VALUES ('8', '10002', '张老师', '123456', 'B', '\0');
INSERT INTO `account_list` VALUES ('9', '888888', '超级管理员', '123456', 'C', '\0');

-- ----------------------------
-- Table structure for student_manage_list
-- ----------------------------
DROP TABLE IF EXISTS `student_manage_list`;
CREATE TABLE `student_manage_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `student_id` varchar(255) DEFAULT NULL,
  `student_name` varchar(255) DEFAULT NULL,
  `student_class` varchar(255) DEFAULT NULL,
  `student_class_num` varchar(255) DEFAULT NULL,
  `class_teacher` varchar(255) DEFAULT NULL,
  `class_teacher_id` varchar(255) DEFAULT NULL,
  `insert_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of student_manage_list
-- ----------------------------
INSERT INTO `student_manage_list` VALUES ('5', '1702010032', '张三丰', '英语', '123', '张老师', '10002', '2020-06-21 17:21:32');
INSERT INTO `student_manage_list` VALUES ('4', '1702010032', '张三丰', '数学', '80', '张老师', '10002', '2020-06-21 17:21:23');
INSERT INTO `student_manage_list` VALUES ('6', '1702010032', '张三丰', '语文', '120', '张老师', '10002', '2020-06-21 17:21:37');
INSERT INTO `student_manage_list` VALUES ('7', '1702010033', '王小狗', '英语', '111', '张老师', '10002', '2020-06-21 17:22:04');
INSERT INTO `student_manage_list` VALUES ('8', '1702010033', '王小狗', '生物', '111', '张老师', '10002', '2020-06-21 17:22:56');
INSERT INTO `student_manage_list` VALUES ('9', '1702010033', '王小狗', '上天', '123', '张老师', '10002', '2020-06-21 17:24:20');
INSERT INTO `student_manage_list` VALUES ('10', '1702010032', '张三丰', '计算机网络', '123', '黎老师', '10001', '2020-06-21 17:37:22');
