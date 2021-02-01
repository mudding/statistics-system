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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';


CREATE TABLE `account` (
    `id` char(18) NOT NULL COMMENT '主键',
    `user_id` char(18) NOT NULL COMMENT '关联的用户id',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金,5=美股港股,6=虚拟币',
    `account_name` char(64) NOT NULL COMMENT '账户名称',
    `account_no` char(64) NOT NULL COMMENT '账户号码',
    `total` decimal(18,2)  DEFAULT 0.00 COMMENT '总金额(浮动)',
    `balance` decimal(18,2)  DEFAULT 0.00 COMMENT '可用余额(浮动)',
    `frozen` decimal(18,2)  DEFAULT 0.00 COMMENT '冻结金额-持单的最大亏损金额汇总(浮动)',
    `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`),
    KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
    KEY `key_user_id` (`user_id`) USING BTREE COMMENT '用户id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='账户表';


CREATE TABLE `variety` (
    `id` char(18) NOT NULL COMMENT '主键',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金,5=美股港股,6=虚拟币',
    `variety_name` char(64) NOT NULL COMMENT '品种名称',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='交易品种表';


CREATE TABLE `order_log` (
    `id` char(18) NOT NULL COMMENT '主键',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金,5=美股港股,6=虚拟币',
    `no` int(32) NOT NULL COMMENT '订单序号(初始单/加仓单，同个序号)',
    `order_type` tinyint(4) NOT NULL COMMENT '订单类型，1=初始单，2=加仓单',
    `order_status` tinyint(4) DEFAULT 2 COMMENT '订单状态,1=持单中,2=平仓一部分,3=该条数据全部平仓,4=计划中,5=计划失败',
    `account_id` char(18) NOT NULL COMMENT '关联的账户Id',
    `variety_id` char(18) NOT NULL COMMENT '交易品种Id',
    `max_loss_amount` decimal(18,4)  DEFAULT 0.0000 COMMENT '最大亏损金额(同个订单序号的最大亏损金额)',
    `input_signal_time_id` tinyint(4) DEFAULT 2 COMMENT '入场信号周期id',
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
    `output_reason` text  DEFAULT NULL COMMENT '出场理由',
    `output_images` text  DEFAULT NULL COMMENT '出场图片',
    `total` decimal(18,2)  DEFAULT 0.00 COMMENT '总金额',
    `balance` decimal(18,2)  DEFAULT 0.00 COMMENT '可用余额',
    `frozen` decimal(18,2)  DEFAULT 0.00 COMMENT '冻结金额',
    `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`),
    KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
    KEY `key_no` (`no`) USING BTREE COMMENT '订单序号'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='持单记录表';


CREATE TABLE `complete_order` (
    `id` char(18) NOT NULL COMMENT '主键',
    `account_type` tinyint(4) NOT NULL COMMENT '账户类型,1=外汇,2=期货,3=股票,4=基金,5=美股港股,6=虚拟币',
    `order_no` int(32) NOT NULL COMMENT '订单序号(初始单/加仓单，同个序号)',
    `account_id` char(18) NOT NULL COMMENT '关联的账户Id',
    `variety_id` char(18) NOT NULL COMMENT '交易品种Id',
    `input_signal_time_id` tinyint(4) DEFAULT 2 COMMENT '入场信号周期id',
    `max_loss_amount` decimal(18,4)  DEFAULT 0.0000 COMMENT '最大亏损金额',
    `hand_count` decimal(18,4)  DEFAULT 0.0000 COMMENT '总手数/仓位',
    `result_amount` decimal(18,4)  DEFAULT 0.0000 COMMENT '最终平仓所得金额',
    `result` tinyint(4)  DEFAULT 0.0000 COMMENT '结果，1=成功，2=失败',
    `risk_management` tinyint(4)  DEFAULT 0.0000 COMMENT '风险控制，1=合理仓位，2=重仓',
    `summary` text  DEFAULT NUll COMMENT '总结',
    `user_name` varchar(32) DEFAULT NULL COMMENT '操作人',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`),
    KEY `key_createdAt` (`created_at`) USING BTREE COMMENT '时间索引',
    KEY `key_account_type` (`account_type`) USING BTREE COMMENT '账户类型'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='已完成订单表';


CREATE TABLE `signal_time` (
    `id` char(18) NOT NULL COMMENT '主键',
    `signal_time_name` char(64) NOT NULL COMMENT '周期名称',
    `created_at` datetime NOT NULL COMMENT '创建时间',
    `updated_at` datetime NOT NULL COMMENT '更新时间',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='交易周期表';


INSERT INTO `signal_time` VALUES ('016013a8e503142028', '5min', '2021-01-29 14:19:17', '2021-01-29 14:19:17');
INSERT INTO `signal_time` VALUES ('016013a8ea00f82cd0', '30min', '2021-01-29 14:19:22', '2021-01-29 14:19:22');
INSERT INTO `signal_time` VALUES ('016013a8ee05decfec', '1h', '2021-01-29 14:19:26', '2021-01-29 14:19:26');
INSERT INTO `signal_time` VALUES ('016013a8f201d4203c', '4h', '2021-01-29 14:19:30', '2021-01-29 14:19:30');
INSERT INTO `signal_time` VALUES ('016013a8f6016909c8', 'day', '2021-01-29 14:19:34', '2021-01-29 14:19:34');
INSERT INTO `signal_time` VALUES ('016013a8fa01e5a6f4', 'week', '2021-01-29 14:19:38', '2021-01-29 14:19:38');
INSERT INTO `signal_time` VALUES ('016013a9050249d764', 'month', '2021-01-29 14:19:49', '2021-01-29 14:19:49');
INSERT INTO `signal_time` VALUES ('016013a933030fcbf4', 'season', '2021-01-29 14:20:35', '2021-01-29 14:20:35');
INSERT INTO `signal_time` VALUES ('016013a93c05d72058', 'year', '2021-01-29 14:20:44', '2021-01-29 14:20:44');



INSERT INTO `variety` VALUES ('016013c1de03c2bee4', 1, 'EURUSD', '2021-01-29 16:05:50', '2021-01-29 16:05:50');
INSERT INTO `variety` VALUES ('016013c1e600ac08a0', 1, 'GBPUSD', '2021-01-29 16:05:58', '2021-01-29 16:05:58');
INSERT INTO `variety` VALUES ('016013c1ec05ed73f8', 1, 'USDCAD', '2021-01-29 16:06:04', '2021-01-29 16:06:04');
INSERT INTO `variety` VALUES ('016013c1fa0300bf38', 1, 'USDCHF', '2021-01-29 16:06:18', '2021-01-29 16:06:18');
INSERT INTO `variety` VALUES ('016013c21c01186798', 1, 'USDJPY', '2021-01-29 16:06:52', '2021-01-29 16:06:52');
INSERT INTO `variety` VALUES ('016013c228023f652c', 1, 'AUDUSD', '2021-01-29 16:07:04', '2021-01-29 16:07:04');
INSERT INTO `variety` VALUES ('016013c233041bbdb4', 1, 'EURCHF', '2021-01-29 16:07:15', '2021-01-29 16:07:15');
INSERT INTO `variety` VALUES ('016013c23c0358d8bc', 1, 'GBPJPY', '2021-01-29 16:07:24', '2021-01-29 16:07:24');
INSERT INTO `variety` VALUES ('016013c2440321b2c4', 1, 'EURJPY', '2021-01-29 16:07:32', '2021-01-29 16:07:32');
INSERT INTO `variety` VALUES ('016013c25002d086b0', 1, 'XAGUSD', '2021-01-29 16:07:44', '2021-01-29 16:07:44');
INSERT INTO `variety` VALUES ('016013c25605b8aa4c', 1, 'XAUUSD', '2021-01-29 16:07:50', '2021-01-29 16:07:50');
INSERT INTO `variety` VALUES ('016013c267045ee328', 1, 'EURAUD', '2021-01-29 16:08:07', '2021-01-29 16:08:07');
INSERT INTO `variety` VALUES ('016017b2230339f4ec', 2, '沪铝(AL)', '2021-02-01 15:47:47', '2021-02-01 15:47:47');
INSERT INTO `variety` VALUES ('016017b22d0234ed18', 2, '沪铜(CU)', '2021-02-01 15:47:57', '2021-02-01 15:47:57');
INSERT INTO `variety` VALUES ('016017b234022ebd1c', 2, '沪锌(ZN)', '2021-02-01 15:48:04', '2021-02-01 15:48:04');
INSERT INTO `variety` VALUES ('016017b23a011c3e04', 2, '橡胶(RU)', '2021-02-01 15:48:10', '2021-02-01 15:48:10');
INSERT INTO `variety` VALUES ('016017b24203c8073c', 2, '螺纹钢(RB)', '2021-02-01 15:48:18', '2021-02-01 15:48:18');
INSERT INTO `variety` VALUES ('016017b248012d9258', 2, '沪铅(PB)', '2021-02-01 15:48:24', '2021-02-01 15:48:24');
INSERT INTO `variety` VALUES ('016017b24e0507e270', 2, '白银(AG)', '2021-02-01 15:48:30', '2021-02-01 15:48:30');
INSERT INTO `variety` VALUES ('016017b25503f74ad8', 2, '黄金(AU)', '2021-02-01 15:48:37', '2021-02-01 15:48:37');
INSERT INTO `variety` VALUES ('016017b25b00744348', 2, '沥青(BU)', '2021-02-01 15:48:43', '2021-02-01 15:48:43');
INSERT INTO `variety` VALUES ('016017b26b03d295f8', 2, '热轧卷板(HC)', '2021-02-01 15:48:59', '2021-02-01 15:48:59');
INSERT INTO `variety` VALUES ('016017b2be033ce544', 2, '沪镍(NI)', '2021-02-01 15:50:22', '2021-02-01 15:50:22');
INSERT INTO `variety` VALUES ('016017b2c404b1c714', 2, '沪锡(SN)', '2021-02-01 15:50:28', '2021-02-01 15:50:28');
INSERT INTO `variety` VALUES ('016017b2ca023df020', 2, '燃料油(FU)', '2021-02-01 15:50:34', '2021-02-01 15:50:34');
INSERT INTO `variety` VALUES ('016017b2cf00621560', 2, '线材(WR)', '2021-02-01 15:50:39', '2021-02-01 15:50:39');
INSERT INTO `variety` VALUES ('016017ba6c032e338c', 2, '棕榈油(P)', '2021-02-01 16:23:08', '2021-02-01 16:23:08');
INSERT INTO `variety` VALUES ('016017ba7303e4ac0c', 2, '聚乙烯(I)', '2021-02-01 16:23:15', '2021-02-01 16:23:15');
INSERT INTO `variety` VALUES ('016017ba7b03c01b1c', 2, '豆粕(M)', '2021-02-01 16:23:23', '2021-02-01 16:23:23');
INSERT INTO `variety` VALUES ('016017ba81041e56f0', 2, '豆油(Y)', '2021-02-01 16:23:29', '2021-02-01 16:23:29');
INSERT INTO `variety` VALUES ('016017ba8704185ed0', 2, '玉米(C)', '2021-02-01 16:23:35', '2021-02-01 16:23:35');
INSERT INTO `variety` VALUES ('016017ba93011f3c6c', 2, '豆二(B)', '2021-02-01 16:23:47', '2021-02-01 16:23:47');
INSERT INTO `variety` VALUES ('016017ba9c026f90d0', 2, '聚氯乙烯(V)', '2021-02-01 16:23:56', '2021-02-01 16:23:56');
INSERT INTO `variety` VALUES ('016017baa2020d97f4', 2, '焦炭(J)', '2021-02-01 16:24:02', '2021-02-01 16:24:02');
INSERT INTO `variety` VALUES ('016017baa905111584', 2, '焦煤(JM)', '2021-02-01 16:24:09', '2021-02-01 16:24:09');
INSERT INTO `variety` VALUES ('016017baaf03d7c424', 2, '铁矿石(I)', '2021-02-01 16:24:15', '2021-02-01 16:24:15');
INSERT INTO `variety` VALUES ('016017bab5007e75d4', 2, '鸡蛋(JD)', '2021-02-01 16:24:21', '2021-02-01 16:24:21');
INSERT INTO `variety` VALUES ('016017baba041ed580', 2, '纤维板(FB)', '2021-02-01 16:24:26', '2021-02-01 16:24:26');
INSERT INTO `variety` VALUES ('016017bac0022192cc', 2, '胶合板(BB)', '2021-02-01 16:24:32', '2021-02-01 16:24:32');
INSERT INTO `variety` VALUES ('016017bac605da1498', 2, '聚丙烯(PP)', '2021-02-01 16:24:38', '2021-02-01 16:24:38');
INSERT INTO `variety` VALUES ('016017bacc04aaf6f0', 2, '玉米淀粉(CS)', '2021-02-01 16:24:44', '2021-02-01 16:24:44');
INSERT INTO `variety` VALUES ('016017bad203f4c3f8', 2, '乙二醇(EG)', '2021-02-01 16:24:50', '2021-02-01 16:24:50');
INSERT INTO `variety` VALUES ('016017bad900ef7c34', 2, '粳米(RR)', '2021-02-01 16:24:57', '2021-02-01 16:24:57');
INSERT INTO `variety` VALUES ('016017bade03e1c000', 2, '苯乙烯(EB)', '2021-02-01 16:25:02', '2021-02-01 16:25:02');
INSERT INTO `variety` VALUES ('016017bae4025d9eac', 2, '生猪(IH)', '2021-02-01 16:25:08', '2021-02-01 16:25:08');
INSERT INTO `variety` VALUES ('016017bced01a39bec', 2, '白糖(SR)', '2021-02-01 16:33:49', '2021-02-01 16:33:49');
INSERT INTO `variety` VALUES ('016017bcf3059d204c', 2, '强麦(WH)', '2021-02-01 16:33:55', '2021-02-01 16:33:55');
INSERT INTO `variety` VALUES ('016017bcf900fdf674', 2, '普麦(PM)', '2021-02-01 16:34:01', '2021-02-01 16:34:01');
INSERT INTO `variety` VALUES ('016017bd0002ac0ba0', 2, '棉花(CF)', '2021-02-01 16:34:08', '2021-02-01 16:34:08');
INSERT INTO `variety` VALUES ('016017bd07000a6298', 2, '菜籽粕(RM)', '2021-02-01 16:34:15', '2021-02-01 16:34:15');
INSERT INTO `variety` VALUES ('016017bd0c031c9a78', 2, '早籼稻(RI)', '2021-02-01 16:34:20', '2021-02-01 16:34:20');
INSERT INTO `variety` VALUES ('016017bd110532cbfc', 2, '甲醇(MA)', '2021-02-01 16:34:25', '2021-02-01 16:34:25');
INSERT INTO `variety` VALUES ('016017bd16059c778c', 2, '玻璃(FG)', '2021-02-01 16:34:30', '2021-02-01 16:34:30');
INSERT INTO `variety` VALUES ('016017bd1c03058068', 2, '菜籽(RS)', '2021-02-01 16:34:36', '2021-02-01 16:34:36');
INSERT INTO `variety` VALUES ('016017bd230054bc94', 2, '菜粕(RM)', '2021-02-01 16:34:43', '2021-02-01 16:34:43');
INSERT INTO `variety` VALUES ('016017bd2804aba780', 2, '动力煤(TC)', '2021-02-01 16:34:48', '2021-02-01 16:34:48');
INSERT INTO `variety` VALUES ('016017bd2e0361ace4', 2, '粳稻(JR)', '2021-02-01 16:34:54', '2021-02-01 16:34:54');
INSERT INTO `variety` VALUES ('016017bd3501b6d888', 2, '晚籼稻(LR)', '2021-02-01 16:35:01', '2021-02-01 16:35:01');
INSERT INTO `variety` VALUES ('016017bd3e052a998c', 2, '硅铁(SF)', '2021-02-01 16:35:10', '2021-02-01 16:35:10');
INSERT INTO `variety` VALUES ('016017bd4403a72c4c', 2, '锰硅(SM)', '2021-02-01 16:35:16', '2021-02-01 16:35:16');
INSERT INTO `variety` VALUES ('016017bd4c049a677c', 2, '棉纱(CY)', '2021-02-01 16:35:24', '2021-02-01 16:35:24');
INSERT INTO `variety` VALUES ('016017bd5201daa0b0', 2, '红枣(CJ)', '2021-02-01 16:35:30', '2021-02-01 16:35:30');
INSERT INTO `variety` VALUES ('016017bd5b01ab2600', 2, '尿素(UR)', '2021-02-01 16:35:39', '2021-02-01 16:35:39');
INSERT INTO `variety` VALUES ('016017bd6005e3c31c', 2, '纯碱(SA)', '2021-02-01 16:35:44', '2021-02-01 16:35:44');
INSERT INTO `variety` VALUES ('016017bd6b052f92fc', 2, '短纤(PF)', '2021-02-01 16:35:55', '2021-02-01 16:35:55');
INSERT INTO `variety` VALUES ('016017bd7002438c10', 2, '花生(PK)', '2021-02-01 16:36:00', '2021-02-01 16:36:00');



