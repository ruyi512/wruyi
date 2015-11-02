<?php
/**
 * File: AdminModel.class.php
 * User: tom
 * Date: 14-1-16
 * Time: 上午12:51
 */
namespace Common\Model;

use Think\Model\RelationModel;


/**
 * 管理员模型定义
 * Class AdminModel
 * @package Home\Model
 */
class AdminModel extends RelationModel
{

    protected $trueTableName    =   'admin';


    public function verify($user_name, $password){
        $password = encrypt($password);
        $map = array("user_name" => $user_name, "password" =>$password);
        $account = $this->where($map)->find();
        return $account;
    }

    public function verifySession($session){
        $map = array('session' => $session);
        $account = $this->where($map)->find();
        return $account;
    }

    public function genHash($id, $password)
    {
        $condition['id'] = $id;
        $session_code = encrypt($id . $password . time());
        $this->where($condition)->setField('session', $session_code);
        return $session_code;
    }

    public function changePassword($id, $password, $old_password){
        $old_password = encrypt($old_password);
        $data['password'] = encrypt($password);
        return $this->where(array("id" => $id, 'password'=>$old_password))->data($data)->save();
    }

    public function resetPassword($id, $password){
        $data['password'] = encrypt($password);
        return $this->where(array("id" => $id))->data($data)->save();
    }

}