<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 23:08
 */
namespace App\Libs;

use App\Services\TimeService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class RedisFrequencyLimit
{
    /** @var TimeService */
    protected $time;

    public function __construct()
    {
        $this->time = App::make(TimeService::class);
    }

    public function checkLimit($key , $times , $seconds)
    {
        $now = $this->time->getTime();
        $secondsAgo = $now - $seconds;
        $count = Redis::zcount($key , $secondsAgo . '0000' - 0 , $now . '9999' - 0);
        Log::debug('key: ' . $key . ' count: ' . $count . ' limitTimes: ' . $times);
        if($count >= $times)return false;

        //验证通过,记录一条
        $score = $now . mt_rand(1000 , 9999);
        $ret = Redis::zadd($key , $score , $score);
        if(!$ret){
            $msg = "redis key#$key add failed";
            Log::error($msg);
            throw new \ErrorException($msg);
        }
        if($ret){
            $ret = Redis::expire($key , $seconds);
        }
        return true;
    }
}