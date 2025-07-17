<?php

namespace Ledc\XiaoHongShu\Enums;

/**
 * 小红书订单售后状态枚举
 */
class OrderAfterSalesStatusEnums extends EnumsInterface
{
    /**
     * 无售后
     */
    public const NO_AFTER_SALES = 1;
    /**
     * 售后处理中
     */
    public const PROCESSING = 2;
    /**
     * 售后完成
     */
    public const COMPLETED = 3;
    /**
     * 售后拒绝
     */
    public const REJECTED = 4;
    /**
     * 售后关闭
     */
    public const CLOSED = 5;
    /**
     * 平台介入
     */
    public const PLATFORM_INTERVENTION = 6;
    /**
     * 售后取消
     */
    public const CANCELED = 7;

    /**
     * 枚举说明列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::NO_AFTER_SALES => '无售后',
            self::PROCESSING => '售后处理中',
            self::COMPLETED => '售后完成',
            self::REJECTED => '售后拒绝',
            self::CLOSED => '售后关闭',
            self::PLATFORM_INTERVENTION => '平台介入中',
            self::CANCELED => '售后取消'
        ];
    }
}
