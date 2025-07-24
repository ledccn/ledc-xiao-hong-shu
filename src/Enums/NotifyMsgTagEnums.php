<?php

namespace Ledc\XiaoHongShu\Enums;

/**
 * 小红书消息订阅 - 消息标签枚举
 */
class NotifyMsgTagEnums
{
    /**
     * 【订单】订单状态变更
     * - 1.用户下单
     * - 2.用户支付后，订单触发风控
     * - 3.支付后，跨境商品清关
     * - 4.用户支付后，订单走完风控，等待操作
     * - 5.卖家对部分商品发货
     * - 6.卖家对全部商品发货
     * - 7.买家确认收货或系统自动确认收货，且母订单状态变为「已完成」
     * - 8.售后完成，订单关闭
     * - 示例：{"orderId":"P768291112062421411","packageId":"P768291112062421411","orderStatus":9,"updateTime":1752812659421,"packageStatus":9}
     */
    public const msg_fulfillment_status_change = 'msg_fulfillment_status_change';
    /**
     * 【订单】买家收货信息变更
     * - 1.收货信息被商家修改
     * - 2.收货信息被买家修改
     * - 3.收货信息被平台客服修改
     */
    public const msg_fulfillment_receiver_change = 'msg_fulfillment_receiver_change';
    /**
     * 【订单】卖家修改备注
     * - 1.卖家修改交易备注时触发
     * - 示例：{"sellerRemarkContent":"我是商家备注","orderId":"P768716729656421231","packageId":"P768716729656421231","updateTime":1753175101977,"sellerRemarkOperator":"admin"}
     */
    public const msg_fulfillment_seller_remark_change = 'msg_fulfillment_seller_remark_change';
    /**
     * 【订单】订单发货时效变更
     * - 1.商家创建报备单，向平台提交影响发货时效的申请
     * - 示例：{"orderId":"P768291112062421411","packageId":"P768291112062421411","promiseLastShipTime":1752911924000,"updateTime":1752812659636}
     */
    public const msg_fulfillment_delivery_time_change = 'msg_fulfillment_delivery_time_change';
    /**
     * 【订单】物流服务订阅状态变更
     */
    public const msg_logistic_service_subscribe_status_change = 'msg_logistic_service_subscribe_status_change';
    /**
     * 【售后】发起售后申请
     * - 1.订单未发货，申请仅退款
     * - 2.订单已发货，申请仅退款
     * - 3.订单已发货，申请退款退货
     * - 4.订单已发货，申请换货
     * - 示例：{"refundFee":0.1,"orderId":"P768291112062421411","packageId":"P768291112062421411","returnsId":"R6242141112658161","updateTime":1752812658321,"returnType":5,"requestFrom":1}
     */
    public const msg_after_sale_create = 'msg_after_sale_create';
    /**
     * 【售后】同意退货申请
     * - 1.卖家/售后助手/极速退款策略 同意退货申请
     * - 示例：{"refundFee":0.1,"orderId":"P768291112062421411","packageId":"P768291112062421411","returnsId":"R6242141112658161","updateTime":1752812659217,"returnType":5,"requestFrom":1}
     */
    public const msg_after_sale_audit_pass = 'msg_after_sale_audit_pass';
    /**
     * 【售后】卖家确认收货
     * - 1.卖家确认收货
     * - 示例：{"refundFee":0.1,"orderId":"P768291112062421411","packageId":"P768291112062421411","returnsId":"R6242141112658161","updateTime":1752812659477,"returnType":5,"requestFrom":1}
     */
    public const msg_after_sale_confirm_receive = 'msg_after_sale_confirm_receive';
    /**
     * 【售后】退款成功消息
     * - 1.所有退款都退款成功
     * - 示例：{"refundFee":0.1,"orderId":"P768291112062421411","packageId":"P768291112062421411","returnsId":"R6242141112658161","updateTime":1752813706261,"returnType":5,"requestFrom":1}
     */
    public const msg_after_sale_refund_finished = 'msg_after_sale_refund_finished';
    /**
     * 【商品】商品新建（新）
     * - 示例：{"itemId":"687a004a4485460001faf055","updateTime":1752825930000,"skuId":"687a004a4485460001faf055"}
     */
    public const msg_sku_create = 'msg_sku_create';
    /**
     * 【商品】商品上下架（新）
     * - 下架示例 {"buyable":false,"itemId":"6878ac2e02d7b000016adb40","updateTime":1752822931000,"skuId":"6878ac2e02d7b000016adb40"}
     * - 上架示例 {"buyable":true,"itemId":"6878ac2e02d7b000016adb40","updateTime":1752822943000,"skuId":"6878ac2e02d7b000016adb40"}
     */
    public const msg_sku_buyable = 'msg_sku_buyable';
}
