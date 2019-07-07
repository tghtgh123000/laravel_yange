<?php
/**
 *
 */
namespace App\Services;

use App\Libs\Tools\ResultTool;
use App\Model\Yg\User;
use GuzzleHttp\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use League\OAuth2\Client\Provider\AbstractProvider;
use Oakhope\OAuth2\Client\Provider\WebProvider;
use spoonwep\OAuth2\Client\Provider\Qq;

class OAuthService
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * OAuth2 重定向URL
     *
     * @param $type
     * @return string
     */
    public function authorize($type)
    {
        $provider = $this->getProvider($type);

        $authorizationUrl = $provider->getAuthorizationUrl();
        Session::put('oauth2state', $provider->getState());

        return $authorizationUrl;
    }

    /**
     * @param $type
     * @return WebProvider|Qq
     */
    private function getProvider($type)
    {
        $provider = new WebProvider([
            'appid' => '{wechat-client-id}',
            'secret' => '{wechat-client-secret}',
            'redirect_uri' => 'https://example.com/callback-url'
        ]);

        $provider = new Qq([
            'appid' => '{wechat-client-id}',
            'secret' => '{wechat-client-secret}',
            'redirect_uri' => 'https://example.com/callback-url'
        ]);

        return $provider;
    }

    public function getAuthorizeUser($type, Request $request)
    {
        $code = $request->get('code');

        if (empty($code)
            || empty($request->get('state'))
            || ($request->get('state') !== rtrim(Session::get('oauth2state'), '#wechat_redirect'))
        ) {

            // Check given state against previously stored one to mitigate CSRF attack
            Session::remove('oauth2state');
            return ResultTool::resErr('非法请求');
        }

        $provider = $this->getProvider($type);
        try {

            // Try to get an access token using the authorization code grant.
            $accessToken = $provider->getAccessToken('authorization_code', array(
                'code' => $code,
            ));

            // We have an access token, which we may use in authenticated
            // requests against the service provider's API.
//            echo "token: ".$accessToken->getToken()."<br/>";
//            echo "refreshToken: ".$accessToken->getRefreshToken()."<br/>";
//            echo "Expires: ".$accessToken->getExpires()."<br/>";
//            echo ($accessToken->hasExpired() ? 'expired' : 'not expired')."<br/><br/>";

            // Using the access token, we may look up details about the
            // resource owner.
            $resourceOwner = $provider->getResourceOwner($accessToken);

            Session::put('oauth2_openid', "{$type}.{$provider->openid}");

            return ResultTool::resOk($resourceOwner);

        } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
            return ResultTool::resErr($e->getMessage());
        }
    }
}
