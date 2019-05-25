<?php
/**
 * Created by PhpStorm.
 * User: Hand
 * Date: 2019/5/3
 * Time: 17:45
 */
namespace App\Http\Controllers\User;

use App\Contracts\SmsContract;
use App\Http\Controllers\Controller;
use App\Services\Sms\SmsService;
use Illuminate\Support\Facades\Validator;


class SmscodeController extends Controller
{
    /** @var SmsService */
    protected $smsService;

    public function __construct()
    {
        $this->smsService = \App::make(SmsContract::class);
        return parent::__construct();
    }

    public function send()
    {
        if(empty($this->inputData))return $this->returnErr('参数错误');
        $validator = $this->validator($this->inputData);
        if($validator->fails()){
            $msg = $validator->errors()->first();
            return $this->returnErr($msg);
        }

        $phone = $this->inputData['phone'];
        $res = $this->smsService->sendRegisterCode($phone);
        return $this->returnRes($res);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'name' => 'required|max:255',
//            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|size:11'
        ]);
    }

}