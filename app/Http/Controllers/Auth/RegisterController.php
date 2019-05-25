<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\SmsContract;
use App\Services\Sms\SmsService;
use App\Libs\Tools\ResultTool;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\ValidationException;
use League\Flysystem\Config;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers{

    }
/** @var smsService */
    protected $smsService;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        $this->smsService = App::make(SmsContract::class);
    }


    /**
     * @param array $data
     * @return \Illuminate\Validation\Validator
     * @throws ValidationException
     * @author 693566361@qq.com
     * @time 2019/5/5 17:41
     */
    protected function validator(array $data)
    {
        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($data, [
//            'name' => 'required|max:255',
//            'email' => 'required|email|max:255|unique:users',
            'phone' => 'required|string|size:11|unique:users',
            'password' => 'required|min:6|confirmed',
            'smscode' => 'required',
        ]);
        $res = $this->smsService->checkRegisterCode($data['phone'] , $data['smscode']);
        if(!ResultTool::chkRes($res)){
            $validator->errors()->add('smscode' , $res['msg']);
            throw new ValidationException($validator);
        }


        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
            'phone' => $data['phone'], //20190502
            'password' => bcrypt($data['password']),
        ]);
    }

}
