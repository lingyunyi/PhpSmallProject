/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : dormitorysys

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2019-03-25 08:30:42
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `admins`
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `ID` int(1) unsigned NOT NULL AUTO_INCREMENT,
  `identify` varchar(16) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', 'AXX', '123');
INSERT INTO `admins` VALUES ('2', '123', '1321');
INSERT INTO `admins` VALUES ('3', '1', '1');
INSERT INTO `admins` VALUES ('4', '1', '1');
INSERT INTO `admins` VALUES ('5', '1', '1');
INSERT INTO `admins` VALUES ('6', '1', '4');
INSERT INTO `admins` VALUES ('7', '5', '4');
INSERT INTO `admins` VALUES ('8', '4', '4');
INSERT INTO `admins` VALUES ('9', '5', '6');
INSERT INTO `admins` VALUES ('10', '7', '8');
INSERT INTO `admins` VALUES ('11', '7', '8');

-- ----------------------------
-- Table structure for `adminsdetail`
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
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of adminsdetail
-- ----------------------------

-- ----------------------------
-- Table structure for `housing`
-- ----------------------------
DROP TABLE IF EXISTS `housing`;
CREATE TABLE `housing` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `houseIDX` int(8) NOT NULL DEFAULT '0',
  `stateX` bit(1) NOT NULL DEFAULT b'0' COMMENT '0：为租房。1：为买房。',
  `iphoneX` varchar(255) NOT NULL,
  `is_Del` bit(1) NOT NULL DEFAULT b'0',
  `identify` varchar(255) NOT NULL,
  `timenow` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of housing
-- ----------------------------
INSERT INTO `housing` VALUES ('3', '1', '111', '', '1111', '', 'admin', '0000-00-00 00:00:00');
INSERT INTO `housing` VALUES ('4', '覃平平', '1001', '', '18070707070', '', 'ggg', '0000-00-00 00:00:00');
INSERT INTO `housing` VALUES ('5', '凌云翼', '8203', '', '18172041273', '', 'lingyunyi', '2019-03-25 08:23:36');

-- ----------------------------
-- Table structure for `repair`
-- ----------------------------
DROP TABLE IF EXISTS `repair`;
CREATE TABLE `repair` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `nameX` varchar(255) NOT NULL,
  `houseIDX` int(8) NOT NULL DEFAULT '0',
  `iphoneX` varchar(255) NOT NULL,
  `repairX` varchar(255) DEFAULT NULL,
  `stateX` bit(1) NOT NULL DEFAULT b'0',
  `is_Del` bit(1) NOT NULL DEFAULT b'0',
  `identify` varchar(255) NOT NULL,
  `nowtime` datetime DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of repair
-- ----------------------------
INSERT INTO `repair` VALUES ('4', '1', '111', '111', '我家电脑烂了，等下就屌你', '', '', 'admin', null);
INSERT INTO `repair` VALUES ('3', '1', '111', '111', '第三方', '', '', 'admin', null);
INSERT INTO `repair` VALUES ('5', '1', '111', '111', '怎么还没有来修，叼你哦', '', '', 'admin', null);
INSERT INTO `repair` VALUES ('6', '覃平平', '1001', '18070707070', '举报\'\'sfad ', '', '', 'ggg', null);
INSERT INTO `repair` VALUES ('7', '覃平平', '1001', '18070707070', '首先我们得需要报名', '', '', 'ggg', null);
INSERT INTO `repair` VALUES ('8', '覃平平', '1001', '18070707070', 'dfzs sdaf 打法', '', '', 'ggg', '2019-03-22 12:55:08');
INSERT INTO `repair` VALUES ('9', '覃平平', '1001', '18070707070', '真的很不错哦', '', '', 'ggg', '2019-03-22 12:55:51');
INSERT INTO `repair` VALUES ('10', '1', '111', '1111', '\'\'\'\'\'\'\'\' or 1 = 1', '', '', 'admin', '2019-03-22 13:03:52');
INSERT INTO `repair` VALUES ('11', '1', '111', '1111', 'DFAS', '', '', 'admin', '2019-03-22 13:07:40');
INSERT INTO `repair` VALUES ('12', '1', '111', '1111', 'SFAD AS', '', '', 'admin', '2019-03-22 13:07:44');
INSERT INTO `repair` VALUES ('13', '1', '111', '1111', 'ASFDA士大夫', '', '', 'admin', '2019-03-22 13:07:48');
INSERT INTO `repair` VALUES ('14', '1', '111', '1111', '手动阀手动阀', '', '', 'admin', '2019-03-22 13:07:52');
INSERT INTO `repair` VALUES ('15', '1', '111', '1111', '如果你要说一些事情，请拨打电话', '', '', 'admin', '2019-03-25 08:19:16');
INSERT INTO `repair` VALUES ('16', '凌云翼', '8203', '18172041273', '热水坏掉了......', '', '', 'lingyunyi', '2019-03-25 08:24:38');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `ID` int(1) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `identify` varchar(16) NOT NULL,
  `passwd` varchar(16) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `identify` (`identify`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'admin', 'admin');
INSERT INTO `users` VALUES ('2', 'fadsfdas', 'sdaffdsa');
INSERT INTO `users` VALUES ('3', 'fadsfdas', 'sdaffdsa');
INSERT INTO `users` VALUES ('4', 'ggg', 'gggg');
INSERT INTO `users` VALUES ('5', 'fsad', 'asfd');
INSERT INTO `users` VALUES ('6', 'fdas', 'fdsaf');
INSERT INTO `users` VALUES ('7', 'sdafsdaf', 'dasfsdaf');
INSERT INTO `users` VALUES ('8', 'gggasdf', 'asdfsdaf');
INSERT INTO `users` VALUES ('9', 'lingyuny', 'lingyunyi');
INSERT INTO `users` VALUES ('10', '瑕冨槈鎬', '123456');
INSERT INTO `users` VALUES ('11', '瑕冨钩骞', 'qinpingpnig');
INSERT INTO `users` VALUES ('12', 'lingyuny', 'lingyunyifsdaafs');
INSERT INTO `users` VALUES ('13', '潘登注册', 'pandeng');
INSERT INTO `users` VALUES ('14', 'lingyuny', 'lingyunyi..');

-- ----------------------------
-- Table structure for `usersdetail`
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

-- ----------------------------
-- Records of usersdetail
-- ----------------------------
INSERT INTO `usersdetail` VALUES ('1', '我我我我我', '男', '我我我我我我我', '我我我我我我我', 'admin');
INSERT INTO `usersdetail` VALUES ('5', '潘登', '南宁职业技术学院', '男', '18172000000', '潘登注册');
INSERT INTO `usersdetail` VALUES ('4', '覃平平', '女', '南宁职业', '132131323223123123', 'ggg');
INSERT INTO `usersdetail` VALUES ('6', '凌云翼', '南宁职业技术学院', '男', '18172041273', 'lingyunyi');
