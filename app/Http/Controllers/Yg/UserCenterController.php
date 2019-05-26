<?php

namespace App\Http\Controllers\Yg;

use App\Http\Controllers\Controller;

class UserCenterController extends Controller
{

    /**
     * @SWG\POST(
     *     tags={"UserCenter:用户中心"},
     *     path="/api/yg/userCenter/getInfo",
     *     summary="用户信息",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
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
    public function getInfo(){

    }

    /**
     * @SWG\PUT(
     *     tags={"UserCenter:用户中心"},
     *     path="/api/yg/userCenter/updateInfo",
     *     summary="编辑用户信息",
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
     *                      property="nickname",
     *                      type="string",
     *                      description="昵称",
     *                  ),
     *                  @SWG\Property(
     *                      property="icon",
     *                      type="string",
     *                      description="头像",
     *                  ),
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function updateInfo(){

    }
    /**
     * @SWG\PUT(
     *     tags={"UserCenter:用户中心"},
     *     path="/api/yg/userCenter/updatePhone",
     *     summary="更换手机号",
     *     description="step-步骤: ONE-第一步 TWO-第二步",
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
     *                      property="step",
     *                      type="string",
     *                      description="步骤",
     *                  ),
     *                  @SWG\Property(
     *                      property="phone",
     *                      type="string",
     *                      description="手机号",
     *                  ),
     *                  @SWG\Property(
     *                      property="smscode",
     *                      type="string",
     *                      description="验证码",
     *                  ),
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function updatePhone(){
        //todo 第一步 检查旧手机号
        //todo 第二步 检查新手机号 更换手机号
    }
    /**
     * @SWG\PUT(
     *     tags={"UserCenter:用户中心"},
     *     path="/api/yg/userCenter/changePwd",
     *     summary="修改密码",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *                  @SWG\Property(
     *                      property="oldPwd",
     *                      type="string",
     *                      description="",
     *                  ),
     *                  @SWG\Property(
     *                      property="newPwd",
     *                      type="string",
     *                      description="",
     *                  ),
     *              )
     *          )
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function changePwd(){

    }
    /**
     * @SWG\POST(
     *     tags={"UserCenter:用户中心"},
     *     path="/api/yg/userCenter/getMsg",
     *     summary="获取站内消息",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
     *                  @SWG\Property(
     *                      property="type",
     *                      type="string",
     *                      description="消息类型: NOTICE-公告 MAIL-站内信",
     *                  ),
     *
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
    public function getMsg(){

    }

    /**
     * @SWG\POST(
     *     tags={"UserCenter:用户中心"},
     *     path="/api/yg/userCenter/getMyFollows",
     *     summary="获取我的关注",
     *     description="",
     *     @SWG\Parameter(
     *          name="data",
     *          in="body",
     *          required="true",
     *          @SWG\Schema(
     *              name="data",
     *              @SWG\Property(
     *                  property="data",
     *                  type="object",
     *
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
    public function getMyFollows(){

    }
}
