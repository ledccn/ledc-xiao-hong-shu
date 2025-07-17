<?php

namespace Ledc\XiaoHongShu\HttpClient;

/**
 * Client特性
 */
trait HasClient
{
    /**
     * @var Client
     */
    protected Client $client;

    /**
     * 构造函数
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * 获取Client对象
     * @return Client
     */
    final public function getClient(): Client
    {
        return $this->client;
    }
}
