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


create table `role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) not null default '' comment '角色',
  `ctime` int(10) unsigned not null default 0 comment '创建时间',
  `authority` text default null comment '权限，模块id集合',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COMMENT='后台用户分组表';


create table `module` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) not null default '' comment '模块名称',
  `parent_id` int(10) unsigned not null default 0 comment '上级模块',
  `controller` varchar(32) not null default '' comment '控制器',
  `actions` text default null comment '所有行为',
  `gateway` varchar(64) not null default '' comment '入口',
  `icon` varchar(16) not null default '' comment '菜单图标',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COMMENT='后台模块表，一个模块一个控制器';


CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `password` varchar(64) NOT NULL DEFAULT '' comment '密码',
  `nick_name` varchar(32) NOT NULL DEFAULT '' comment '昵称',
  `user_name` varchar(32) NOT NULL DEFAULT '' comment '用户名',
  `email` varchar(64) NOT NULL DEFAULT '' comment '邮箱',
  `avatar` varchar(128) DEFAULT '' comment '头像',
  `ctime` int(10) unsigned not null default 0 comment '创建时间',
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



