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
        'Member' => 'fa-group',
        'Index' => 'fa-user'
    ),


    'admin_big_menu' => array(
        'Index' => '个人中心',
        'System' => '系统设置',
    ),

    'admin_sub_menu' => array(
        'Index' => array(
            'Index/index' => '基本信息',
            'Index/changePass' => '修改密码',
        ),


        'System' => array(
            'System/clear' => '缓存清理',
            'System/info' => '系统信息',
        )
    ),


);

$config_admin = array(

    'URL_MODEL' => 0,

    'DATA_CACHE_TYPE' => get_opinion('DATA_CACHE_TYPE', false, 'File'), // 数据缓存类型,支持:File||Memcache|Xcache
    'DATA_CACHE_TIME' => get_opinion("DATA_CACHE_TIME", false, 10),
    'DEFAULT_FILTER' => get_opinion('DEFAULT_FILTER', false, 'htmlspecialchars'),
    'SHOW_PAGE_TRACE' => false,
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