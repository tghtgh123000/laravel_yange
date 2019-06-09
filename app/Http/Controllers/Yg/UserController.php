<?php

namespace App\Http\Controllers\Yg;

use App\Http\Controllers\Controller;


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
    public function sendSmsCode()
    {
        //todo 是否滑动验证
        return $this->returnOK();
    }

    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/user/checkSlieCode",
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
    public function checkSlieCode()
    {
        return $this->returnOK();
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
    public function setPwd()
    {
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
    public function register()
    {

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
    public function login()
    {

        //todo 是否设置密码
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
    public function forgot()
    {

    }

}
