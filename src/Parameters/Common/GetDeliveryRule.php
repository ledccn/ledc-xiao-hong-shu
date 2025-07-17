<?php

namespace Ledc\XiaoHongShu\Parameters\Common;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 批量获取发货时间规则的接口参数
 */
class GetDeliveryRule extends Parameters
{
    /**
     * 仓库号，自营使用
     * @var string
     */
    public string $whcode = '';
    /**
     * 物流方案id
     * @var string
     */
    public string $logisticsPlanId;
    /**
     * 类目id
     * @var string
     */
    public string $categoryId;
    /**
     * 商品id
     * @var string
     */
    public string $itemId = '';

    /**
     * 必填参数
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['logisticsPlanId', 'categoryId'];
    }
}