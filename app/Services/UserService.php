<?php
/**
 *
 */
namespace App\Services;

use App\Libs\Tools\ResultTool;
use App\Model\Yg\User;
use App\Model\Yg\UserOauth;
use App\Services\Sms\SmsService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserService
{
    public function getByPhone($phone)
    {
        return User::where('phone', $phone)->first();
    }

    public function addByPhone($phone, $password)
    {
        $user = new User();
        $user->setAttribute('phone', $phone);
        $user->setAttribute('password', password_hash($password, PASSWORD_DEFAULT));

        return $user->save();
    }

    public function checkPassword($phone, Request $request)
    {
        $user = $this->getByPhone($phone);
        if (empty($user) || $user['password'] != password_hash($request->get('password'), PASSWORD_DEFAULT)) {
            return ResultTool::resErr('手机号或密码不正确');
        }

        $this->oauthBind($user['id']);

        return ResultTool::resOk($user['id']);
    }

    private function oauthBind($userId)
    {
        $openid = Session::get('oauth2_openid');
        if ($openid) {
            list($type, $openid) = explode('.', $openid);
            $typeMap = array(
                'wechat' => 2,
                'qq' => 1
            );
            $oauth = new UserOauth();
            $oauth['user_id'] = $userId;
            $oauth['oauth_type'] = $typeMap[$type];
            $oauth['oauth_id_crc32'] = sprintf("%u", crc32($openid));
            $oauth['oauth_id'] = $openid;
            $oauth->save();
        }
    }

    public function checkSmsCode($phone, SmsService $smsService, Request $request)
    {
        $res = $smsService->checkRegisterCode($phone, $request->get('smscode'));
        if ($res['code'] != ResultTool::CODE_SUCCESS) {
            return $res;
        }

        $userId = 0;

        $user = $this->getByPhone($phone);
        if ($user) {
            $userId = $user['id'];
        }

        return ResultTool::resOk($userId);
    }
}
