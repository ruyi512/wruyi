<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: config.php
 * User: Timothy Zhang
 * Date: 14-1-15
 * Time: 下午11:23
 */


$menu_arr = array(

    'admin_big_menu_icon' => array(
        'Posts' => 'fa-book',
        'Data' => 'fa-bar-chart-o',
        'Media' => 'fa-camera',
        'Custom' => 'fa-desktop',
        'Comments' => 'fa-comment',
        'Access' => 'fa-lock',
        'Tools' => 'fa-gavel',
        'System' => 'fa-gear',
        'Other' => 'fa-tag',
        'Member' => 'fa-user',
    ),


    'admin_big_menu' => array(
        'Index' => '仪表盘',
        'Member' => '会员中心',
        'Posts' => '文章页面',
        'Data' => '数据缓存',
        //  'Comments'=>'留言评论',
        'Media' => '文件附件',
        'Custom' => '定制中心',
        'Access' => '用户安全',
        'Tools' => '小工具',
        'System' => '系统设置',
        'Other' => '其他',
    ),

    'admin_sub_menu' => array(
        'Index' => array(
            'Index/index' => '基本信息',

        ),

        'Member' => array(
            'Member/profile' => '用户信息',
            'Member/sns' => '社交账号绑定',
            'Member/changePass' => '修改密码',

        ),


        'Posts' => array(

            'Posts/index' => '所有文章',
            'Posts/page' => '页面列表',

            'Posts/add' => '添加文章',

            'Posts/category' => '分类管理',
            'Posts/tag' => '标签管理',


            'Posts/reverify' => '未通过',
            'Posts/unverified' => '待审核',

            'Posts/draft' => '草稿箱',
            'Posts/recycle' => '回收站',

//todo            'Posts/stats' => '信息统计',

        ),


//        'Comments' => array(
//            'Comments/index' => '留言',
//
//        ),


        'Data' => array(
            'Data/index' => '数据库备份',
            'Data/restore' => '数据库导入',
            'Data/zipList' => '数据库压缩',
            'Data/repair' => '数据库优化',
            'Data/clear' => '缓存清理',


        ),

        'Custom' => array(
            'Custom/plugin' => '插件管理',
            'Custom/theme' => '主题管理',
            'Custom/menu' => '菜单管理',
            'Custom/hooks' => '钩子管理',
            'Custom/linkgroup' => '链接管理',

        ),


        'Media' => array(
            'Media/file' => '文件管理',
            'Media/backupFile' => '文件备份',
            'Media/restoreFile' => '文件恢复',
        ),

        'Access' => array(
            'Access/index' => '用户管理',
            'Access/guest' => '游客管理',
            'Access/nodelist' => '节点管理',
            'Access/rolelist' => '角色管理',
//            'Access/addUser' => '添加用户',
//            'Access/addNode' => '添加节点',
//            'Access/addRole' => '添加角色',

            'Access/loginlog' => '登陆记录',
            //  'Access/log' => '操作记录',

        ),

        'Tools' => array(
            'Tools/index' => '可用工具',
            'Tools/log' => '日志工具',
            'Tools/wordpress' => '从WordPress导入',
            'Tools/count' => '统计工具',

            // 'Tools/rss'    => '从rss导入',
            // 'Tools/export'    => '导出',

        ),


        'System' => array(
            'System/index' => '站点设置',
            'System/user' => '用户设置',

            'System/post' => '文章设置',
            'System/attach' => '附件设置',
            'System/url' => '链接设置',
            'System/safe' => '安全选项',
            'System/db' => '数据库设置',
            'System/cache' => '缓存设置',

            'System/email' => '系统邮件配置',
//            'System/kvset'  => '其他设置',
            'System/sns' => '社交登录设置',
            'System/green' => '开发者选项置',
            'System/update' => '在线更新',
            'System/info' => '系统信息',
            'System/bugs' => 'Bug反馈',


        )
    ),


);

$config_admin = array(

    'URL_MODEL' => 0,

    'DATA_CACHE_TYPE' => get_opinion('DATA_CACHE_TYPE', false, 'File'), // 数据缓存类型,支持:File||Memcache|Xcache
    'DATA_CACHE_TIME' => get_opinion("DATA_CACHE_TIME", false, 10),
    'DEFAULT_FILTER' => get_opinion('DEFAULT_FILTER', false, 'htmlspecialchars'),
    'SHOW_PAGE_TRACE' => get_opinion('SHOW_PAGE_TRACE', false, false),
    'SHOW_CHROME_TRACE' => get_opinion('SHOW_CHROME_TRACE', false, false),


    'COOKIE_PREFIX' => get_opinion('COOKIE_PREFIX', false, 'greencms_'),
    'COOKIE_EXPIRE' => get_opinion('COOKIE_EXPIRE', false, 3600),
    'COOKIE_DOMAIN' => get_opinion('COOKIE_DOMAIN', false),
    'COOKIE_PATH' => get_opinion('COOKIE_PATH', false),


    'LOG_LEVEL' => get_opinion('LOG_LEVEL', false),
    'LOG_RECORD' => (bool)get_opinion('LOG_RECORD', false),

    /*
     * RBAC认证配置信息
    */
    'USER_AUTH_ON' => true,
    'USER_AUTH_TYPE' => 2, // 默认认证类型 1 登录认证 2 实时认证
    'USER_AUTH_KEY' => 'authId', // 用户认证SESSION标记
    'ADMIN_AUTH_KEY' => 'ADMIN',
    'USER_AUTH_MODEL' => 'User', // 默认验证数据表模型
    'AUTH_PWD_ENCODER' => 'md5', // 用户认证密码加密方式encrypt
    'USER_AUTH_GATEWAY' => '?s=/Admin/Login/index', // 默认认证网关
    'NOT_AUTH_MODULE' => 'Public', // 默认无需认证模块
    'REQUIRE_AUTH_MODULE' => '', // 默认需要认证模块
    'NOT_AUTH_ACTION' => '', // 默认无需认证操作
    'REQUIRE_AUTH_ACTION' => '', // 默认需要认证操作
    'GUEST_AUTH_ON' => false, // 是否开启游客授权访问
    'GUEST_AUTH_ID' => 0, // 游客的用户ID
    'RBAC_ROLE_TABLE' => GreenCMS_DB_PREFIX . 'role',
    'RBAC_USER_TABLE' => GreenCMS_DB_PREFIX . 'role_users',
    'RBAC_ACCESS_TABLE' => GreenCMS_DB_PREFIX . 'access',
    'RBAC_NODE_TABLE' => GreenCMS_DB_PREFIX . 'node',
    'DEFAULT_THEME' => "Default",
);


return array_merge($config_admin, $menu_arr);