<?php

namespace Ledc\XiaoHongShu;

use Ledc\XiaoHongShu\HttpClient\AfterSaleClient;
use Ledc\XiaoHongShu\HttpClient\Client;
use Ledc\XiaoHongShu\HttpClient\CommonClient;
use Ledc\XiaoHongShu\HttpClient\InventoryClient;
use Ledc\XiaoHongShu\HttpClient\MaterialClient;
use Ledc\XiaoHongShu\HttpClient\OauthClient;
use Ledc\XiaoHongShu\HttpClient\OrderClient;
use Ledc\XiaoHongShu\HttpClient\ProductClient;

/**
 * 商家自研系统API
 */
class Merchant
{
    /**
     * Client对象
     * @var Client
     */
    protected Client $client;
    /**
     * 缓存的客户端对象实例
     * @var array
     */
    protected array $instances = [];

    /**
     * 构造函数
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->client = new Client($config);
    }

    /**
     * 获取配置对象
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->getClient()->getConfig();
    }

    /**
     * 获取Client对象
     * @return Client
     */
    public function getClient(): Client
    {
        return $this->client;
    }

    /**
     * 获取售后接口
     * @return AfterSaleClient
     */
    public function getAfterSaleClient(): AfterSaleClient
    {
        return $this->instances['afterSale'] ?? $this->instances['afterSale'] = new AfterSaleClient($this->client);
    }

    /**
     * 获取公共接口
     * @return CommonClient
     */
    public function getCommonClient(): CommonClient
    {
        return $this->instances['common'] ?? $this->instances['common'] = new CommonClient($this->client);
    }

    /**
     * 获取库存接口
     * @return InventoryClient
     */
    public function getInventoryClient(): InventoryClient
    {
        return $this->instances['inventory'] ?? $this->instances['inventory'] = new InventoryClient($this->client);
    }

    /**
     * 获取素材接口
     * @return MaterialClient
     */
    public function getMaterialClient(): MaterialClient
    {
        return $this->instances['material'] ?? $this->instances['material'] = new MaterialClient($this->client);
    }

    /**
     * 获取授权接口
     * @return OauthClient
     */
    public function getOauthClient(): OauthClient
    {
        return $this->instances['oauth'] ?? $this->instances['oauth'] = new OauthClient($this->client);
    }

    /**
     * 获取订单接口
     * @return OrderClient
     */
    public function getOrderClient(): OrderClient
    {
        return $this->instances['order'] ?? $this->instances['order'] = new OrderClient($this->client);
    }

    /**
     * 获取商品接口
     * @return ProductClient
     */
    public function getProductClient(): ProductClient
    {
        return $this->instances['product'] ?? $this->instances['product'] = new ProductClient($this->client);
    }
}
