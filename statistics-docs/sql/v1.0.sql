CREATE TABLE `admin_user` (
    `id` char(18) NOT NULL COMMENT '主键',
    `name` char(64) NOT NULL COMMENT '名称',
    `phone` char(32) NOT NULL COMMENT '手机',
    `password` varchar(255) NOT NULL COMMENT '密码',
    `login_count` int(32) NOT NULL DEFAULT '0' COMMENT '登陆次数',
    `is_super_admin` tinyint(4) NOT NULL DEFAULT '2' COMMENT '是否超级管理员',
    `last_login_time` datetime NOT NULL COMMENT '最后登陆时间',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`),
    KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '创建时间索引',
    KEY `key_is_super_admin` (`is_super_admin`) USING BTREE COMMENT '超管索引'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表'


CREATE TABLE `account` (
    `id` char(18) NOT NULL COMMENT '主键',
    `user_id` char(18) NOT NULL COMMENT '关联的用户id',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
    `account_name` char(64) NOT NULL COMMENT '账户名称',
    `account_no` char(64) NOT NULL COMMENT '账户号码',
    `account_status` tinyint(4) DEFAULT 2 COMMENT '账户状态(默认空仓),1=持单中,2=空仓',
    `total` decimal(18,2)  DEFAULT 0.00 COMMENT '总金额(浮动)',
    `balance` decimal(18,2)  DEFAULT 0.00 COMMENT '可用余额(浮动)',
    `frozen` decimal(18,2)  DEFAULT 0.00 COMMENT '冻结金额-持单的最大亏损金额汇总(浮动)',
    `occupancy_rate` decimal(18,2)  DEFAULT 0.00 COMMENT '资金使用率',
    `profit` decimal(18,2)  DEFAULT 0.00 COMMENT '盈利(订单结束计算)',
    `loss` decimal(18,2)  DEFAULT 0.00 COMMENT '亏损(订单结束计算)',
    `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`),
    KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
    KEY `key_user_id` (`user_id`) USING BTREE COMMENT '用户id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账户表'


CREATE TABLE `variety` (
    `id` char(18) NOT NULL COMMENT '主键',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
    `variety_name` char(64) NOT NULL COMMENT '品种名称',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='交易品种表'


CREATE TABLE `order_log` (
    `id` char(18) NOT NULL COMMENT '主键',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
    `no` int(32) NOT NULL COMMENT '订单序号(初始单/加仓单，同个序号)',
    `order_type` tinyint(4) NOT NULL COMMENT '订单类型，1=初始单，2=加仓单',
    `account_status` tinyint(4) DEFAULT 2 COMMENT '订单状态,1=持单中,2=平仓一部分,3=该条数据全部平仓',
    `account_id` char(18) NOT NULL COMMENT '关联的账户Id',
    `variety_id` char(18) NOT NULL COMMENT '交易品种Id',
    `max_loss_amount` decimal(18,4)  DEFAULT 0.0000 COMMENT '最大亏损金额(同个订单序号的最大亏损金额)=单条冻结金额',
    `input_hand_count` decimal(18,4)  DEFAULT 0.0000 COMMENT '手数/仓位(单条)',
    `input_point` decimal(18,4)  DEFAULT 0.0000 COMMENT '入场点数',
    `deposit` decimal(18,4)  DEFAULT 0.0000 COMMENT '保证金',
    `loss_amount` decimal(18,4)  DEFAULT 0.0000 COMMENT '该仓位止损金额(单条)',
    `input_reason` text  DEFAULT NULL COMMENT '入场理由',
    `input_images` text  DEFAULT NULL COMMENT '入场图片',
    `output_hand_count` decimal(18,4)  DEFAULT 0.0000 COMMENT '单条平仓手数/仓位(最后一次)',
    `output_point` decimal(18,4)  DEFAULT 0.0000 COMMENT '出场点(最后一次)',
    `output_amount` decimal(18,4)  DEFAULT 0.0000 COMMENT '单条平仓所得金额(最后一次)',
    `output_log` text DEFAULT NULL COMMENT '平仓日志(多次平仓记录)',
    `output_reason` text  DEFAULT NULL COMMENT '入场理由',
    `output_images` text  DEFAULT NULL COMMENT '入场图片',
    `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`),
    KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
    KEY `key_no` (`no`) USING BTREE COMMENT '订单序号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='持单记录表'


CREATE TABLE `complete_order` (
    `id` char(18) NOT NULL COMMENT '主键',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金',
    `order_no` int(32) NOT NULL COMMENT '订单序号(初始单/加仓单，同个序号)',
    `account_id` char(18) NOT NULL COMMENT '关联的账户Id',
    `variety_id` char(18) NOT NULL COMMENT '交易品种Id',
    `max_loss_amount` decimal(18,4)  DEFAULT 0.0000 COMMENT '最大亏损金额',
    `hand_count` decimal(18,4)  DEFAULT 0.0000 COMMENT '总手数/仓位',
    `result` decimal(18,4)  DEFAULT 0.0000 COMMENT '最终平仓所得金额',
    `summary` text  DEFAULT NUll COMMENT '总结',
    `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`),
    KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
    KEY `key_account_type` (`account_type`) USING BTREE COMMENT '账户类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='已完成订单表'




INSERT INTO variety ( id, account_type, variety_name, created_at, updated_at )
VALUES
	( ),
	( )