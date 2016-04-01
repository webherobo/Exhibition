/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : exhibition

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2016-04-01 17:53:16
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for logs
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `contents` varchar(255) DEFAULT NULL,
  `ip` varchar(32) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of logs
-- ----------------------------

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `enname` varchar(32) NOT NULL,
  `pid` int(8) NOT NULL,
  `status` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员', 'superadmin', '0', '0');

-- ----------------------------
-- Table structure for students
-- ----------------------------
DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `email` varchar(64) DEFAULT NULL,
  `ages` int(3) DEFAULT NULL,
  `card_id` int(20) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `receipt` tinyint(2) DEFAULT NULL,
  `receiver` varchar(32) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `update_time` datetime DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=gbk;

-- ----------------------------
-- Records of students
-- ----------------------------
INSERT INTO `students` VALUES ('1', '同学q', 'ss@qqw.vv', '8', '2147483647', '2147483647', '0', '甲老师', '5日活动', '2016-04-01 12:51:45', '2016-04-01 12:51:45');
INSERT INTO `students` VALUES ('3', 'q同学cc', 'qq@qq.wnm', '8', '2147483647', '2147483647', '1', '甲老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('4', '同学cc', 'qq@qq2.wnm', '8', '2147483647', '2147483647', '0', '甲老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('5', '同学cbc', 'qq@qq2.wbnm', '8', '2147483647', '2147483647', '1', '甲老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('6', 'jamnet', 'admin123@qq.com', '5', '2147483647', '2147483647', '0', '盛老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('8', 'jamnet2', 'admin123@qq.comm', '5', '2147483647', '2147483647', '1', '盛老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('9', 'admin', 'ww@qq.com', '6', '2147483647', '2147483647', '1', '甲老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('10', 'adminw', 'ww@qq.com', '6', '2147483647', '2147483647', '1', '甲老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('11', 'adminww', 'ww@qq.com', '6', '2147483647', '2147483647', '1', '甲老师', '5日活动', null, null);
INSERT INTO `students` VALUES ('12', 'adminwwq', 'ww@qq.com', '6', '2147483647', '2147483647', '1', '甲老师', '5日活动', null, null);

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `rolename` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `update_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `create_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` tinyint(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '超级管理员', 'admin123@qq.com', '202cb962ac59075b964b07152d234b70', '2016-03-31 11:34:06', '2016-03-31 10:50:36', '1');
INSERT INTO `user` VALUES ('2', 'myadmin', '超级管理员', 'qq@qq.nm', '202cb962ac59075b964b07152d234b70', '2016-04-01 14:24:21', '2016-03-31 14:05:01', '1');
INSERT INTO `user` VALUES ('4', 'wwww', '超级管理员', 'ww@qq.com', 'd41d8cd98f00b204e9800998ecf8427e', '2016-03-31 17:15:37', '2016-03-31 14:45:32', '1');
INSERT INTO `user` VALUES ('5', 'weqw', '', 'ww@qq.comw', 'efe6398127928f1b2e9ef3207fb82663', '2016-03-31 17:16:04', '2016-03-31 17:16:04', '0');
INSERT INTO `user` VALUES ('6', 'qweqwe', '', '346953127@qq.comw', '157eb9ce33644ada6d0499c1097c4f5d', '2016-03-31 17:16:39', '2016-03-31 17:16:39', '0');
INSERT INTO `user` VALUES ('7', 'admin2', '', 'wwq@qq.com', '21232f297a57a5a743894a0e4a801fc3', '2016-04-01 09:59:15', '2016-04-01 09:59:15', '0');
INSERT INTO `user` VALUES ('8', 'admin4', '超级管理员', 'ww2@qq.comw', '21232f297a57a5a743894a0e4a801fc3', '2016-04-01 10:01:02', '2016-04-01 10:01:02', '0');
INSERT INTO `user` VALUES ('9', 'fff', '超级管理员', '346953q127@qq.com', '343d9040a671c45832ee5381860e2996', '2016-04-01 10:03:10', '2016-04-01 10:03:10', '0');
