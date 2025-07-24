<?php

namespace Ledc\XiaoHongShu\Enums;

/**
 * 小红书订单状态枚举
 * @date 2025年7月17日
 */
class OrderStatusEnums extends EnumsInterface
{
    /**
     * 全部
     */
    public const ALL = 0;
    /**
     * 已下单待付款
     */
    public const PENDING_PAYMENT = 1;
    /**
     * 已支付处理中
     */
    public const PROCESSING_PAYMENT = 2;
    /**
     * 清关中
     */
    public const CUSTOMS_CLEARANCE = 3;
    /**
     * 待发货
     */
    public const WAITING_FOR_SHIPMENT = 4;
    /**
     * 部分发货
     */
    public const PARTIALLY_SHIPPED = 5;
    /**
     * 待收货
     */
    public const WAITING_FOR_RECEIPT = 6;
    /**
     * 已完成
     */
    public const COMPLETED = 7;
    /**
     * 已关闭
     */
    public const CLOSED = 8;
    /**
     * 已取消
     */
    public const CANCELED = 9;
    /**
     * 换货申请中
     */
    public const EXCHANGE_REQUESTED = 10;

    /**
     * 枚举说明列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::ALL => '全部',
            self::PENDING_PAYMENT => '已下单待付款',
            self::PROCESSING_PAYMENT => '已支付处理中',
            self::CUSTOMS_CLEARANCE => '清关中',
            self::WAITING_FOR_SHIPMENT => '待发货',
            self::PARTIALLY_SHIPPED => '部分发货',
            self::WAITING_FOR_RECEIPT => '待收货',
            self::COMPLETED => '已完成',
            self::CLOSED => '已关闭',
            self::CANCELED => '已取消',
            self::EXCHANGE_REQUESTED => '换货申请中',
        ];
    }

    /**
     * 判断是否为可发货状态
     * @param int $value
     * @return bool
     */
    public static function canDelivery(int $value): bool
    {
        return in_array($value, [
            self::PROCESSING_PAYMENT,
            self::WAITING_FOR_SHIPMENT,
            self::PARTIALLY_SHIPPED,
        ], true);
    }
}
