<?php

namespace Ledc\XiaoHongShu\Parameters\Order;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 获取订单列表的接口参数
 */
class GetOrderList extends Parameters
{
    /**
     * 时间范围起点
     * @var int
     */
    public int $startTime;
    /**
     * 时间范围终点
     * @var int
     */
    public int $endTime;
    /**
     * startTime/endTime对应的时间类型
     * - 1 创建时间 限制 end-start<=24h、
     * - 2 更新时间 限制 end-start<=30min 倒序拉取 最后一页到第一页
     * @var int
     */
    public int $timeType;
    /**
     * 订单类型
     * - 0/null 全部
     * - 1 现货 normal
     * - 2 定金预售
     * - 3 全款预售(废弃)
     * - 4 全款预售(新)
     * - 5 换货补发
     * @var int
     */
    public int $orderType = 0;
    /**
     * 订单状态
     * - 0全部 1已下单待付款 2已支付处理中 3清关中 4待发货 5部分发货 6待收货 7已完成 8已关闭 9已取消 10换货申请中
     * @var int
     */
    public int $orderStatus = 0;
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
     * 必填参数
     * @return string[]
     */
    protected function getRequiredKeys(): array
    {
        return ['startTime', 'endTime', 'timeType'];
    }
}