<?php
namespace Admin\Controller;

use Common\Event\SystemEvent;
use Common\Util\File;

/**
 * Class SystemController
 * @package Admin\Controller
 */
class SystemController extends AdminBaseController
{

    /**
     *
     */
    public function info()
    {
        if (function_exists('gd_info')) {
            $gd = gd_info();
            $gd = $gd ['GD Version'];
        } else {
            $gd = "不支持";
        }

        $able = get_loaded_extensions();
        $extensions_list = "";
        foreach ($able as $key => $value) {
            if ($key != 0 && $key % 13 == 0) {
                $extensions_list = $extensions_list . '<br />';
            }
            $extensions_list = $extensions_list . "$value&nbsp;&nbsp;";
        }

        $info = array(
            '操作系统' => PHP_OS,
            '主机名IP端口' => $_SERVER ['SERVER_NAME'] . ' (' . $_SERVER ['SERVER_ADDR'] . ':' . $_SERVER ['SERVER_PORT'] . ')',
            '运行环境' => $_SERVER ["SERVER_SOFTWARE"],
            '服务器语言' => getenv("HTTP_ACCEPT_LANGUAGE"),
            'PHP运行方式' => php_sapi_name(),
            '管理员邮箱' => $_SERVER['SERVER_ADMIN'],
            '程序目录' => WEB_ROOT,
            'MYSQL版本' => function_exists("mysql_close") ? mysql_get_client_info() : '不支持',
            'GD库版本' => $gd,
            '上传附件限制' => ini_get('upload_max_filesize'),
            'POST方法提交限制' => ini_get('post_max_size'),
            '脚本占用最大内存' => ini_get('memory_limit'),
            '执行时间限制' => ini_get('max_execution_time') . "秒",
            '浮点型数据显示的有效位数' => ini_get('precision'),
            '内存使用状况' => round((@disk_free_space(".") / (1024 * 1024)), 5) . 'M/',
            '已用/总磁盘' => round((@disk_free_space(".") / (1024 * 1024 * 1024)), 3) . 'G/' . round(@disk_total_space(".") / (1024 * 1024 * 1024), 3) . 'G',
            '服务器时间' => date("Y年n月j日 H:i:s 秒"),
            '北京时间' => gmdate("Y年n月j日 H:i:s 秒", time() + 8 * 3600),

            '显示错误信息' => ini_get("display_errors") == "1" ? '√' : '×',
            'register_globals' => get_cfg_var("register_globals") == "1" ? '√' : '×',
            'magic_quotes_gpc' => (1 === get_magic_quotes_gpc()) ? '√' : '×',
            'magic_quotes_runtime' => (1 === get_magic_quotes_runtime()) ? '√' : '×',


        );
        $this->assign('server_info', $info);
        $this->assign('extensions_list', $extensions_list);

        $this->display('info');
    }

    /**
     *
     */
    public function clear()
    {
        $caches = array(
            "HTMLCache" => array(
                "name" => "网站HTML缓存文件",
                "path" => RUNTIME_PATH . "HTML",
                //"size" => $Dir->size(RUNTIME_PATH . "Cache"),
                "size" => File::realSize(RUNTIME_PATH . "HTML"),
            ),
            "HomeCache" => array(
                "name" => "网站缓存文件",
                "path" => RUNTIME_PATH . "Cache",
                //"size" => $Dir->size(RUNTIME_PATH . "Cache"),
                "size" => File::realSize(RUNTIME_PATH . "Cache"),
            ),
            "HomeData" => array(
                "name" => "网站数据库字段缓存文件",
                "path" => RUNTIME_PATH . "Data",
                "size" => File::realSize(RUNTIME_PATH . "Data"),
            ),
            "AdminLog" => array(
                "name" => "网站日志文件",
                "path" => LOG_PATH,
                "size" => File::realSize(LOG_PATH),
            ),
            "AdminTemp" => array(
                "name" => "网站临时文件",
                "path" => RUNTIME_PATH . "Temp",
                "size" => File::realSize(RUNTIME_PATH . "Temp"),
            ),
            "Homeruntime" => array(
                "name" => "网站~runtime.php缓存文件",
                "path" => RUNTIME_PATH . "common~runtime.php",
                //  "size" => $Dir->realsize(RUNTIME_PATH . "~runtime.php"),
                "size" => File::realSize(RUNTIME_PATH . "common~runtime.php"),
            )
        );

        // p($_POST['cache']);die;
        if (IS_POST) {

            $paths = $_POST ['cache'];
            foreach ($paths as $path) {
                if (isset ($caches [$path])) {
                    $res = File::delAll($caches [$path] ['path'], true);
                }
            }
            $SystemEvent = new SystemEvent;
            $SystemEvent->clearCacheAll();

            $this->success("清除成功");
        } else {

            $this->assign("caches", $caches);
            $this->display();
        }
    }

}