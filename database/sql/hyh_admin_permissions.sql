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

 Date: 10/03/2019 02:32:11
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
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT 0 COMMENT '是否菜单 0否 1是',
  `params` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '额外参数，直接字符串拼接',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 50 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of hyh_admin_permissions
-- ----------------------------
INSERT INTO `hyh_admin_permissions` VALUES (1, 'admin.permission', '权限管理', '', 0, 'fa-users', '2016-05-21 10:06:50', '2016-06-22 13:49:09', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (2, 'admin.permission.index', '权限列表', '', 1, '', '2016-05-21 10:08:04', '2016-05-21 10:08:04', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (3, 'admin.permission.create', '权限添加', '', 1, '', '2016-05-21 10:08:18', '2016-05-21 10:08:18', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (4, 'admin.permission.edit', '权限修改', '', 1, '', '2016-05-21 10:08:35', '2016-05-21 10:08:35', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (5, 'admin.permission.destroy ', '权限删除', '', 1, '', '2016-05-21 10:09:57', '2016-05-21 10:09:57', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (6, 'admin.role.index', '角色列表', '', 1, '', '2016-05-23 10:36:40', '2016-05-23 10:36:40', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (7, 'admin.role.create', '角色添加', '', 1, '', '2016-05-23 10:37:07', '2016-05-23 10:37:07', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (8, 'admin.role.edit', '角色修改', '', 1, '', '2016-05-23 10:37:22', '2016-05-23 10:37:22', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (9, 'admin.role.destroy', '角色删除', '', 1, '', '2016-05-23 10:37:48', '2016-05-23 10:37:48', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (10, 'admin.user.index', '用户管理', '', 1, '', '2016-05-23 10:38:52', '2016-05-23 10:38:52', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (11, 'admin.user.create', '用户添加', '', 1, '', '2016-05-23 10:39:21', '2016-06-22 13:49:29', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (12, 'admin.user.edit', '用户编辑', '', 1, '', '2016-05-23 10:39:52', '2016-05-23 10:39:52', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (13, 'admin.user.destroy', '用户删除', '', 1, '', '2016-05-23 10:40:36', '2016-05-23 10:40:36', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (14, 'admin.tipnews', '提示消息管理', '提示消息管理', 0, 'fa-gittip', '2019-02-18 21:20:46', '2019-03-09 20:15:18', 1, '');
INSERT INTO `hyh_admin_permissions` VALUES (15, 'admin.tipnews.index', '提示消息列表', '', 14, '', '2019-02-18 21:21:10', '2019-03-09 20:15:45', 1, '');
INSERT INTO `hyh_admin_permissions` VALUES (16, 'admin.tipnews.update', '查看tipnews', '', 14, '', '2019-02-18 22:07:14', '2019-02-18 22:07:14', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (17, 'admin.tipnews.create', '创建tipnews', '', 14, '', '2019-02-18 22:07:52', '2019-02-18 22:07:52', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (18, 'admin.tipnews.save', '增加、编辑tipnews', '', 14, '', '2019-02-18 22:08:29', '2019-02-18 22:08:29', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (19, 'admin.tipnews.del', '删除tipnews', '', 14, '', '2019-02-18 22:08:49', '2019-02-18 22:08:49', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (20, 'admin.topic', '专题管理', '', 0, 'fa-ra', '2019-02-20 20:01:55', '2019-02-20 20:01:55', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (21, 'admin.topic.index', '专题列表', '', 20, '', '2019-02-20 20:02:30', '2019-02-20 20:02:30', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (22, 'admin.topic.update', '查看专题', '', 20, '', '2019-02-20 20:06:16', '2019-02-20 20:06:16', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (23, 'admin.topic.save', '增加、编辑专题', '', 20, '', '2019-02-20 20:06:41', '2019-02-20 20:06:41', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (24, 'admin.topic.create', '创建专题', '', 20, '', '2019-02-20 20:07:05', '2019-02-20 20:07:05', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (25, 'admin.topic.del', '删除专题', '', 20, '', '2019-02-20 20:07:20', '2019-02-20 20:07:20', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (26, 'admin.sides', '幻灯片管理', '', 0, 'fa-simplybuilt', '2019-02-20 20:28:12', '2019-02-20 20:28:12', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (27, 'admin.sides.index', '幻灯片列表', '', 26, '', '2019-02-20 20:28:47', '2019-02-20 20:28:47', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (28, 'admin.system', '系统设置', '', 0, 'fa-gear', '2019-02-21 21:10:31', '2019-02-21 21:10:31', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (29, 'admin.system.aboutus_index', '关于我们', '', 28, '', '2019-02-21 21:11:56', '2019-02-21 21:11:56', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (30, 'admin.system.aboutus_store', '编辑关于我们', '', 28, '', '2019-02-21 21:12:20', '2019-02-21 21:12:20', 0, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (31, 'admin.goods', '商品管理', '', 0, 'fa-html5', '2019-02-26 22:35:07', '2019-02-26 22:35:07', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (32, 'admin.goods.index', '商品列表', '', 31, '', '2019-02-26 22:56:51', '2019-02-26 22:56:51', 1, NULL);
INSERT INTO `hyh_admin_permissions` VALUES (33, 'admin.sides.update', '查看幻灯片', '', 26, '', '2019-02-27 14:32:35', '2019-02-27 14:32:35', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (34, 'admin.sides.save', '添加/修改幻灯片', '', 26, '', '2019-02-27 14:33:08', '2019-02-27 14:33:08', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (35, 'admin.sides.create', '增加幻灯片', '', 26, '', '2019-02-27 14:33:33', '2019-02-27 14:33:33', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (36, 'admin.sides.del', '删除幻灯片', '', 26, '', '2019-02-27 14:33:57', '2019-02-27 14:33:57', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (37, 'admin.sides.sides_type', '获取幻灯片分类', '', 26, '', '2019-02-27 14:34:24', '2019-02-27 14:34:24', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (38, 'admin.system.upload', '图片上传接口', '', 28, '', '2019-02-27 14:35:39', '2019-02-27 14:35:39', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (39, 'admin.goods.update', '查看商品详情', '', 31, '', '2019-02-27 14:36:26', '2019-02-27 14:36:26', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (40, 'admin.goods.save', '审核商品状态', '', 31, '', '2019-02-27 14:36:55', '2019-02-27 14:36:55', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (42, 'admin.category.index', '商品分类管理', '', 31, '', '2019-02-27 23:18:54', '2019-02-27 23:18:54', 1, '');
INSERT INTO `hyh_admin_permissions` VALUES (43, 'admin.category.create', '创建分类', '', 31, '', '2019-02-27 23:19:37', '2019-02-27 23:19:37', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (44, 'admin.category.update', '查看分类', '', 31, '', '2019-02-27 23:20:05', '2019-02-27 23:20:05', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (45, 'admin.category.save', '增加/编辑分类', '', 31, '', '2019-02-27 23:20:54', '2019-02-27 23:20:54', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (46, 'admin.category.del', '删除分类', '', 31, '', '2019-02-27 23:21:49', '2019-02-27 23:21:49', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (47, 'admin.topic.goods', '专题下商品', '', 20, '', '2019-03-10 00:23:51', '2019-03-10 00:23:51', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (48, 'admin.topic.savegoods', '保存专题商品', '', 20, '', '2019-03-10 00:24:16', '2019-03-10 00:24:16', 0, '');
INSERT INTO `hyh_admin_permissions` VALUES (49, 'admin.topic.delgoods', '删除专题商品', '', 20, '', '2019-03-10 02:21:57', '2019-03-10 02:21:57', 0, '');

SET FOREIGN_KEY_CHECKS = 1;
