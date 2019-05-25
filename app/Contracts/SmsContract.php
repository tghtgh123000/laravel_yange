<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 16:33
 */
namespace App\Contracts;

interface SmsContract
{
    public function sendRegisterCode($phone);

    public function checkRegisterCode($phone , $code);
}