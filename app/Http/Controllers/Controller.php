<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /** @var Request */
    protected $request;

    protected $inputData;

    public function __construct()
    {
        $this->request = \App::make(Request::class);
        $input = $this->request->input();
        $this->inputData = $input['data'];
    }

    /**
     * json返回正确信息
     * @param null $data
     * @return array
     * @author 693566361@qq.com
     * @time 2019/5/3 22:24
     */
    protected function returnOK($data = null)
    {
        return $this->returnJson($data , 10000 , 'success');
    }

    /**
     * json返回错误信息
     * @param $msg
     * @param int $code
     * @param array $data
     * @return array
     * @author 693566361@qq.com
     * @time 2019/5/3 22:25
     */
    protected function returnErr($msg = '' , $code = 99999 , $data = [])
    {
        return $this->returnJson($data , $code , $msg);
    }

    /**
     * json返回resultTool的值
     * @param $res
     * @return array
     * @author 693566361@qq.com
     * @time 2019/5/4 19:34
     */
    protected function returnRes($res){
        return $this->returnJson($res['data'] , $res['code'] , $res['msg']);
    }

    /**
     * 返回json信息
     * @param $data
     * @param $code
     * @param $msg
     * @return array
     * @author 693566361@qq.com
     * @time 2019/5/3 22:25
     */
    private function returnJson($data, $code , $msg)
    {
        Log::info($code . '#' . $msg);
        return [
            'code'        => $code,
            'data'        => $data,
            'msg'         => $msg,
            '_serverTime' => date('YmdHis'),
        ];
    }
}
