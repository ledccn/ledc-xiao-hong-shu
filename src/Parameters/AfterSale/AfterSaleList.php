<?php

namespace Ledc\XiaoHongShu\Parameters\AfterSale;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 售后列表接口参数
 */
class AfterSaleList extends Parameters
{
    /**
     * 页码
     * @var int
     */
    public int $pageNo = 1;
    /**
     * 每页数量
     * @var int
     */
    public int $pageSize = 50;
    /**
     * 包裹号，包裹号和时间类型至少传一个
     * @var string
     */
    public string $orderId = '';
    /**
     * 售后状态列表
     * - 1-待审核 2-待用户寄回 3-待商家收货 4-已完成 5-已取消6-已关闭 9-商家审核拒绝 9001-商家收货拒绝12-换货待商家发货 13-换货待用户确认收货 14-平台介入中
     * @var array|int[]
     */
    public array $statuses = [];
    /**
     * 售后类型列表
     * - 1-退货 2-换货 4-已发货仅退款 5-未发货仅退款
     * @var array
     */
    public array $returnTypes = [];
    /**
     * 时间起点（毫秒，包含），选择时间类型后必传
     * @var string
     */
    public string $startTime;
    /**
     * 时间终点（毫秒，包含） 时间终点应当大于时间起点，选择时间类型后必传
     * @var string
     */
    public string $endTime;
    /**
     * 时间类型（包裹号和时间类型至少传一个）
     * - 1-创建时间，范围不大于24小时 2-更新时间，范围不大于30分钟
     * @var int|null
     */
    public ?int $timeType;

    /**
     * 获取必填参数
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['pageNo', 'pageSize'];
    }
}
