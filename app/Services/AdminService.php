<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 0:24
 */
namespace App\Services;

use App\Model\Admin\Menu;

class AdminService
{
    /**
     * 获取菜单树数组
     * @return array
     * @author 693566361@qq.com
     * @time 2019/6/11 1:30
     */
    public function getMenu(){
        return Menu::getMenuTree();
    }

    /**
     * 获取菜单html
     * @return string
     * @author 693566361@qq.com
     * @time 2019/6/11 1:30
     */
    public function getMenuHtml(){
        return $this->renderMenuHtml($this->getMenu());
    }

    /**
     * 递归渲染菜单html
     * @param $menuTree
     * @param int $step
     * @return string
     * @author 693566361@qq.com
     * @time 2019/6/11 1:30
     */
    protected function renderMenuHtml($menuTree , $step = 0){
        $html = "";
        foreach ($menuTree as $item){
            $info = $item['info'];
            $html .= '<li data-step="'. $step .'" >';
            $icon = $step == 0 ? ('<i data-step="'. $step .'" class="fa '. $info['icon'] .'"></i>') : '';
            $jian = $item['children'] ? '<span class="fa arrow"></span>' : '';
            $html .= '<a> '. $icon .' <span class="nav-label">'. $info['title'] .'</span> ' .$jian. '</a>';
            if($item['children']){
                $html .= '<ul class="nav nav-second-level">';
                $html .= self::renderMenuHtml($item['children'] , $step + 1);
                $html .= '</ul>';
            }
            $html .= "</li>";
        }
        return $html;
    }
}