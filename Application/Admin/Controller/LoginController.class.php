<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: LoginController.class.php
 * User: Timothy Zhang
 * Date: 14-1-25
 * Time: 上午10:39
 */

namespace Admin\Controller;

use Common\Controller\BaseController;
use Common\Util\GreenMail;
use Think\Exception;
use Think\Verify;

/**
 * Class LoginController
 * @package Admin\Controller
 */
class LoginController extends BaseController
{


    public function __construct()
    {
        parent::__construct();
        C('TMPL_CACHE_ON',false);

    }

    /**
     * 自动登陆处理
     */
    public function _before_index()
    {

        $user_session = cookie('user_session');

        if ($user_session) {
            //auto login
            if (D('Admin')->verifySession($user_session)) {
                //登陆成功
                if(cookie("last_visit_page")){
                    redirect(base64_decode(cookie("last_visit_page")));
                }else{
                    $this->redirect('Admin/Index/index');
                }

            }

        }


    }

    /**
     * 首页
     */
    public function index()
    {
        $this->display();
    }

    /**
     * 登陆
     */
    public function login()
    {
        $this->vertifyHandle();

        $user_name = I('post.username');
        $password = I('post.password');
        $remember = I('post.remember');

        $admin_info = D('Admin')->verify($user_name, $password);
        if($admin_info){
            if($remember){
                $user_session = D('Manager')->genHash($admin_info['id'], $password);
                cookie('user_session', $user_session, 3600 * 24 * 30);
            }
            $_SESSION['admin'] = $admin_info;
            $this->success("登录成功", U("Admin/Index/index"));
        }else{
            $this->error("用户名或者密码错误", U("Admin/Login/index"));
        }

    }

    /**
     * 验证码
     */
    public function vertifyHandle()
    {
        if (get_opinion('vertify_code', true, true)) {
            $verify = new Verify();

            if (!$verify->check(I('post.vertify'), "AdminLogin")) {
                $this->error("验证码错误");
            }
        }

    }

    /**
     * 找回密码
     */
    public function forgetpassword()
    {
        $this->display();
    }

    /**
     * 找回密码处理
     */
    public function forgetpasswordHandle()
    {
        $this->vertifyHandle();

        if (IS_POST) {
            $user_name = I('post.username');
            $admin = D('Admin')->getByUserName($user_name);
            if(!$admin){
                $this->error('用户不存在');
            }else{
                $mail = new GreenMail();
                $auth_code = D('AuthCode')->genCode('forgetpassword', $admin['id']);
                $res =  $mail->sendMail( $admin['email'], "", "用户密码重置", "新密码: " . $auth_code);
                if ($res['statue']) {
                    $this->success("新密码的邮件已经发送到注册邮箱");

                } else {
                    $this->error("请检查邮件发送设置".$res['info']);
                }
            }
        }
    }

    public function resetPassword(){
        if(IS_POST){
            $password = I('password');
            if($password != I('password_re')){
                $this->error('两次输入的密码不一致');
            }
            try{
                $code = I('code');
                $role = D('AuthCode')->useCode($code);
                D('Admin')->resetPassword($role, $password);
                $this->success('重置密码成功', U('Admin/Login/index'));
            }catch (Exception $e){
                $this->error($e->getMessage());
            }
        }else{
            $this->display();
        }
    }



    /**
     * 注销
     */
    public function logout()
    {
        unset($_SESSION['admin']);
        $this->success("安全退出成功", U("Admin/Login/index"));
    }

    /**
     * 验证码
     */
    public function vertify()
    {

        $config = array(
            'fontSize' => 30,
            'length' => 4,
            'useCurve' => true,
            'useNoise' => true,
        );


        $Verify = new Verify($config);
        $Verify->entry("AdminLogin");
    }

}