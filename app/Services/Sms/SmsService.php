<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 0:24
 */
namespace App\Services\Sms;

use App\Contracts\SmsContract;
use App\Libs\RedisFrequencyLimit;
use App\Libs\Tools\ResultTool;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Psy\Exception\ErrorException;

class SmsService implements SmsContract
{
    //短信配置
    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
        if(!isset($config['debug']))throwException(new ErrorException('Sms Debug Undefined'));
    }

    /**
     * 发送验证码
     * @param $phone
     * @return array
     * @throws ErrorException
     * @throws \ErrorException
     * @author 693566361@qq.com
     * @time 2019/5/4 18:39
     */
    public function sendRegisterCode($phone)
    {
        if(empty($phone))throw new ErrorException('phone miss');
        $config = $this->config;
        $code = $config['debug'] ? '111111' : $this->getCode();
        $key = $this->getRegisterCodeKey($phone);
        \Log::debug('key: ' . $key);
        //是否已经存在
        if(Redis::exists($key)){
            $second = Redis::ttl($key);
            return ResultTool::resErr('验证码已经发送' , [
                'second' => $second,
            ] , 10004);
        }
        //-若不存在,开始发送
        //--发送次数检查
        /** @var RedisFrequencyLimit $limit */
        $limit = App::make(RedisFrequencyLimit::class);
        $tmp = explode('/' , $config['frequencyLimit']);
        $limitTimes = $tmp[0];
        $limitSeconds = $tmp[1] * 60;
        $ip = App::make('request')->getClientIp();
        $ret = $limit->checkLimit(config('rediskey.rfl_smscode_pre') .':' . $ip , $limitTimes , $limitSeconds);
        if(!$ret)return ResultTool::resErr('发送超过限制' , null , 10009);

        $ret = $limit->checkLimit(config('rediskey.rfl_smscode_pre') .':' . $phone , $limitTimes , $limitSeconds);
        if(!$ret)return ResultTool::resErr('发送超过限制' , null , 10009);

        $ret = $this->send($phone , $this->getRegisterContent($code));
        if(!$ret)return ResultTool::resErr('验证码发送失败');
        //记录redis
        $second = $config['smscode_seconds'];
        $ret = Redis::setex($key , $second , $code);
        if(!$ret)return ResultTool::resErr('系统错误#redis error');
        return ResultTool::resOk([
            'second' => $second
        ]);
    }

    public function checkRegisterCode($phone , $code)
    {
        $key = $this->getRegisterCodeKey($phone);
        if(!Redis::exists($key)){
            return ResultTool::resErr('请先获取验证码' , 10001);
        }

        if(!empty($code) && $code == Redis::get($key)){
            return ResultTool::resOk();
        }else{
            return ResultTool::resErr('验证码错误' , 10002);
        }
    }

    protected function getRegisterCodeKey($phone){
        return config('rediskey.smscode_register_pre') . ':' . $phone;
    }

    protected function getCode(){
        return mt_rand(100000 , 999999);
    }

    protected function send($phone , $content){
        return true;
    }

    protected function getRegisterContent($code){
        return '';
    }
}