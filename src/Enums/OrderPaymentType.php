<?php

namespace Ledc\XiaoHongShu\Enums;

/**
 * 小红书订单支付方式枚举
 */
class OrderPaymentType extends EnumsInterface
{
    /**
     * 支付宝
     */
    public const ALIPAY = 1;
    /**
     * 微信
     */
    public const WECHAT = 2;
    /**
     * Apple内购
     */
    public const APPLE_IN_APP_PURCHASE = 3;
    /**
     * ApplePay
     */
    public const APPLE_PAY = 4;
    /**
     * 花呗分期
     */
    public const HUA_BEI_INSTALLMENT = 5;
    /**
     * 支付宝免密支付
     */
    public const ALIPAY_NO_PASSWORD = 7;
    /**
     * 云闪付
     */
    public const CUP_PAY = 8;
    /**
     * 其他
     */
    public const OTHER = -1;

    /**
     * 枚举说明列表
     * @return string[]
     */
    public static function cases(): array
    {
        return [
            self::ALIPAY => '支付宝',
            self::WECHAT => '微信',
            self::APPLE_IN_APP_PURCHASE => '苹果内购',
            self::APPLE_PAY => '苹果支付',
            self::HUA_BEI_INSTALLMENT => '花呗分期',
            self::ALIPAY_NO_PASSWORD => '无密码支付宝',
            self::CUP_PAY => 'cup支付',
            self::OTHER => '其他'
        ];
    }
}