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
        'System' => 'fa-gear',
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

    'DEFAULT_THEME' => "Default",
);


return array_merge($config_admin, $menu_arr);