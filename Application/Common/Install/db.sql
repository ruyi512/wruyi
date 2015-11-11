CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(64) NOT NULL DEFAULT '' comment '密码',
  `nick_name` varchar(32) NOT NULL DEFAULT '' comment '昵称',
  `user_name` varchar(32) NOT NULL DEFAULT '' comment '用户名',
  `email` varchar(64) NOT NULL DEFAULT '' comment '邮箱',
  `role_id` int(10) unsigned not null default '0' comment  '分组id',
  `avatar` varchar(128) DEFAULT '' comment '头像',
  `ctime` int(10) unsigned not null default 0 comment '创建时间',
  `session` varchar(32) not null default '' comment 'session',
  `status` tinyint(1) unsigned not null default 0 comment '1：有效，0：无效',
  PRIMARY KEY (`id`),
  KEY `idx_user_name` (`user_name`),
  key `idx_session` (`session`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='后台用户表';


create table `admin_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) not null default '' comment '角色',
  `ctime` int(10) unsigned not null default 0 comment '创建时间',
  `authority` text default null comment '权限，模块id集合',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='后台用户分组表';


create table `admin_module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) not null default '' comment '模块名称',
  `parent_id` int(10) unsigned not null default 0 comment '上级模块',
  `controller` varchar(32) not null default '' comment '控制器',
  `actions` text default null comment '所有行为',
  `gateway` varchar(64) not null default '' comment '入口',
  `icon` varchar(16) not null default '' comment '菜单图标',
  `weight` smallint(4) unsigned not null default 0 comment '权重，值越大越靠前',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COMMENT='后台功能模块表';


CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(64) NOT NULL DEFAULT '' comment '密码',
  `nick_name` varchar(32) NOT NULL DEFAULT '' comment '昵称',
  `user_name` varchar(32) NOT NULL DEFAULT '' comment '用户名',
  `email` varchar(64) NOT NULL DEFAULT '' comment '邮箱',
  `avatar` varchar(128) DEFAULT '' comment '头像',
  `ctime` int(10) unsigned not null default 0 comment '创建时间',
  `status` tinyint(1) unsigned not null default 0 comment '1：正常，0：停用',
  PRIMARY KEY (`id`),
  KEY `idx_user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='用户表';


create table `auth_code`(
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(32) NOT NULL DEFAULT '' comment '随机码',
  `scene` varchar(32) not null default '' comment '场景',
  `role` varchar(32) not null default '' comment '角色',
  `ctime` int(10) unsigned not null default 0 comment '创建时间',
  `status` tinyint(1) unsigned not null default 0 comment '1：使用，0：未使用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_code` (`code`),
  key `idx_scene_role` (`scene`, `role`, `status`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='授权码表';



insert into admin_module (`id`, `name`, `parent_id`, `controller`, `actions`, `gateway`, `icon`, `weight`) values
  (1, '个人中心', 0, '', '', '', 'user', 900),
  (2, '用户中心', 0, '', '', '', 'group', 400),
  (3, '系统设置', 0, '', '', '', 'gear', 100);


insert into admin_module (`name`, `parent_id`, `controller`, `actions`, `gateway`, `icon`, `weight`) values
  ('基本信息', 1, 'index', 'index', 'Index/index', '', 900),
  ('修改密码', 1, 'index', 'changepass', 'Index/changepass', '', 800),
  ('用户管理', 2, 'user', 'index,add,edit', 'User/index', '', 900),
  ('清除缓存', 3, 'system', 'clear', 'System/clear', '', 500),
  ('系统信息', 3, 'system', 'info', 'System/info', '', 100),
  ('分组管理', 3, 'role', 'index,add,edit', 'Role/index', '', 800),
  ('管理员', 3, 'admin', 'index,add,edit', 'Admin/index', '', 900);

