<?php

namespace App\Http\Controllers\Yg;

use App\Http\Controllers\Controller;

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
}
