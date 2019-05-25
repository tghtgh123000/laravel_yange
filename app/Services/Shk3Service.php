<?php

namespace App\Services;

use App\Fruit;
use App\Libs\Tools\CurlTool;
use function simplehtmldom_1_5\file_get_html;
use Sunra\PhpSimple\HtmlDomParser;

class Shk3Service
{
    /**
     * 获取历史开奖结果
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author 693566361@qq.com
     * @time 2019/5/8 1:03
     */
    public function getListDataFormUrl()
    {
        $url = 'https://www.caipiaoapi.com/hall/hallajax/getLotteryList';
        $params = [
            'count' => 50,
//            'date' => '20190507',
        ];
        return $this->getDataFromUrl($url, $params);
    }

    /**
     * 获取下期开奖信息
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author 693566361@qq.com
     * @time 2019/5/8 1:03
     */
    public function getInfoDataFromUrl()
    {
        $url = 'https://www.caipiaoapi.com/hall/hallajax/getLotteryInfo';
        return $this->getDataFromUrl($url);
    }

    /**
     * 从接口拉取数据
     * @param $url
     * @param array $params
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author 693566361@qq.com
     * @time 2019/5/8 1:04
     */
    protected function getDataFromUrl($url, $params = [])
    {
        \Log::info('Begin To Load Fruits Data');

        $info = $this->getHtmlInfo();

        $params = array_merge($params, [
            'lotKey' => 'shk3',
            'time'   => $info['ajaxTime'],
            'passwd' => $info['ajaxPasswd'],
        ]);

        $url = $url . '?' . http_build_query($params);
        $client = new \GuzzleHttp\Client();
        $rep = $client->request('GET', $url, [
            'verify'          => false,
            'connect_timeout' => 3, //配置
        ]);

        $content = $rep->getBody()->getContents();
        \Log::debug('url: ' . $url);
        if (empty($content)) {
            \Log::error('Load Data Failed !');
        } else {
            \Log::info('Load Data Success ^_^');
        }
        return json_decode($content, true);
    }

    /**
     * 保存下期信息
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author 693566361@qq.com
     * @time 2019/5/8 1:05
     */
    public function saveNextInfo()
    {
        $info = $this->getInfoDataFromUrl();
        if (!$info) return false;

        $detail = $info['result']['data'];
        $nextPeriodsId = $detail['drawIssue'];
        $resultTime = $detail['drawTime'];

        if (empty($nextPeriodsId)) return false;
        $fruit = Fruit::where(['periodsId' => $nextPeriodsId])->first();
        if (!$fruit) {
            $fruit = new Fruit();
            $fruit->periodsId = $nextPeriodsId;
            $fruit->resultTime = $resultTime;
            $ret = $fruit->save();
        }
//        var_dump($fruit);
    }

    /**
     * 更新历史信息
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @author 693566361@qq.com
     * @time 2019/5/8 1:05
     */
    public function saveOrUpdateList()
    {
        $list = $this->getListDataFormUrl()['result']['data'];

        $setResult = function (Fruit $fruit , $r){
            $fruit->statusCode = Fruit::STATUS_FINISH;
            $fruit->result = $r['thirdSeafood'];
            $fruit->content = $r['firstSeafood'] . $r['secondSeafood'] . $r['thirdSeafood'];
        };

        if ($list) {
            foreach ($list as $r) {
                $periodsId = $r['preDrawIssue'];
                $fruit = Fruit::where(['periodsId' => $periodsId])->first();
                if (!$fruit) {
                    \Log::info('Begin Upd Data');
                    $fruit = new Fruit;
                    $fruit->periodsId = $periodsId;
                    $fruit->resultTime = $r['preDrawTime'];
                    $setResult($fruit , $r);
                    $ret = $fruit->save();
                    \Log::debug('fruit save ret: ' . (int)$ret);
                }else if ($fruit->statusCode == Fruit::STATUS_INIT){
                    $setResult($fruit , $r);
                    $ret = $fruit->save();
                    //todo 开始开奖
                    \Log::info('Begin To Check Win');
                }
            }
        } else {
            return false;
        }
    }

    protected function getHtmlInfo()
    {
        $url = 'https://www.caipiaoapi.com/hall/hallk3/index/shk3';
        $html = HtmlDomParser::file_get_html($url);
        $info = [];
        $info['ajaxTime'] = $html->find('#ajax_time')[0]->getAttribute('value');
        $info['ajaxPasswd'] = $html->find('#ajax_passwd')[0]->getAttribute('value');
        return $info;
    }

    public function test()
    {
        $this->saveNextInfo();
    }
}