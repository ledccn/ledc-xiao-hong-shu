<?php

namespace Ledc\XiaoHongShu;

use Closure;
use InvalidArgumentException;
use JsonSerializable;

/**
 * 小红书配置类
 */
class Config implements JsonSerializable
{
    /**
     * 接口地址
     */
    public const API_URL = 'https://ark.xiaohongshu.com/ark/open_api/v3/common_controller';
    /**
     * 配置前缀
     */
    public const CONFIG_PREFIX = 'xhs_';
    /**
     * 必须的配置项
     */
    public const REQUIRE_KEYS = [
        'appKey',
        'appSecret',
        'version',
        'storeId',
        'timeout',
        'enabled',
    ];
    /**
     * 小红书开放平台AppKey
     * @var string
     */
    protected string $appKey;
    /**
     * 小红书开放平台AppSecret
     * @var string
     */
    protected string $appSecret;
    /**
     * 小红书开放平台接口版本
     * @var string
     */
    protected string $version = '2.0';
    /**
     * 店铺ID
     * @var string
     */
    protected string $storeId;
    /**
     * 小红书AccessToken
     * @var Closure|null
     */
    protected ?Closure $accessToken = null;
    /**
     * 请求超时时间
     * @var int
     */
    protected int $timeout = 10;
    /**
     * 是否调试模式
     * @var bool true:测试环境，false:生产环境
     */
    protected bool $debug = false;
    /**
     * 是否启用
     * @var bool
     */
    protected bool $enabled = false;

    /**
     * 构造函数
     * @param array $attributes
     */
    public function __construct(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * 获取AppKey
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * 获取AppSecret
     * @return string
     */
    public function getAppSecret(): string
    {
        return $this->appSecret;
    }

    /**
     * 获取接口版本
     * @return string
     */
    public function getVersion(): string
    {
        return $this->version;
    }

    /**
     * 获取店铺ID
     * @return string
     */
    public function getStoreId(): string
    {
        return $this->storeId;
    }

    /**
     * 设置AccessToken
     * @param Closure $accessToken
     * @return Config
     */
    public function setAccessToken(Closure $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    /**
     * 获取AccessToken
     * @return string
     */
    public function getAccessToken(): string
    {
        if (is_null($this->accessToken)) {
            throw new InvalidArgumentException('AccessToken的闭包为空');
        }
        return call_user_func($this->accessToken, $this);
    }

    /**
     * 获取请求超时
     * @return int
     */
    public function getTimeout(): int
    {
        return $this->timeout;
    }

    /**
     * 设置调试模式
     * @param bool $debug
     * @return Config
     */
    public function setDebug(bool $debug): self
    {
        $this->debug = $debug;
        return $this;
    }

    /**
     * 是否调试模式
     * @return bool
     */
    public function isDebug(): bool
    {
        return $this->debug;
    }

    /**
     * 是否启用
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->enabled;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        $data = get_object_vars($this);
        unset($data['accessToken']);
        return $data;
    }

    /**
     * 转数组
     * @return array
     */
    public function toArray(): array
    {
        return $this->jsonSerialize();
    }

    /**
     * 转字符串
     * @param int $options
     * @return string
     */
    public function toJson(int $options = 0): string
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * 转字符串
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * 获取签名字符串
     * @param string $method
     * @param int $timestamp
     * @param string $version
     * @return string
     */
    public function generateSignature(string $method, int $timestamp, string $version): string
    {
        // 将集合 M 内非空参数以字典序升序（忽略大小写）排列拼接成键值格式的字符串
        $original = $method . '?appId=' . $this->getAppKey() . '&timestamp=' . $timestamp . '&' . 'version=' . $version;

        //  将密钥拼接到尾部
        $original = $original . $this->getAppSecret();

        // 计算MD5，得到签名（32位小写）
        return md5($original);
    }

    /**
     * 获取Oauth缓存key
     * @return string
     */
    public function getCacheKeyOauth(): string
    {
        return 'xhs_oauth_' . $this->cacheSuffix();
    }

    /**
     * 获取AccessToken缓存key
     * @return string
     */
    public function getCacheKeyAccessToken(): string
    {
        return 'xhs_access_token_' . $this->cacheSuffix();
    }

    /**
     * 获取缓存后缀
     * @param int $length
     * @return string
     */
    protected function cacheSuffix(int $length = 10): string
    {
        $md5_hash = md5($this->getAppKey() . '_' . $this->getAppSecret());
        return substr($md5_hash, 0, $length);
    }
}
