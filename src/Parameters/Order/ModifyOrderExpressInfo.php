<?php

namespace Ledc\XiaoHongShu\Parameters\Order;

use Ledc\XiaoHongShu\Parameters\Parameters;

class ModifyOrderExpressInfo extends Parameters
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
     * 修改拆包订单快递单号必传
     * @var int|null
     */
    public ?int $deliveryOrderIndex = null;
    /**
     * 旧快递单号,非必填
     * - 优先级高于deliveryOrderIndex,只传oldExpressNo,会修改订单号下面所有快递单号为oldExpressNo的包裹(可能更新多个);
     * - oldExpressNo和deliveryOrderIndex同时传,只会修改一个包裹
     * @var string
     */
    public string $oldExpressNo = '';

    /**
     * 必填参数
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['orderId', 'expressNo', 'expressCompanyCode', 'expressCompanyName'];
    }
}