<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

/**
 * App\Fruit
 * @property string id
 * @property string periodsId 期数
 * @property string result 结果
 * @property string content 官方值
 * @property string statusCode
 * @property string resultTime 揭晓时间
 * @property string created_at
 * @property string updated_at
 * @mixin \Eloquent
 */
class Fruit extends Model
{
    const STATUS_INIT = 'INIT';

    const STATUS_FINISH = 'FINISH';
    //
    protected $table = 'fruits';

    protected $primaryKey = 'id';

    /**
     * 获取首页列表
     * @param null $page
     * @return array
     * @author 693566361@qq.com
     * @time 2019/5/12 14:14
     */
    public static function getHomePageList($page = null){
        $fruits = Fruit::orderBy('periodsId' , 'desc')->where([
            'statusCode' => Fruit::STATUS_FINISH,
        ])->paginate(10 , null , 'page' , $page);

        $newFruit = Fruit::where(['statusCode' => Fruit::STATUS_INIT])->orderBy('periodsId' , 'DESC')->first();

        return [
            'fruits' => $fruits,
            'newFruit' => $newFruit,
        ];
    }

}
