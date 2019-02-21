/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : 127.0.0.1:3306
 Source Schema         : huanyihuan

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 21/02/2019 00:21:12
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for hyh_admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `hyh_admin_permissions`;
CREATE TABLE `hyh_admin_permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '权限解释名称',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '描述与备注',
  `cid` tinyint(4) NOT NULL COMMENT '级别',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '图标',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hyh_admin_permissions
-- ----------------------------
INSERT INTO `hyh_admin_permissions` VALUES (1, 'admin.permission', '权限管理', '', 0, 'fa-users', '2016-05-21 10:06:50', '2016-06-22 13:49:09');
INSERT INTO `hyh_admin_permissions` VALUES (2, 'admin.permission.index', '权限列表', '', 1, '', '2016-05-21 10:08:04', '2016-05-21 10:08:04');
INSERT INTO `hyh_admin_permissions` VALUES (3, 'admin.permission.create', '权限添加', '', 1, '', '2016-05-21 10:08:18', '2016-05-21 10:08:18');
INSERT INTO `hyh_admin_permissions` VALUES (4, 'admin.permission.edit', '权限修改', '', 1, '', '2016-05-21 10:08:35', '2016-05-21 10:08:35');
INSERT INTO `hyh_admin_permissions` VALUES (5, 'admin.permission.destroy ', '权限删除', '', 1, '', '2016-05-21 10:09:57', '2016-05-21 10:09:57');
INSERT INTO `hyh_admin_permissions` VALUES (6, 'admin.role.index', '角色列表', '', 1, '', '2016-05-23 10:36:40', '2016-05-23 10:36:40');
INSERT INTO `hyh_admin_permissions` VALUES (7, 'admin.role.create', '角色添加', '', 1, '', '2016-05-23 10:37:07', '2016-05-23 10:37:07');
INSERT INTO `hyh_admin_permissions` VALUES (8, 'admin.role.edit', '角色修改', '', 1, '', '2016-05-23 10:37:22', '2016-05-23 10:37:22');
INSERT INTO `hyh_admin_permissions` VALUES (9, 'admin.role.destroy', '角色删除', '', 1, '', '2016-05-23 10:37:48', '2016-05-23 10:37:48');
INSERT INTO `hyh_admin_permissions` VALUES (10, 'admin.user.index', '用户管理', '', 1, '', '2016-05-23 10:38:52', '2016-05-23 10:38:52');
INSERT INTO `hyh_admin_permissions` VALUES (11, 'admin.user.create', '用户添加', '', 1, '', '2016-05-23 10:39:21', '2016-06-22 13:49:29');
INSERT INTO `hyh_admin_permissions` VALUES (12, 'admin.user.edit', '用户编辑', '', 1, '', '2016-05-23 10:39:52', '2016-05-23 10:39:52');
INSERT INTO `hyh_admin_permissions` VALUES (13, 'admin.user.destroy', '用户删除', '', 1, '', '2016-05-23 10:40:36', '2016-05-23 10:40:36');
INSERT INTO `hyh_admin_permissions` VALUES (14, 'admin.tipnews', 'tipnews管理', 'tipnews管理', 0, 'fa-gittip', '2019-02-18 21:20:46', '2019-02-18 21:20:46');
INSERT INTO `hyh_admin_permissions` VALUES (15, 'admin.tipnews.index', 'tipnews列表', '', 14, '', '2019-02-18 21:21:10', '2019-02-18 21:21:10');
INSERT INTO `hyh_admin_permissions` VALUES (16, 'admin.tipnews.update', '查看tipnews', '', 14, '', '2019-02-18 22:07:14', '2019-02-18 22:07:14');
INSERT INTO `hyh_admin_permissions` VALUES (17, 'admin.tipnews.create', '创建tipnews', '', 14, '', '2019-02-18 22:07:52', '2019-02-18 22:07:52');
INSERT INTO `hyh_admin_permissions` VALUES (18, 'admin.tipnews.save', '增加、编辑tipnews', '', 14, '', '2019-02-18 22:08:29', '2019-02-18 22:08:29');
INSERT INTO `hyh_admin_permissions` VALUES (19, 'admin.tipnews.del', '删除tipnews', '', 14, '', '2019-02-18 22:08:49', '2019-02-18 22:08:49');
INSERT INTO `hyh_admin_permissions` VALUES (20, 'admin.topic', '专题管理', '', 0, 'fa-ra', '2019-02-20 20:01:55', '2019-02-20 20:01:55');
INSERT INTO `hyh_admin_permissions` VALUES (21, 'admin.topic.index', '专题列表', '', 20, '', '2019-02-20 20:02:30', '2019-02-20 20:02:30');
INSERT INTO `hyh_admin_permissions` VALUES (22, 'admin.topic.update', '查看专题', '', 20, '', '2019-02-20 20:06:16', '2019-02-20 20:06:16');
INSERT INTO `hyh_admin_permissions` VALUES (23, 'admin.topic.save', '增加、编辑专题', '', 20, '', '2019-02-20 20:06:41', '2019-02-20 20:06:41');
INSERT INTO `hyh_admin_permissions` VALUES (24, 'admin.topic.create', '创建专题', '', 20, '', '2019-02-20 20:07:05', '2019-02-20 20:07:05');
INSERT INTO `hyh_admin_permissions` VALUES (25, 'admin.topic.del', '删除专题', '', 20, '', '2019-02-20 20:07:20', '2019-02-20 20:07:20');
INSERT INTO `hyh_admin_permissions` VALUES (26, 'admin.sides', '幻灯片管理', '', 0, 'fa-simplybuilt', '2019-02-20 20:28:12', '2019-02-20 20:28:12');
INSERT INTO `hyh_admin_permissions` VALUES (27, 'admin.sides.index', '幻灯片列表', '', 26, '', '2019-02-20 20:28:47', '2019-02-20 20:28:47');

SET FOREIGN_KEY_CHECKS = 1;
