<?php

namespace App\Http\Controllers\Yg;

use App\Http\Controllers\Controller;
use Beast\EasyGeetest\EasyGeetest;
use Illuminate\Http\Request;
use Session;

class PublicController extends Controller
{
    public function swagger(){
//        echo "<pre>";
//        echo 'update...' . PHP_EOL;
        system('sh ../swagger');
        return json_decode(file_get_contents('/coding.net/swagger-ui/docs/yange.json') , true);
    }
    /**
     * @SWG\POST(
     *     tags={"Public:公共"},
     *     path="/api/yg/public/getBanners",
     *     summary="获取Banner列表 ",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *              ),
     *
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getBanners(){

    }
    /**
     * @SWG\POST(
     *     tags={"Public:公共"},
     *     path="/api/yg/public/getTopics",
     *     summary="获取专题列表",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *              ),
     *
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getTopics(){

    }
    /**
     * @SWG\POST(
     *     tags={"Public:公共"},
     *     path="/api/yg/public/getArticles",
     *     summary="获取文章列表",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *              ),
     *     @SWG\Property(
     *                      property="pageInfo",
     *                      type="object",
     *                      description="",
     *                      @SWG\Property(
     *                          property="pageId",
     *                          type="string",
     *                          description="",
     *                      ),
     *                      @SWG\Property(
     *                          property="pageSize",
     *                          type="string",
     *                          description="",
     *                      ),
     *                  ),
     *
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getArticles(){

    }
    /**
     * @SWG\POST(
     *     tags={"Public:公共"},
     *     path="/api/yg/public/getArticle",
     *     summary="获取文章详情",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *              ),
     *
     *
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getArticle(){

    }
    /**
     * @SWG\POST(
     *     tags={"Public:公共"},
     *     path="/api/yg/public/getStat",
     *     summary="获取统计信息",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *              ),
     *
     *
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getStat(){

    }
    /**
     * @SWG\POST(
     *     tags={"Public:公共"},
     *     path="/api/yg/public/getFriendLinks",
     *     summary="获取友链列表",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *              ),
     *
     *
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getFriendLinks(){

    }
    /**
     * @SWG\Post(
     *     tags={"User:用户操作"},
     *     path="/api/yg/public/getProProcess",
     *     summary="滑动验证码预处理",
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
    public function getProProcess(Request $request)
    {
        $phone = $request->get('phone');

        $gtSdk = new EasyGeetest(array(
            'captcha_id' => config('geetest.id'),
            'private_key' => config('geetest.key')
        ));
        $data = array(
            "user_id" => $phone, # 网站用户id
            "client_type" => "web", #web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式
            "ip_address" => $request->getClientIp() # 请在此处传输用户请求验证时所携带的IP
        );
        $status = $gtSdk->proProcess($data, 1);
        Session::put('gtserver', $status);
        Session::put('user_id', $data['user_id']);
        $response = $gtSdk->getResponse();

        return $this->returnOK($response);
    }
}
