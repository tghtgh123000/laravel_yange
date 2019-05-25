<?php

namespace App\Libs\Sms;

class XycSms implements SmsInterface
{
    public function setOpt($arr)
    {
        // TODO: Implement setOpt() method.
    }

    public function sendVerifyCode($phone, $code)
    {
        // TODO: Implement sendVerifyCode() method.
        $config['api_yzm'] = 'http://113.108.68.228:8001/sendSMS.action';

        $api = $config['api_yzm'];
        $params = [
            'enterpriseID' => env('SMS_XYC_enterpriseID'),
            'loginName' => env('SMS_XYC_loginName'),
            'password' => md5(env('SMS_XYC_password')),
            'content' => str_replace('{{code}}' , $code , '【颜格视觉】您好您的验证码是{{code}},发送时间'
                . date('H:i:s')),
            'mobiles' => $phone,
        ];

        $client = new \GuzzleHttp\Client();

        $res = $client->request('POST' , $api , [
            'connect_timeout' => 3, //配置
            'verify' => false,
            'form_params' => $params,
        ]);

        $content = $res->getBody()->getContents();
        $xml = simplexml_load_string($content);
        $arr = json_decode(json_encode($xml) , true);
        $ret = $arr['Result'] === '0' ? true : false;

        \Log::debug('sms response: ' . json_encode($xml));
        \Log::debug('sms ret: ' . ($ret - 0));

        return $ret;
    }
}