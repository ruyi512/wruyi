<?php
namespace Admin\Controller;

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
        if(IS_POST){
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
        }else{
            $this->display();
        }
    }

}