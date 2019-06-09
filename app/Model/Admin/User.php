<?php

namespace App\Model\Admin;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'yg_admin_user';

    /**
     * @param $username
     * @param $password
     * @return self|null
     * @author 693566361@qq.com
     * @time 2019/6/10 1:18
     */
    public static function chkPwd($username , $password){

        return null;
    }

    /**
     * 是否禁止登录
     * @return bool
     * @author 693566361@qq.com
     * @time 2019/6/10 1:17
     */
    public function isForbid(){
        return false;
    }
}