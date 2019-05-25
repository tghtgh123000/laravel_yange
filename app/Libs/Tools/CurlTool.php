<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 18:15
 */
namespace App\Libs\Tools;

use GuzzleHttp\Client;

class CurlTool
{
    public static function get($url , $params = [] , $timeout = 3){
        $client = new Client();
        $rep = $client->request('GET' , $url , [
            'query' => $params,
            'verify' => false,
            'connect_timeout' => $timeout, //配置
        ]);
        return $rep->getBody()->getContents();
    }
}