<?php

namespace App\Http\Controllers\Yg;

use App\Contracts\SmsContract;
use App\Http\Controllers\Controller;
use App\Libs\Tools\ResultTool;
use App\Services\Sms\SmsService;
use App\Services\UserService;
use Beast\EasyGeetest\EasyGeetest;
use Illuminate\Http\Request;
use Session;

/**
 * @SWG\Swagger(
 *    swagger="2.0",
 *
 *     host="192.168.1.100",
 *     basePath="/",
 *     @SWG\Info(
 *         version="0.0.1",
 *         title="颜格视觉 Api 文档",
 *         description="颜格视觉 Api 文档"
 *     )
 * )
 */
class UserController extends Controller
{
    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/user/sendSmsCode",
     *     summary="获取验证码 ",
     *     description="type-验证码类型: REGISTER-注册 LOGIN-登录 FORGOT-忘记密码 OLDPHONE-旧手机发送验证码 NEWPHONE-发送验证码",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  required={"phone"},
     *                  property="data",
     *                  type="object",
     *                  @SWG\Property(
     *                      property="phone",
     *                      type="string",
     *                      defaultValue="13205280001",
     *                  ),
     *                  @SWG\Property(
     *                      property="type",
     *                      type="string"
     *                  ),
     *              ),
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function sendSmsCode(SmsContract $smsService, UserService $userService, Request $request)
    {
        if (!Session::get('gt_checked')) {
            $this->returnErr('验证码错误');
        }
        $phone = $request->get('phone');
        $type = $request->get('type');

        if ($type == 'REGISTER' && $userService->getByPhone($phone)) {
            $this->returnErr('该手机号已注册');
        }

        $request->session()->put('user_phone', $phone);

        return $smsService->sendRegisterCode($phone);
    }

    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/user/checkSlideCode",
     *     summary="滑动验证码检测",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  required={"phone"},
     *                  property="data",
     *                  type="object",
     *                  @SWG\Property(
     *                      property="phone",
     *                      type="string"
     *                       ),
     *              ),
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function checkSlideCode(Request $request)
    {
        $gtSdk =  $gtSdk = new EasyGeetest(array(
            'captcha_id' => config('geetest.id'),
            'private_key' => config('geetest.key')
        ));
        $data = array(
            "user_id" => Session::get('user_id'), # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => $request->getClientIp() # 请在此处传输用户请求验证时所携带的IP
        );

        if (Session::get('gtserver') == 1) {   //服务器正常
            $result = $gtSdk->successValidate($_POST['geetest_challenge'], $_POST['geetest_validate'], $_POST['geetest_seccode'], $data);
            if ($result) {
                Session::put('gt_checked', true);
                return $this->returnOK();
            }
        }

        return $this->returnErr('验证失败');
    }

    /**
     * @SWG\PUT(
     *     tags={"User:用户操作"},
     *     path="/api/yg/user/setPwd",
     *
     *     summary="设置密码 (已登录没有密码/未登录忘记密码)",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *                  @SWG\Property(
     *                      property="password",
     *                      type="string"
     *                       ),
     *              ),
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function setPwd(UserService $userService, Request $request)
    {
        if (!$request->session()->get('phone_sms_success')) {
            return $this->returnErr('请验证短信码');
        }

        $userService->addByPhone($request->session()->get('user_phone'), $request->get('password'));

        return $this->returnOK();
    }

    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/user/register",
     *     summary="注册",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *                  @SWG\Property(
     *                      property="smscode",
     *                      description="手机验证码",
     *                      type="string"
     *                       ),
     *              ),
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function register(SmsContract $smsService, Request $request)
    {
        $response = $smsService->checkRegisterCode(Session::get('user_phone'), $request->get('smscode'));
        if ($response['code'] == ResultTool::CODE_SUCCESS) {
            $request->session()->put('phone_sms_success', 1);
        }

        return $response;
    }

    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/user/login",
     *     summary="登录 (密码/验证码)",
     *     description="type-登录方式: PWD-密码 SMS-验证码",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *                  @SWG\Property(
     *                      property="type",
     *                      type="string"
     *                  ),
     *                  @SWG\Property(
     *                      property="password",
     *                      type="string"
     *                  ),
     *                  @SWG\Property(
     *                      property="smscode",
     *                      type="string"
     *                  ),
     *              ),
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function login(SmsContract $smsService, UserService $userService, Request $request)
    {

        if ($request->get('type') == 'PWD') {
            //密码登录方式，从提交的数据中获取手机号
            $phone = $request->get('phone');

            return $userService->checkPassword($phone, $request);
        }
        $phone = Session::get('user_phone');

        return $userService->checkSmsCode($phone, $request);
    }

    /**
     * @SWG\PUT(
     *     tags={"User:用户操作"},
     *     path="/api/yg/user/forgot",
     *     summary="忘记密码 (不登录)",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *                  @SWG\Property(
     *                      property="smscode",
     *                      description="手机验证码",
     *                      type="string"
     *                       ),
     *              ),
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function forgot(SmsService $smsService, Request $request)
    {
        return $smsService->checkRegisterCode(Session::get('user_phone'), $request->get('smscode'));
    }

}
