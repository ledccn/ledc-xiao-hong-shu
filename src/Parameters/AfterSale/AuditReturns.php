<?php

namespace Ledc\XiaoHongShu\Parameters\AfterSale;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 售后审核接口参数
 */
class AuditReturns extends Parameters
{
    /**
     * 售后订单ID
     * @var string
     */
    public string $returnsId;
    /**
     * 操作类型
     * - 1：同意直接退款 (退货退款、换货不适用)；2：同意寄回(仅退款不适用)；3：拒绝;
     * @var int
     */
    public int $action;
    /**
     * 拒绝原因
     * - 需要通过afterSale.rejectReasons获取原因传参，非法参数将拦截请求
     * @var int|null
     */
    public ?int $reason = null;
    /**
     * 拒绝原因描述
     * - 当拒绝原因为“其他”时必填
     * @var string
     */
    public string $description = '';
    /**
     * 给用户留言
     * - 当操作类型为“同意寄回”时字段有效
     * @var string
     */
    public string $message = '';
    /**
     * 寄回地址信息, 同意寄回时必填
     * @var array
     */
    public array $receiverInfo = [];

    /**
     * 获取必填参数
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['returnsId', 'action'];
    }
}
