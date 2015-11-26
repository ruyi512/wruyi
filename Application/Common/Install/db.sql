set names utf8;

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
  `action` text default null comment '行为',
  `icon` varchar(16) not null default '' comment '菜单图标',
  `weight` smallint(4) unsigned not null default 0 comment '权重，值越大越靠前',
  `grade` tinyint(1) unsigned not null default 0 comment '等级，1：一级菜单，2：二级菜单，3：三级',
  PRIMARY KEY (`id`)
)ENGINE=MyISAM AUTO_INCREMENT=1000 DEFAULT CHARSET=utf8 COMMENT='后台功能模块表';


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


CREATE TABLE `options` (
  `option_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  `autoload` varchar(20) NOT NULL DEFAULT 'yes',
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COMMENT='选项表';

INSERT INTO `options` VALUES
  ('1', 'site_url', 'http://dev.wruyi.com', 'yes'),
  ('2', 'title', '', 'yes'),
  ('3', 'keywords', 'Wruyi based on ThinkPHP 3.2.1', 'yes'),
  ('4', 'description', 'Wruyi', 'yes'),
  ('5', 'foot', '', 'yes'),
  ('6', 'db_build', '20150603', 'yes'),
  ('7', 'software_author', 'GreenStudio', 'yes'),
  ('8', 'widget_about_us', '关于我们', 'yes'),
  ('9', 'software_homepage', 'http://www.greencms.net', 'yes'),
  ('10', 'software_version', 'v2.3.0603', 'yes'),
  ('11', 'software_name', 'GreenCMS v2', 'yes'),
  ('12', 'LOG_RECORD', '1', 'yes'),
  ('13', 'software_build', '20150603', 'yes'),
  ('14', 'HTML_CACHE_ON', '0', 'false'),
  ('15', 'sqlFileSize', '500000000', 'yes'),
  ('16', 'send_mail', '1', 'yes'),
  ('17', 'smtp_host', 'mail.njut.edu.cn', 'yes'),
  ('18', 'smtp_port', '25', 'yes'),
  ('19', 'smtp_user', 'test@njut.edu.cn', 'yes'),
  ('20', 'from_email', 'test@njut.edu.cn', 'yes'),
  ('21', 'smtp_pass', ' ', 'yes'), ('22', 'PAGER', '20', 'yes'), ('23', 'oem_info', 'original', 'yes'), ('24', 'db_fieldtype_check', '0', 'yes'), ('25', 'DEFAULT_FILTER', 'htmlspecialchars', 'yes'), ('26', 'COOKIE_PREFIX', 'greencms_', 'yes'), ('27', 'COOKIE_EXPIRE', '3600', 'yes'), ('28', 'COOKIE_DOMAIN', '', 'yes'), ('29', 'COOKIE_PATH', '/', 'yes'), ('30', 'DB_FIELDS_CACHE', '1', 'yes'), ('32', 'sql_mail', '', 'yes'), ('33', 'SHOW_CHROME_TRACE', '0', 'yes'), ('34', 'users_can_register', 'on', 'yes'), ('35', 'feed_open', '1', 'yes'), ('36', 'feed_num', '20', 'yes'), ('37', 'Weixin_reply_subscribe', '欢迎使用Z的博客微信服务平台！回复help获得使用帮助', 'yes'), ('38', 'Weixin_appid', ' ', 'yes'), ('39', 'Weixin_secret', ' ', 'yes'), ('40', 'Weixin_menu', ' ', 'yes'), ('41', 'weixin_token', ' ', 'yes'), ('42', 'home_url_model', '0', 'yes'), ('43', 'home_cat_model', 'native', 'yes'), ('44', 'home_tag_model', 'native', 'yes'), ('45', 'home_post_model', 'native', 'yes'), ('46', 'DATA_CACHE_TIME', '5', 'yes'), ('47', 'HTML_CACHE_TIME', '10', 'yes'), ('48', 'attachFileSuffix', 'zip,rar,doc,docx,zip,pdf,txt,ppt,pptx,xls,xlsx', 'yes'), ('49', 'attachImgSuffix', 'gif,png,jpg,jpeg,bmp', 'yes');


insert into admin_module (`id`, `name`, `parent_id`, `controller`, `action`, `icon`, `weight`, `grade`) values
  (1, '个人中心', 0, '', '', 'user', 900, 1),
  (2, '用户中心', 0, '', '', 'group', 400, 1),
  (3, '系统设置', 0, '', '', 'gear', 100, 1);


insert into admin_module (`id`, `name`, `parent_id`, `controller`, `action`, `icon`, `weight`, `grade`) values
  (100, '基本信息', 1, 'index', 'index', 'table', 900, 2),
  (101, '修改密码', 1, 'index', 'changepass', 'edit', 800, 2),
  (102, '用户管理', 2, 'user', 'index', 'list', 900, 2),
  (103, '清除缓存', 3, 'system', 'clear',  'refresh', 500, 2),
  (104, '系统信息', 3, 'system', 'info', 'table', 100, 2),
  (105, '权限管理', 3, 'role', 'index', 'list', 800, 2),
  (106, '管理员', 3, 'admin', 'index', 'list', 900, 2);


insert into admin_module (`name`, `parent_id`, `controller`, `action`, `icon`, `weight`, `grade`) values
  ('新增用户', 102, 'user', 'add', 'plus', 0, 3),
  ('编辑用户', 102, 'user', 'edit', 'edit', 0, 3),
  ('新增管理员', 106, 'admin', 'add', 'plus', 900, 3),
  ('编辑管理员', 106, 'admin', 'edit', 'edit', 900, 3),
  ('新增分组', 106, 'admin', 'add', 'plus', 900, 3),
  ('编辑分组', 106, 'admin', 'edit', 'edit', 900, 3);

insert into admin(id, user_name, `password`, nick_name, email, ctime, status) values (1, 'admin', 'b7c60757f3dbae118fb9acfc0ff01685', '超级管理员', 'admin@admin.com', 1435678987, 1);

