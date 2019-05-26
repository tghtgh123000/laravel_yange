<?php

namespace App\Http\Controllers\Yg;

use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * @SWG\POST(
     *     tags={"Order:订单"},
     *     path="/api/yg/order/getMyRecharges",
     *     summary="我的充值记录",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *              ),
     *              @SWG\Property(
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
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getMyRecharges()
    {

    }
}
