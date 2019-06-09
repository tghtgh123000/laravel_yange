<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'yg_admin_menu';

    /**
     * 获取菜单列表
     * @return array
     * @author 693566361@qq.com
     * @time 2019/6/10 1:19
     */
    public static function getMenuList(){

        return [];
    }
}