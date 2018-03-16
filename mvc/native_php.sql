/*
Navicat MySQL Data Transfer

Source Server         : cga
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : native_php

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2018-03-16 20:17:17
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `mvc_user`
-- ----------------------------
DROP TABLE IF EXISTS `mvc_user`;
CREATE TABLE `mvc_user` (
  `id` smallint(5) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL COMMENT '账号',
  `password` char(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of mvc_user
-- ----------------------------
