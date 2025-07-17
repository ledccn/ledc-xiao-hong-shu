<?php

namespace Ledc\XiaoHongShu\Parameters\Order;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 订单发货的请求参数
 */
class OrderDeliver extends Parameters
{
    /**
     * 订单号
     * @var string
     */
    public string $orderId;
    /**
     * 快递单号（如使用的是无物流发货，expressNo为发货内容）
     * @var string
     */
    public string $expressNo;
    /**
     * 快递公司编码（如使用无物流发货，expressCompanyCode为selfdelivery）
     * @var string
     */
    public string $expressCompanyCode = 'selfdelivery';
    /**
     * 快递公司名称(如传入，则以传入为准，如未传入，则根据expressCompanyCode进行匹配)
     * @var string
     */
    public string $expressCompanyName;
    /**
     * 发货时间 不传默认当前时间（ms）
     * @var int|null
     */
    public ?int $deliveringTime = null;
    /**
     * 是否拆包发货 true 拆包发货 false正常发货
     * @var bool
     */
    public bool $unpack = false;
    /**
     * 拆包发货时 必填
     * @var array|string[]
     */
    public array $skuIdList = [];
    /**
     * 退货地址id 非必填
     * @var string
     */
    public string $returnAddressId = '';
    /**
     * 国补订单序列号等信息 非必填，仅部分类目国补订单需要
     * @var array
     */
    public array $skuIdentifyCodeInfo = [];

    /**
     * 必填参数
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['orderId', 'expressNo', 'expressCompanyCode', 'expressCompanyName'];
    }
}