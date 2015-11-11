<?php
/**
 * File: AuthCodeModel.class.php
 * User: tom
 * Date: 14-1-16
 * Time: 上午12:51
 */
namespace Common\Model;

use Think\Model\RelationModel;


/**
 * 授权码模型定义
 * Class AuthCodeModel
 * @package Home\Model
 */
class AuthCodeModel extends RelationModel
{

    protected $validTime = 1800;

    public function genCode($scene, $role=''){
        $now = time();
        $code = md5($scene . $now . $role);
        $info = $this->where(array("scene"=>$scene, 'role'=>$role, 'status'=>0))->find();
        if($info){
            $this->save(array('id'=>$info['id'], 'code'=>$code, 'scene'=>$scene, 'ctime'=>$now, 'role'=>$role));
        }else{
            $this->add(array('code'=>$code, 'scene'=>$scene, 'ctime'=>$now, 'role'=>$role));
        }
        return $code;
    }


    public function useCode($code){
        $info = $this->where(array("code"=>$code))->find();
        if($info){
            if($info['status'] == 0 || $info['ctime'] - $this->validTime < time()){
                $this->save(array("id"=>$info['id'], "status"=>1));
                return $info['role'];
            }
        }
        E('授权码无效');
    }

}