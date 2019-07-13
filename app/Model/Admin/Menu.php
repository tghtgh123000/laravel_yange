<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'admin_menu';

    /**
     * 获取菜单列表
     * @return array
     * @author 693566361@qq.com
     * @time 2019/6/10 1:19
     */
    public static function getMenuTree(){
        $list = self::orderBy('sort' , 'desc')->orderBy('id' , 'asc')->get();
        $menu = self::getTree(0 , $list);

        return $menu;
    }

    /**
     * 获取树形菜单
     * @param $pid
     * @param $list
     * @return array
     * @author 693566361@qq.com
     * @time 2019/6/11 0:21
     */
    protected static function getTree($pid , $list){
        $tree = [];
        foreach ($list as $k => $r){
            if($r['pid'] == $pid){
                unset($list[$k]);
                $tree[] = [
                    'id' => $r['id'],
                    'info' => $r->toArray(),
                    'children' => self::getTree($r['id'] , $list),
                ];
            }
        }
        return $tree;
    }
}