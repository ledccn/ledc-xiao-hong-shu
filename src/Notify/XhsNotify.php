<?php

namespace Ledc\XiaoHongShu\Notify;

use InvalidArgumentException;

/**
 * 小红书推送回调通知报文
 */
class XhsNotify
{
    /**
     * 消息类型标签
     * @var string
     */
    protected string $msgTag;
    /**
     * 商家店铺Id
     * @var string
     */
    protected string $sellerId;
    /**
     * 消息内容
     * @var array
     */
    protected array $data;

    /**
     * 构造函数
     * @param string $msgTag
     * @param string $sellerId
     * @param string $data
     */
    public function __construct(string $msgTag, string $sellerId, string $data)
    {
        $this->msgTag = $msgTag;
        $this->sellerId = $sellerId;
        $decode = json_decode($data, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new InvalidArgumentException('Unable to parse JSON data: ' . json_last_error_msg());
        }
        $this->data = is_array($decode) ? $decode : [$decode];
    }

    /**
     * 获取消息标签
     * @return string
     */
    public function getMsgTag(): string
    {
        return $this->msgTag;
    }

    /**
     * 获取商户ID
     * @return string
     */
    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    /**
     * 获取数据
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
