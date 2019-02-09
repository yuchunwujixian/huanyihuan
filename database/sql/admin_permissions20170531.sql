/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : jiongmi_game

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-05-31 13:44:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名',
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限解释名称',
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '描述与备注',
  `cid` tinyint(4) NOT NULL COMMENT '级别',
  `icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '图标',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
INSERT INTO `admin_permissions` VALUES ('1', 'admin.permission', '权限管理', '', '0', 'fa-users', '2016-05-21 10:06:50', '2016-06-22 13:49:09');
INSERT INTO `admin_permissions` VALUES ('2', 'admin.permission.index', '权限列表', '', '1', '', '2016-05-21 10:08:04', '2016-05-21 10:08:04');
INSERT INTO `admin_permissions` VALUES ('3', 'admin.permission.create', '权限添加', '', '1', '', '2016-05-21 10:08:18', '2016-05-21 10:08:18');
INSERT INTO `admin_permissions` VALUES ('4', 'admin.permission.edit', '权限修改', '', '1', '', '2016-05-21 10:08:35', '2016-05-21 10:08:35');
INSERT INTO `admin_permissions` VALUES ('5', 'admin.permission.destroy ', '权限删除', '', '1', '', '2016-05-21 10:09:57', '2016-05-21 10:09:57');
INSERT INTO `admin_permissions` VALUES ('6', 'admin.role.index', '角色列表', '', '1', '', '2016-05-23 10:36:40', '2016-05-23 10:36:40');
INSERT INTO `admin_permissions` VALUES ('7', 'admin.role.create', '角色添加', '', '1', '', '2016-05-23 10:37:07', '2016-05-23 10:37:07');
INSERT INTO `admin_permissions` VALUES ('8', 'admin.role.edit', '角色修改', '', '1', '', '2016-05-23 10:37:22', '2016-05-23 10:37:22');
INSERT INTO `admin_permissions` VALUES ('9', 'admin.role.destroy', '角色删除', '', '1', '', '2016-05-23 10:37:48', '2016-05-23 10:37:48');
INSERT INTO `admin_permissions` VALUES ('10', 'admin.user.index', '用户管理', '', '1', '', '2016-05-23 10:38:52', '2016-05-23 10:38:52');
INSERT INTO `admin_permissions` VALUES ('11', 'admin.user.create', '用户添加', '', '1', '', '2016-05-23 10:39:21', '2016-06-22 13:49:29');
INSERT INTO `admin_permissions` VALUES ('12', 'admin.user.edit', '用户编辑', '', '1', '', '2016-05-23 10:39:52', '2016-05-23 10:39:52');
INSERT INTO `admin_permissions` VALUES ('13', 'admin.user.destroy', '用户删除', '', '1', '', '2016-05-23 10:40:36', '2016-05-23 10:40:36');
INSERT INTO `admin_permissions` VALUES ('16', 'admin.job.category.index', '职业分类列表', '职业分类', '27', '', '2017-03-17 11:46:21', '2017-04-18 13:08:34');
INSERT INTO `admin_permissions` VALUES ('17', 'admin.job.category.del', '删除职位', '删除职位', '27', '', '2017-03-17 21:27:04', '2017-03-17 21:27:04');
INSERT INTO `admin_permissions` VALUES ('18', 'admin.job.category.create', '创建职位', '创建职位', '27', '', '2017-03-17 21:27:29', '2017-03-17 21:27:49');
INSERT INTO `admin_permissions` VALUES ('19', 'admin.job.category.save', '修改或增加职位', '修改或增加职位', '27', '', '2017-03-17 21:28:09', '2017-03-17 21:28:09');
INSERT INTO `admin_permissions` VALUES ('20', 'admin.job.category.view', '查看职位', '查看职位', '27', '', '2017-03-17 21:28:30', '2017-03-17 21:28:30');
INSERT INTO `admin_permissions` VALUES ('22', 'admin.welfare.index', '福利列表', '福利列表', '27', '', '2017-03-19 01:27:35', '2017-03-19 01:27:35');
INSERT INTO `admin_permissions` VALUES ('23', 'admin.welfare.view', '查看福利', '查看福利', '27', '', '2017-03-19 01:28:19', '2017-03-19 01:28:19');
INSERT INTO `admin_permissions` VALUES ('24', 'admin.welfare.create', '创建福利', '创建福利', '27', '', '2017-03-19 01:29:02', '2017-03-19 01:29:02');
INSERT INTO `admin_permissions` VALUES ('25', 'admin.welfare.del', '删除福利', '删除福利', '27', '', '2017-03-19 01:29:40', '2017-03-19 01:29:40');
INSERT INTO `admin_permissions` VALUES ('26', 'admin.welfare.save', '修改或添加福利', '修改或添加福利', '27', '', '2017-03-19 01:30:05', '2017-03-19 01:30:05');
INSERT INTO `admin_permissions` VALUES ('27', 'admin.job', '招聘管理', '', '0', 'fa-sliders', '2017-03-20 18:22:20', '2017-04-17 23:01:36');
INSERT INTO `admin_permissions` VALUES ('28', 'admin.job.index', '职位列表', '', '27', '', '2017-03-20 18:22:40', '2017-03-20 18:22:40');
INSERT INTO `admin_permissions` VALUES ('30', 'admin.company.index', '公司管理', '', '27', '', '2017-03-21 17:25:34', '2017-03-21 17:25:34');
INSERT INTO `admin_permissions` VALUES ('31', 'admin.system', '网站相关', '', '0', 'fa-sliders', '2017-03-21 18:38:00', '2017-04-18 23:09:54');
INSERT INTO `admin_permissions` VALUES ('32', 'admin.feedback.index', '反馈列表', '', '31', '', '2017-03-21 18:38:20', '2017-03-21 18:38:20');
INSERT INTO `admin_permissions` VALUES ('33', 'admin.aboutus.index', '关于我们', '', '31', '', '2017-04-18 23:10:26', '2017-04-18 23:10:26');
INSERT INTO `admin_permissions` VALUES ('34', 'admin.aboutus.store', '关于我们-保存', '', '31', '', '2017-04-18 23:10:50', '2017-04-18 23:10:50');
INSERT INTO `admin_permissions` VALUES ('35', 'admin.community', '社区管理', '社区管理', '0', 'fa-recycle', '2017-05-02 21:54:27', '2017-05-02 21:54:27');
INSERT INTO `admin_permissions` VALUES ('36', 'admin.community.index', '发帖列表', '发帖列表', '35', '', '2017-05-02 21:55:19', '2017-05-02 21:55:19');
INSERT INTO `admin_permissions` VALUES ('37', 'admin.community.update', '查看帖子', '查看帖子', '35', '', '2017-05-02 22:21:15', '2017-05-02 22:21:15');
INSERT INTO `admin_permissions` VALUES ('38', 'admin.demand', '需求管理', '需求管理', '0', 'fa-asterisk', '2017-05-09 10:39:09', '2017-05-09 10:39:09');
INSERT INTO `admin_permissions` VALUES ('39', 'admin.product.index', '产品研发榜', '', '38', '', '2017-05-09 10:40:14', '2017-05-09 10:44:03');
INSERT INTO `admin_permissions` VALUES ('40', 'admin.product.update', '查看产品研发', '查看产品研发', '38', '', '2017-05-09 15:35:03', '2017-05-09 15:35:03');
INSERT INTO `admin_permissions` VALUES ('41', 'admin.product.store', '修改产品研发', '修改产品研发', '38', '', '2017-05-09 15:35:32', '2017-05-09 15:35:32');
INSERT INTO `admin_permissions` VALUES ('42', 'admin.product.destroy', '删除产品研发榜', '删除产品研发榜', '38', '', '2017-05-09 16:05:21', '2017-05-09 16:05:21');
INSERT INTO `admin_permissions` VALUES ('43', 'admin.issue.demand.index', '发布需求榜', '发布需求榜', '38', '', '2017-05-09 16:23:00', '2017-05-09 16:23:19');
INSERT INTO `admin_permissions` VALUES ('44', 'admin.issue.demand.update', '查看发布需求', '', '38', '', '2017-05-09 16:23:55', '2017-05-09 16:23:55');
INSERT INTO `admin_permissions` VALUES ('45', 'admin.issue.demand.store', '审核发布需求', '', '38', '', '2017-05-09 16:24:35', '2017-05-09 16:24:35');
INSERT INTO `admin_permissions` VALUES ('46', 'admin.issue.demand.destroy', '删除发布需求', '', '38', '', '2017-05-09 16:25:05', '2017-05-09 16:25:05');
INSERT INTO `admin_permissions` VALUES ('47', 'admin.channel.demand.index', '渠道需求榜', '', '38', '', '2017-05-25 21:25:03', '2017-05-25 21:25:03');
INSERT INTO `admin_permissions` VALUES ('48', 'admin.channel.demand.update', '查看渠道需求', '', '38', '', '2017-05-25 21:26:11', '2017-05-25 21:26:11');
INSERT INTO `admin_permissions` VALUES ('49', 'admin.channel.demand.store', '审核渠道需求', '', '38', '', '2017-05-25 21:26:49', '2017-05-25 21:26:49');
INSERT INTO `admin_permissions` VALUES ('50', 'admin.channel.demand.destroy', '删除渠道需求', '', '38', '', '2017-05-25 21:27:39', '2017-05-25 21:27:39');
INSERT INTO `admin_permissions` VALUES ('51', 'admin.outsource.index', '外包供需榜', '', '38', '', '2017-05-31 13:22:13', '2017-05-31 13:22:13');
INSERT INTO `admin_permissions` VALUES ('52', 'admin.outsource.update', '查看发布外包', '', '38', '', '2017-05-31 13:22:58', '2017-05-31 13:22:58');
INSERT INTO `admin_permissions` VALUES ('53', 'admin.outsource.store', '审核发布外包', '', '38', '', '2017-05-31 13:23:31', '2017-05-31 13:23:31');
INSERT INTO `admin_permissions` VALUES ('54', 'admin.outsource.destroy', '删除发布外包', '', '38', '', '2017-05-31 13:24:02', '2017-05-31 13:24:02');
