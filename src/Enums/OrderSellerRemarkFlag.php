<?php

namespace Ledc\XiaoHongShu\Enums;

/**
 * 小红书订单卖家备注标记枚举
 */
class OrderSellerRemarkFlag extends EnumsInterface
{
    /**
     * 灰色标记
     */
    public const GRAY_FLAG = 1;
    /**
     * 红色标记
     */
    public const RED_FLAG = 2;
    /**
     * 黄色标记
     */
    public const YELLOW_FLAG = 3;
    /**
     * 绿色标记
     */
    public const GREEN_FLAG = 4;
    /**
     * 蓝色标记
     */
    public const BLUE_FLAG = 5;
    /**
     * 紫色标记
     */
    public const PURPLE_FLAG = 6;

    /**
     * 枚举说明列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::GRAY_FLAG => '灰旗',
            self::RED_FLAG => '红旗',
            self::YELLOW_FLAG => '黄旗',
            self::GREEN_FLAG => '绿旗',
            self::BLUE_FLAG => '蓝旗',
            self::PURPLE_FLAG => '紫旗'
        ];
    }
}
