<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 18:15
 */
namespace App\Libs\Tools;

use Psy\Exception\ErrorException;

class ResultTool
{
    const CODE_SUCCESS = 10000;
    /**
     * 返回正确信息
     * @param array $data
     * @return array
     * @author 693566361@qq.com
     * @time 2019/5/4 18:20
     */
    public static function resOk($data = []){
        return [
            'code' => self::CODE_SUCCESS,
            'data' => $data,
            'msg' => 'success',
        ];
    }

    /**
     * 返回错误信息
     * @param string $msg
     * @param int $code
     * @param array $data
     * @return array
     * @throws ErrorException
     * @author 693566361@qq.com
     * @time 2019/5/4 18:21
     */
    public static function resErr($msg = '' , $data = null , $code = 99999){
        if($code == self::CODE_SUCCESS)throw new ErrorException('ResultTool Code Error');
        $res = [
            'code' => $code,
            'msg' => $msg,
        ];
        if(!empty($data))$res['data'] = $data;
        return $res;
    }

    /**
     * 检查信息
     * @param $res
     * @return bool
     * @author 693566361@qq.com
     * @time 2019/5/4 18:21
     */
    public static function chkRes($res){
        if(isset($res['code']) && $res['code'] === self::CODE_SUCCESS){
            return true;
        }else{
            return false;
        }
    }
}