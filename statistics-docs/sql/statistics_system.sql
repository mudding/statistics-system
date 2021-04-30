/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 80022
 Source Host           : 127.0.0.1:3306
 Source Schema         : statistics_system

 Target Server Type    : MySQL
 Target Server Version : 80022
 File Encoding         : 65001

 Date: 30/04/2021 17:08:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for account
-- ----------------------------
DROP TABLE IF EXISTS `account`;
CREATE TABLE `account` (
  `id` char(18) NOT NULL COMMENT '主键',
  `user_id` char(18) NOT NULL COMMENT '关联的用户id',
  `account_type` tinyint NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
  `account_name` char(64) NOT NULL COMMENT '账户名称',
  `account_no` char(64) NOT NULL COMMENT '账户号码',
  `total` decimal(18,2) DEFAULT '0.00' COMMENT '总金额(浮动)',
  `balance` decimal(18,2) DEFAULT '0.00' COMMENT '可用余额(浮动)',
  `frozen` decimal(18,2) DEFAULT '0.00' COMMENT '冻结金额-持单的最大亏损金额汇总(浮动)',
  `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `ratio` decimal(18,5) DEFAULT NULL COMMENT '每次做单系数',
  PRIMARY KEY (`id`),
  KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
  KEY `key_user_id` (`user_id`) USING BTREE COMMENT '用户id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账户表';

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` char(18) NOT NULL COMMENT '主键',
  `name` char(64) NOT NULL COMMENT '名称',
  `phone` char(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '手机',
  `login_count` int NOT NULL DEFAULT '0' COMMENT '登陆次数',
  `is_super_admin` tinyint NOT NULL DEFAULT '2' COMMENT '是否超级管理员',
  `last_login_time` datetime NOT NULL COMMENT '最后登陆时间',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  `password` varchar(255) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`),
  KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '创建时间索引',
  KEY `key_is_super_admin` (`is_super_admin`) USING BTREE COMMENT '超管索引'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

-- ----------------------------
-- Table structure for mood_config
-- ----------------------------
DROP TABLE IF EXISTS `mood_config`;
CREATE TABLE `mood_config` (
  `id` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `value` char(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='交易心态配置表';

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` char(18) NOT NULL COMMENT '主键',
  `account_type` tinyint NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
  `no` char(64) NOT NULL COMMENT '订单序号(初始单/加仓单，同个序号)',
  `order_type` tinyint NOT NULL COMMENT '订单类型，1=初始单，2=加仓单',
  `order_status` tinyint DEFAULT '2' COMMENT '订单状态,1=持单中,2=平仓一部分,3=该条数据全部平仓,4=计划中,5=计划失败',
  `account_id` char(18) NOT NULL COMMENT '关联的账户Id',
  `variety_id` char(18) NOT NULL COMMENT '交易品种Id',
  `max_loss_amount` decimal(18,5) DEFAULT '0.00000' COMMENT '最大亏损金额(同个订单序号的最大亏损金额)',
  `input_signal_time_id` tinyint DEFAULT '2' COMMENT '入场信号周期id',
  `input_hand_count` decimal(18,5) DEFAULT '0.00000' COMMENT '手数/仓位(单条)',
  `input_point` decimal(18,5) DEFAULT '0.00000' COMMENT '入场点数',
  `deposit` decimal(18,5) DEFAULT '0.00000' COMMENT '保证金',
  `loss_point` decimal(18,5) DEFAULT NULL COMMENT '止损点位',
  `loss_amount` decimal(18,5) DEFAULT '0.00000' COMMENT '该仓位止损金额(单条)',
  `input_reason` text COMMENT '入场理由',
  `input_images` text COMMENT '入场图片',
  `output_hand_count` decimal(18,5) DEFAULT '0.00000' COMMENT '单条平仓手数/仓位(最后一次)',
  `output_point` decimal(18,5) DEFAULT '0.00000' COMMENT '出场点(最后一次)',
  `output_amount` decimal(18,5) DEFAULT '0.00000' COMMENT '单条平仓所得金额(最后一次)',
  `output_log` text COMMENT '平仓日志(多次平仓记录)',
  `output_reason` text COMMENT '出场理由',
  `output_images` text COMMENT '出场图片',
  `total` decimal(18,2) DEFAULT '0.00' COMMENT '总金额',
  `balance` decimal(18,2) DEFAULT '0.00' COMMENT '可用余额',
  `frozen` decimal(18,2) DEFAULT '0.00' COMMENT '冻结金额',
  `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
  KEY `key_no` (`no`) USING BTREE COMMENT '订单序号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='持单记录表';

-- ----------------------------
-- Table structure for order_end
-- ----------------------------
DROP TABLE IF EXISTS `order_end`;
CREATE TABLE `order_end` (
  `id` char(18) NOT NULL COMMENT '主键',
  `account_type` tinyint NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
  `order_id` char(18) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '订单id',
  `order_no` char(64) NOT NULL COMMENT '订单序号(初始单/加仓单，同个序号)',
  `account_id` char(18) NOT NULL COMMENT '关联的账户Id',
  `variety_id` char(18) NOT NULL COMMENT '交易品种Id',
  `input_signal_time_id` tinyint DEFAULT '2' COMMENT '入场信号周期id',
  `max_loss_amount` decimal(18,5) DEFAULT '0.00000' COMMENT '最大亏损金额',
  `hand_count` decimal(18,5) DEFAULT '0.00000' COMMENT '总手数/仓位',
  `result_amount` decimal(18,5) DEFAULT '0.00000' COMMENT '最终平仓所得金额',
  `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`),
  KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
  KEY `key_account_type` (`account_type`) USING BTREE COMMENT '账户类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='已完成订单表';

-- ----------------------------
-- Table structure for order_end_evaluate
-- ----------------------------
DROP TABLE IF EXISTS `order_end_evaluate`;
CREATE TABLE `order_end_evaluate` (
  `id` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `order_id` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `system_risk` tinyint DEFAULT '0' COMMENT '系统根据公式自评风险，1-合理，2-重仓',
  `is_success` tinyint DEFAULT '0' COMMENT '自评该订单是否成功，1-成功，2-失败\n',
  `order_evaluate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '订单评价',
  `is_done_system` tinyint DEFAULT '0' COMMENT '是否按照系统做单，1-是，2-否',
  `is_stop_loss` tinyint DEFAULT '0' COMMENT '离场的原因是否触碰止损离场，1-是，2-否',
  `is_normal_stop_loss` tinyint DEFAULT '0' COMMENT '设置的止损是否合理，1-合理，2-不合理（不止损/窄止损）',
  `is_leaving_too_early` tinyint DEFAULT '0' COMMENT '是否过早离场，1-是，2-否',
  `is_normal_point` tinyint DEFAULT '0' COMMENT '手数是否正常，1-是，2-否',
  `is_free` tinyint DEFAULT '0' COMMENT '是否自在，1-是，2-否',
  `mood_evaluate` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT '情绪评价',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `mood_list` char(255) DEFAULT NULL COMMENT '情绪id列表',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='完成订单的评价表';

-- ----------------------------
-- Table structure for order_relation
-- ----------------------------
DROP TABLE IF EXISTS `order_relation`;
CREATE TABLE `order_relation` (
  `id` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `order_id` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '发起单/节点单id',
  `order_no` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT '订单号',
  `order_add_id` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '加仓单id',
  `order_add_no` char(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT '加仓单号',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单关联表';

-- ----------------------------
-- Table structure for signal_time
-- ----------------------------
DROP TABLE IF EXISTS `signal_time`;
CREATE TABLE `signal_time` (
  `id` char(18) NOT NULL COMMENT '主键',
  `signal_time_name` char(64) NOT NULL COMMENT '周期名称',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='交易周期表';

-- ----------------------------
-- Table structure for variety
-- ----------------------------
DROP TABLE IF EXISTS `variety`;
CREATE TABLE `variety` (
  `id` char(18) NOT NULL COMMENT '主键',
  `account_type` tinyint NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
  `variety_name` char(64) NOT NULL COMMENT '品种名称',
  `created_at` datetime NOT NULL COMMENT '创建时间',
  `updated_at` datetime NOT NULL COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='交易品种表';

SET FOREIGN_KEY_CHECKS = 1;
