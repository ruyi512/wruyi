<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: AdminBaseController.class.php
 * User: Timothy Zhang
 * Date: 14-1-25
 * Time: 上午10:39
 */

namespace Admin\Controller;

use Common\Controller\BaseController;
use Common\Util\GreenPage;
use Think\Model;

/**
 * Class AdminBaseController
 * @package Admin\Controller
 */
class AdminBaseController extends BaseController
{

    private $module_name = '';
    private $action_name = '';
    private $group_name = '';


    /**
     *
     */
    public function __construct()
    {

        parent::__construct();

        $this->_initialize();

        $this->_currentPostion();

        $this->_currentAdmin();

        $this->_recordCurrentPage();

//        $this->customConfig();
        C('TMPL_CACHE_ON',false);

    }

    /**
     *
     */
    protected function _initialize()
    {
        // 登录检查
        $this->checkLogin();
        // 检查权限
        $this->checkPermissions();
    }


    /**
     *
     */
    private function _currentPostion()
    {

        //  echo CONTROLLER_NAME;
        //  echo ACTION_NAME;

        $cache = get_opinion('admin_big_menu');
        foreach ($cache as $big_url => $big_name) {
            if (strtolower($big_url) == strtolower(CONTROLLER_NAME)) {
                $module = $big_name;
                $module_url = U("Admin/" . "$big_url" . '/index');
            } else {
            }
        }

        $cache = get_opinion('admin_sub_menu');
        foreach ($cache as $big_url => $big_name) {
            if (strtolower($big_url) == strtolower(CONTROLLER_NAME)) {
                foreach ($big_name as $sub_url => $sub_name) {
                    $sub_true_url = explode('/', $sub_url);
                    if (!strcasecmp($sub_true_url [1], strtolower(ACTION_NAME))) {
                        $action = $sub_name;
                        $action_url = U("Admin/" . "$sub_url");
                    }
                }
            }
        }

        $icon = C('admin_big_menu_icon');
        $menu_icon = $icon[ucfirst(CONTROLLER_NAME)];

        $this->assign('group', '管理');
        $this->assign('module', $module);
        $this->assign('action', $action);
        $this->assign('menu_icon', $menu_icon);
        $this->assign('module_url', $module_url);
        $this->assign('action_url', $action_url);

    }

    private function _currentAdmin(){
        $this->assign('admin', $_SESSION['admin']);
    }

    private function _recordCurrentPage()
    {
        if (!IS_AJAX) {
            cookie("last_visit_page", base64_encode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING']), 3600 * 24 * 30);
        }
    }

    protected function checkLogin(){
        if(! $_SESSION['admin']){
            $this->error('请先登录', U('Admin/Login/index'));
        }
    }

    protected function checkPermissions(){

    }

    public function index()
    {
        $page = I('get.page', 20);
        $model = D(CONTROLLER_NAME);
        $count = $model->count();
        if ($count != 0) {
            $Page = new GreenPage($count, $page); // 实例化分页类 传入总记录数
            $pager_bar = $Page->show();
            $limit = $Page->firstRow . ',' . $Page->listRows;
            $list = $model->limit($limit)->select();
        }
        $this->assign('list', $list);
        $this->assign('pager', $pager_bar);
        $this->display();
    }

    public function delete(){
        $id = I("get.id");
        D(CONTROLLER_NAME)->delete($id);
        $this->success('删除成功');
    }

    public function edit(){
        $model = D(CONTROLLER_NAME);
        if(IS_POST){
            $model->create($_POST, Model::MODEL_UPDATE);
            $model->save();
        }else{
            $data = $model->find(I('get.id'));
            $this->assign('data', $data);
            $this->display();
        }
    }

    public function add(){
        if(IS_POST){
            $model = D(CONTROLLER_NAME);
            $model->create($_POST, Model::MODEL_INSERT);
            $model->add();
        }else{
            $this->display();
        }
    }
}