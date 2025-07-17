<?php

namespace Ledc\XiaoHongShu\Parameters\Order;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 开票列表查询的接口参数
 */
class GetInvoiceList extends Parameters
{
    /**
     * 开票状态，1:待开票；6：已开票；10：待作废
     * @var int
     */
    public int $invoiceStatus;
    /**
     * 来源单号
     * @var string
     */
    public string $refNo = '';
    /**
     * 申请时间（开始时间）ms
     * @var int|null
     */
    public ?int $startDateLong = null;
    /**
     * 申请时间（结束时间）ms
     * @var int|null
     */
    public ?int $endDateLong = null;
    /**
     * 页码
     * @var int
     */
    public int $pageNum = 1;
    /**
     * 每页数量
     * @var int
     */
    public int $pageSize = 50;
    /**
     * 排序枚举
     * - 升序or降序，1:升序；2：降序
     * @var int
     */
    public int $sortEnum = 1;
    /**
     * 发票抬头类型，1：个人；2：企业
     * @var int|null
     */
    public ?int $titleType;

    /**
     * 获取必填的key
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['invoiceStatus', 'sortEnum'];
    }
}
