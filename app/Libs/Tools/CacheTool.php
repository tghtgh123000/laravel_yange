<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 18:15
 */
namespace App\Libs\Tools;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheTool
{
    public static function getCacheData($key , $cb , $cache = true){
        if(!$cache)return $cb();
        $data = Cache::get($key);
        if($data === null){
            Log::warning('Cache Miss: ' . $key);
            $data = $cb();
        }
        return $data;
    }

    public static function setCacheData($key , $cb , $seconds = 60){
        return Cache::put($key , $cb() , $seconds / 60 );
    }

}