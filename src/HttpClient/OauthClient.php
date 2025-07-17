<?php

namespace Ledc\XiaoHongShu\HttpClient;

/**
 * 授权接口
 * - code与accessToken的获取与刷新
 */
class OauthClient
{
    use HasClient;

    /**
     * 通过CODE获取AccessToken
     * - 1)accessToken有效期为7天，refreshToken有效时间为14天
     * - 2)accessToken未过期且剩余有效时间大于30分钟，使用refreshToken进行刷新后accessToken和refreshToken均不会刷新
     * - 3)accessToken未过期且剩余有效时间小于30分钟，使用refreshToken进行刷新后会得到新的accessToken和refreshToken，且旧accessToken有效期为5分钟
     * - 4)accessToken过期后使用refreshToken进行刷新后会得到新的accessToken和refreshToken
     * - 5)refreshToken过期后需要通过用户重新授权
     * - 6)获取accessToken和刷新accessToken的参数均通过body传输
     * - 7)后续所有业务接口的url和获取token的url保持一致
     * @param string $code
     * @return array
     */
    public function getAccessToken(string $code): array
    {
        $response = $this->client->request('oauth.getAccessToken', ['code' => $code], false);
        return $this->client->parseHttpResponse($response);
    }

    /**
     * 刷新AccessToken
     * @param string $refreshToken
     * @return array
     */
    public function refreshToken(string $refreshToken): array
    {
        $response = $this->client->request('oauth.refreshToken', ['refreshToken' => $refreshToken], false);
        return $this->client->parseHttpResponse($response);
    }
}
