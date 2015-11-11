<?php
/**
 * Created by GreenStudio GCS Dev Team.
 * File: CommonWidget.class.php
 * User: Timothy Zhang
 * Date: 14-1-25
 * Time: 上午10:41
 */

namespace Admin\Widget;

use Think\Controller;

/**
 * Class CommonWidget
 * @package Admin\Widget
 */
class CommonWidget extends Controller
{
    /**
     *
     */
    public function header()
    {


        $this->display('Widget:header');

    }

    /**
     * @FBI Warning ！除非你有空闲时间，否则不要没事读这段丧心病狂的代码。。
     * AdminLTE主题使用的侧边栏版本~
     * @return string
     */
    public function sideMenu()
    {

        $menu = $this->show_side_menu();


        $this->assign('menu', $menu);
        $this->display('Widget:sideMenu');
    }


    private function show_side_menu()
    {

        $role = D('AdminRole')->find($_SESSION['admin']['role_id']);
        $authority = explode(',', $role['authority']);
        $menus = D('AdminModule')->getMenus($authority, CONTROLLER_NAME, ACTION_NAME);
        $content = '';
        foreach($menus['menus'] as $menu){
            $icon = 'fa fa-' . $menu['icon'];
            $css = $menus['cur_menu']['parent_id'] == $menu['id'] ? 'treeview active' : 'treeview';
            $content .= '<li id="'.$menu['id'].'" class="' . $css . '">
                        <a href="#"><i class="' . $icon . '"></i><span>' . $menu['name'] . '</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">';

            foreach($menus['sub_menus'] as $sub_menu){
                if($sub_menu['parent_id'] != $menu['id']){
                    continue;
                }
                $css = $sub_menu['id'] == $menus['cur_menu']['id'] ? 'active' : '';
                $content .= '<li  id="'.$sub_menu['id'].'" class="' . $css . '"><a href="' . U("Admin/" . $sub_menu['gateway']) . '"><i class="fa fa-angle-double-right"></i>' . $sub_menu['name'] . '</a></li>';
            }
            $content .= "</ul></li>\n";
        }
        return $content;
    }


    /**
     *
     */
    public function footer()
    {


        $footer_content = get_opinion('footer_content');

        $this->assign('footer_content', $footer_content);
        $this->display('Widget:footer');
    }

}