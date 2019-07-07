<?php

namespace App\Http\Controllers\Yg;

use App\Contracts\SmsContract;
use App\Http\Controllers\Controller;
use App\Libs\Tools\ResultTool;
use App\Services\OAuthService;
use App\Services\Sms\SmsService;
use App\Services\UserService;
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
class OauthController extends Controller
{
    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/oauth/authorize",
     *     summary="OAuth认证",
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function authorize(OAuthService $OAuthService, Request $request)
    {
        return ResultTool::resOk($OAuthService->authorize($request->get('type')));
    }

    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/oauth/authorizeUser",
     *     summary="OAuth认证成功用户信息",
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function authorizeUser(OAuthService $OAuthService, Request $request)
    {
        $res = $OAuthService->getAuthorizeUser($request->get('type'), $request);

        return $res;
    }
}
