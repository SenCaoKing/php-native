/*
 Navicat Premium Data Transfer

 Source Server         : 127.0.0.1
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : laravel_test

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 30/08/2018 20:20:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for articles
-- ----------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` tinyint(1) NOT NULL DEFAULT 0 COMMENT '分类id',
  `title` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `content` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '内容',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 18 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of articles
-- ----------------------------
INSERT INTO `articles` VALUES (2, 5, '文章5', '内容5', NULL, NULL, NULL);
INSERT INTO `articles` VALUES (5, 4, '文章4', '内容4', NULL, NULL, NULL);
INSERT INTO `articles` VALUES (16, 0, '标题125-1', '内容125', '2018-05-23 22:40:05', '2018-05-29 21:06:01', NULL);
INSERT INTO `articles` VALUES (8, 5, '文章5', '内容5', NULL, NULL, NULL);
INSERT INTO `articles` VALUES (9, 6, '文章6', '内容6', '2018-05-23 19:21:31', '2018-05-23 19:21:31', NULL);
INSERT INTO `articles` VALUES (10, 6, '文章6', '内容6', '2018-05-23 19:37:10', '2018-05-23 19:37:10', NULL);
INSERT INTO `articles` VALUES (11, 6, '文章6', '内容6', '2018-05-23 19:37:10', '2018-05-23 19:37:10', NULL);
INSERT INTO `articles` VALUES (12, 6, '文章6', '内容6', '2018-05-23 19:38:01', '2018-05-23 19:38:01', NULL);
INSERT INTO `articles` VALUES (13, 6, '文章6', '内容6', '2018-05-23 19:38:01', '2018-05-23 19:38:01', NULL);
INSERT INTO `articles` VALUES (15, 6, '文章6', '内容6', '2018-05-23 19:43:26', '2018-05-23 19:43:26', NULL);


SET FOREIGN_KEY_CHECKS = 1;
