<?php

namespace App\Http\Controllers\Active;

use App\Contracts\SmsContract;
use App\Fruit;
use App\Http\Controllers\Controller;
use App\Libs\Curl\Sms\ZywxSms;
use App\Libs\Sms\XycSms;
use App\Libs\Tools\CacheTool;
use App\Services\Shk3Service;
use App\Services\Sms\SmsService;
use App\Services\TimeService;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class FruitsController extends Controller
{
    protected $cacheKey = 'Fruit_getHomePageList';
    //
    public function index(){
        return view('active.fruits.index' , array_merge(CacheTool::getCacheData($this->cacheKey ,
            $this->getHomePageList() , $this->request->get('page') <= 1) , [
            'htmlTitle' => '一起玩农场 v0.1',
        ]));
    }

    public function fresh(){
        $ret = $this->freshData(date('YmdHis'));
        $ret = CacheTool::setCacheData($this->cacheKey , $this->getHomePageList(1) , 60 * 60);

        return 'Fresh Ok';
    }

    protected function getHomePageList($page = null){
        return function () use ($page){
            $data = Fruit::getHomePageList($page);
            $data['fruits']->withPath('/active/fruits');
            return $data;
        };
    }

    public function test(){


    }

    protected function freshData($time){
        if(!$time){
            \Log::error('No Refresh Time');
            return false;
        }

        $cache = true;

        $doRefresh = function(){
            $shk = new Shk3Service;
            $shk->saveOrUpdateList();
            $shk->saveNextInfo();
        };

        if($cache){
            $key = config('rediskey.fruit_refresh');
            if(!Redis::exists($key) || time() >= strtotime(Redis::get($key))){
                //刷新
                $doRefresh();
                Redis::setex($key , 60 * 30 , $time);
            }
        }else{
            $doRefresh();
        }

        try{

        }catch (\ErrorException $e){

        }catch (\ErrorException $e){

        }

        return true;
    }
}
