<?php
namespace Admin\Controller;

use Admin\Model\Admin;


/**
 * Class IndexController
 * @package Admin\Controller
 */
class IndexController extends AdminBaseController
{
    /**
     * 首页基本信息
     */
    public function index()
    {

        $this->display();

    }

    /**
     * 修改密码页面
     */
    public function changePass()
    {
        $this->display('changepass');
    }

    /**
     * 修改密码处理
     */
    public function changepassHandle()
    {

        if (I('post.password') != I('post.rpassword')) {
            $this->error('两次密码不同');
        }

        $uid = $_SESSION['admin']['id'];
        $result = D('Admin')->changePassword($uid, I('post.password'), I('post.opassword'));
        if($result){
            $this->success('修改密码成功');
        }else{
            $this->error("修改密码失败");
        }
    }


}