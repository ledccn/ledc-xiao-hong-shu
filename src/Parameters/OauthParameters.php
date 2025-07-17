<?php

namespace Ledc\XiaoHongShu\Parameters;

/**
 * 授权成功后的参数
 */
class OauthParameters extends Parameters
{
    /**
     * accessToken
     * @var string
     */
    public string $accessToken;
    /**
     * accessToken过期时间（毫秒时间戳）
     * @var int|string
     */
    public string $accessTokenExpiresAt;
    /**
     * refreshToken
     * @var string
     */
    public string $refreshToken;
    /**
     * refreshToken过期时间（毫秒时间戳）
     * @var int|string
     */
    public string $refreshTokenExpiresAt;
    /**
     * 卖家店铺ID
     * @var string
     */
    public string $sellerId;
    /**
     * 卖家店铺名称
     * @var string
     */
    public string $sellerName;

    /**
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['accessToken', 'accessTokenExpiresAt', 'refreshToken', 'refreshTokenExpiresAt', 'sellerId', 'sellerName'];
    }
}