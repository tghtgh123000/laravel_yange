<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/4
 * Time: 0:24
 */
namespace App\Services;

class TimeService
{
    public function getTime(){
        return time();
    }

    public function getYmdHis(){
        return date('YmdHis' , $this->getTime());
    }

    public function getYmd(){
        return date('Ymd' , $this->getTime());
    }

}