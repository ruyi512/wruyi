<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: IndexController.class.php
 * User: Timothy Zhang
 * Date: 14-1-11
 * Time: 下午1:40
 */
namespace Home\Controller;

use Think\Hook;

/**
 * 首页控制器
 * Class IndexController
 * @package Home\Controller
 */
class IndexController extends HomeBaseController
{

    /**
     * 构造函数
     */
    function __construct()
    {
        parent::__construct();
    }

    /**
     * 显示首页
     */
    public function index()
    {

        $this->display('index');
    }

    /**
     * 显示首页为空时
     * @param $method
     * @param $args
     */
    public function _empty($method, $args)
    {
        Hook::listen('home_index_empty');

    }

}