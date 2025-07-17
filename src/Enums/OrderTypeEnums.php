<?php

namespace Ledc\XiaoHongShu\Enums;

/**
 * 小红书订单类型枚举
 */
class OrderTypeEnums extends EnumsInterface
{
    /**
     * 全部
     */
    public const ALL = 0;
    /**
     * 现货订单
     */
    public const NORMAL = 1;
    /**
     * 定金预售
     */
    public const DEPOSIT_PRE_SALE = 2;
    /**
     * 全款预售(废弃)
     */
    public const OBSOLETE_FULL_PAYMENT_PRE_SALE = 3;
    /**
     * 全款预售(新)
     */
    public const NEW_FULL_PAYMENT_PRE_SALE = 4;
    /**
     * 换货补发
     */
    public const EXCHANGE_REISSUE = 5;

    /**
     * 枚举说明列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::ALL => '全部',
            self::NORMAL => '现货订单',
            self::DEPOSIT_PRE_SALE => '定金预售',
            self::OBSOLETE_FULL_PAYMENT_PRE_SALE => '全款预售(废弃)',
            self::NEW_FULL_PAYMENT_PRE_SALE => '全款预售(新)',
            self::EXCHANGE_REISSUE => '换货补发'
        ];
    }
}
