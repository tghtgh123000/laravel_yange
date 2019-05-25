<?php

namespace App\Libs\Sms;

interface SmsInterface
{
    public function sendVerifyCode($phone , $code);

    public function setOpt($arr);
}
