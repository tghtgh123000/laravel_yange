<?php

namespace App\Http\Controllers\Yg;

use App\Http\Controllers\Controller;

class MaterialController extends Controller
{
    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/getMyCollections",
     *     summary="我的收藏",
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
     *                  @SWG\Property(
     *                      property="sort",
     *                      type="string",
     *                      description="排序: COLLECTTIME-收藏时间 PULISHTIME-发布时间 DOWNLOAD-下载量",
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
    public function getMyCollections(){

    }
    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/getMyDownloads",
     *     summary="我的下载",
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
     *                  @SWG\Property(
     *                      property="wd",
     *                      type="string",
     *                      description="搜索",
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
    public function getMyDownloads(){

    }
    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/getPackages",
     *     summary="获取套餐列表",
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
    public function getPackages(){

    }

    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/getCategorys",
     *     summary="获取分类列表",
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
    public function getCategorys(){

    }
    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/download",
     *     summary="下载素材",
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
    public function download(){

    }
    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/collect",
     *     summary="收藏素材",
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
    public function collect(){

    }
    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/getDetail",
     *     summary="获取素材详情",
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
    public function getDetail(){

    }
    /**
     * @SWG\POST(
     *     tags={"Material:素材"},
     *     path="/api/yg/material/getList",
     *     summary="获取素材列表",
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
     *          ),
     *
     *      ),
     *      @SWG\Response(
     *         response=200,
     *         description="成功"
     *      ),
     * )
     *
     */
    public function getList(){

    }
}
