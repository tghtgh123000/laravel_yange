<?php

namespace App\Libs\Sms;

class ZywxSms implements SmsInterface
{
    public function setOpt($arr)
    {
        // TODO: Implement setOpt() method.
    }

    public function sendVerifyCode($phone, $code)
    {
        // TODO: Implement sendVerifyCode() method.
        $config['api_yzm'] = 'https://vip.veesing.com/smsApi/verifyCode'; //配置

        $api = $config['api_yzm'];
        $params = [
            'appId'      => '****', //配置
            'appKey'     => '**** ', //配置
            'phone'      => $phone,
            'templateId' => '***', //配置
            'variables'  => $code,
        ];

        $client = new \GuzzleHttp\Client();

        $res = $client->request('POST' , $api , [
            'connect_timeout' => 3, //配置
            'verify' => false,
            'form_params' => $params,
        ]);

        $content = $res->getBody()->getContents();
        $arr = json_decode($content , true);
        $ret = $arr['returnStatus'] == '1' ? true : false;

        \Log::debug('sms response: ' . $content);
        \Log::debug('sms ret: ' . ($ret - 0));

        return $ret;
    }
}