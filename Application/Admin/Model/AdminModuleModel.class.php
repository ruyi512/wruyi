<?php
/**
 * File: AdminModuleModel.class.php
 * User: tom
 * Date: 14-1-16
 * Time: 上午12:51
 */
namespace Common\Model;

use Think\Model\RelationModel;


/**
 * 后台模块模型定义
 * Class AdminModuleModel
 * @package Home\Model
 */
class AdminModuleModel extends RelationModel
{
    public function getMenus($authority=null, $contoller='', $action=''){
        if($authority != null){
            $this->where(array("id"=>array("IN", $authority)));
        }
        $data = $this->order(array("weight"=>"desc"))->select();
        $result = array("menus"=>array(), "sub_menus"=>array(), "cur_menu"=>null);
        foreach($data as $row){
            if($row['parent_id'] == 0){
                $result['menus'][] = $row;
            }else{
                $result['sub_menus'][] = $row;
                if(strtolower($contoller) == $row['controller']){
                    $actions = explode(',', $row['actions']);
                    if(in_array($action, $actions)){
                        $result['cur_menu'] = $row;
                    }
                }
            }
        }
        return $result;
    }
}