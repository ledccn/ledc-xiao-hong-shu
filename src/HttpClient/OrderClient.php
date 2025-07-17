<?php

namespace Ledc\XiaoHongShu\HttpClient;

use InvalidArgumentException;
use Ledc\XiaoHongShu\Parameters\Order\GetInvoiceList;
use Ledc\XiaoHongShu\Parameters\Order\GetOrderList;
use Ledc\XiaoHongShu\Parameters\Order\ModifyOrderExpressInfo;
use Ledc\XiaoHongShu\Parameters\Order\OrderDeliver;

/**
 * 订单接口
 */
class OrderClient
{
    use HasClient;

    /**
     * APP用户标识
     */
    public const APP_USER_ID = 'ledc';

    /**
     * 订单列表
     * @param GetOrderList $parameter
     * @return array
     */
    public function getOrderList(GetOrderList $parameter): array
    {
        return $this->client->post('order.getOrderList', $parameter->jsonSerialize());
    }

    /**
     * 订单详情
     * @param string $orderId 订单号
     * @return array
     */
    public function getOrderDetail(string $orderId): array
    {
        return $this->client->post('order.getOrderDetail', ['orderId' => $orderId]);
    }

    /**
     * 获取收货人信息
     * @param array $receiverQueries 收件人详情查询列表，请务必在发货前调用一次避免用户修改导致不一致
     * @param bool $isReturn 是否是换货单
     * @return array
     */
    public function getOrderReceiverInfo(array $receiverQueries, bool $isReturn = false): array
    {
        array_map(function ($receiverQuery) {
            if (empty($receiverQuery['orderId'])) {
                throw new InvalidArgumentException('订单号不能为空');
            }
            if (empty($receiverQuery['openAddressId'])) {
                throw new InvalidArgumentException('收件人信息标识不能为空');
            }
        }, $receiverQueries);

        return $this->client->post('order.getOrderReceiverInfo', ['receiverQueries' => $receiverQueries, 'isReturn' => $isReturn]);
    }

    /**
     * 修改订单备注
     * @param string $orderId 订单号
     * @param string $sellerMarkNote 商家备注内容
     * @param string $operator 商家操作人名称
     * @param int $sellerMarkPriority 商家标记优先级，ark订单列表展示旗子颜色 1灰旗 2红旗 3黄旗 4绿旗 5蓝旗 6紫旗
     * @return array
     */
    public function modifySellerMarkInfo(string $orderId, string $sellerMarkNote, string $operator, int $sellerMarkPriority): array
    {
        return $this->client->post('order.modifySellerMarkInfo', [
            'orderId' => $orderId,
            'sellerMarkNote' => $sellerMarkNote,
            'operator' => $operator,
            'sellerMarkPriority' => $sellerMarkPriority
        ]);
    }

    /**
     * 订单发货
     * @param OrderDeliver $parameter
     * @return array
     */
    public function orderDeliver(OrderDeliver $parameter): array
    {
        return $this->client->post('order.orderDeliver', $parameter->jsonSerialize());
    }

    /**
     * 修改快递单号
     * @param ModifyOrderExpressInfo $parameter
     * @return array
     */
    public function modifyOrderExpressInfo(ModifyOrderExpressInfo $parameter): array
    {
        return $this->client->post('order.modifyOrderExpressInfo', $parameter->jsonSerialize());
    }

    /**
     * 订单物流轨迹
     * @param string $orderId 订单号
     * @return array
     */
    public function getOrderTracking(string $orderId): array
    {
        return $this->client->post('order.getOrderTracking', ['orderId' => $orderId]);
    }

    /**
     * 海关申报信息
     * @param string $orderId 订单号
     * @return array
     */
    public function getOrderDeclareInfo(string $orderId): array
    {
        return $this->client->post('order.getOrderDeclareInfo', ['orderId' => $orderId]);
    }

    /**
     * 批量上传序列号
     * @param array $orderSkuIdentifyCodeInfoList 订单商品信息列表
     * @return array
     */
    public function batchBindSkuIdentifyInfo(array $orderSkuIdentifyCodeInfoList): array
    {
        return $this->client->post('order.batchBindSkuIdentifyInfo', ['orderSkuIdentifyCodeInfoList' => $orderSkuIdentifyCodeInfoList]);
    }

    /**
     * 跨境清关支持口岸
     * @return array
     */
    public function getSupportedPortList(): array
    {
        return $this->client->post('order.getSupportedPortList');
    }

    /**
     * 跨境重推支付单
     * @param string $orderId 订单号
     * @param string $customsType 海关类型{总署海关取值:zongshu/地方海关取值：local}
     * @return array
     */
    public function resendBondedPaymentRecord(string $orderId, string $customsType): array
    {
        return $this->client->post('order.resendBondedPaymentRecord', [
            'orderId' => $orderId,
            'customsType' => $customsType
        ]);
    }

    /**
     * 跨境商品备案信息同步
     * @param array $params
     * @return array
     */
    public function syncItemCustomsInfo(array $params): array
    {
        return $this->client->post('order.syncItemCustomsInfo', $params);
    }

    /**
     * 跨境商品备案信息查询
     * @param string $barcode 商品条形码
     * @return array
     */
    public function getCustomsInfo(string $barcode): array
    {
        return $this->client->post('order.getCustomsInfo', ['barcode' => $barcode]);
    }

    /**
     * 小包批次创建
     * @param array $orders 转运订单信息
     * @param string $planInfoId 物流方案id
     * @return array
     */
    public function createTransferBatch(array $orders, string $planInfoId): array
    {
        return $this->client->post('order.createTransferBatch', [
            'orders' => $orders,
            'planInfoId' => $planInfoId
        ]);
    }

    /**
     * 开票列表查询
     * @param GetInvoiceList $parameter
     * @return array
     */
    public function getInvoiceList(GetInvoiceList $parameter): array
    {
        return $this->client->post('invoice.getInvoiceList', $parameter->jsonSerialize());
    }

    /**
     * 开票结果回传（正向蓝票开具）
     * @param array $params
     * @return array
     */
    public function confirmInvoice(array $params): array
    {
        return $this->client->post('invoice.confirmInvoice', $params);
    }

    /**
     * 发票冲红（逆向冲红）
     * @param array $params
     * @return array
     */
    public function reverseInvoice(array $params): array
    {
        return $this->client->post('invoice.reverseInvoice', $params);
    }

    /**
     * 批量解密
     * @param array $baseInfos 加密数据列表，上限100条
     * @param string $actionType 操作类型1 - 单个查看订单明文，2 - 批量解密打单，3 - 批量解密后面向三方的数据下发，4 - 其他场景,解密接口必填
     * @param string $appUserId 旧逻辑字段无实际意义，由服务商自定义，非空即可
     * @return array
     */
    public function batchDecrypt(array $baseInfos, string $actionType, string $appUserId = self::APP_USER_ID): array
    {
        return $this->client->post('data.batchDecrypt', [
            'baseInfos' => $baseInfos,
            'actionType' => $actionType,
            'appUserId' => $appUserId,
        ]);
    }

    /**
     * 批量脱敏
     * @param array $baseInfos 加密数据列表，上限100条
     * @param string $actionType 操作类型1 - 单个查看订单明文，2 - 批量解密打单，3 - 批量解密后面向三方的数据下发，4 - 其他场景,解密接口必填
     * @param string $appUserId 旧逻辑字段无实际意义，由服务商自定义，非空即可
     * @return array
     */
    public function batchDesensitise(array $baseInfos, string $actionType, string $appUserId = self::APP_USER_ID): array
    {
        return $this->client->post('data.batchDesensitise', [
            'baseInfos' => $baseInfos,
            'actionType' => $actionType,
            'appUserId' => $appUserId,
        ]);
    }

    /**
     * 批量获取索引串
     * @param array $indexBaseInfoList 索引串查询列表
     * @return array
     */
    public function batchIndex(array $indexBaseInfoList): array
    {
        return $this->client->post('data.batchIndex', [
            'indexBaseInfoList' => $indexBaseInfoList,
        ]);
    }

    /**
     * 获取KOS员工数据
     * @param string $startDate 开始日期 yyyy-MM-dd
     * @param string $endDate 结束日期 yyyy-MM-dd
     * @param int $pageNo 页码
     * @param int $pageSize 每页数量
     * @return array
     */
    public function getKosData(string $startDate, string $endDate, int $pageNo = 1, int $pageSize = 50): array
    {
        return $this->client->post('businessdata.getKosData', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'pageNo' => $pageNo,
            'pageSize' => $pageSize,
        ]);
    }

    /**
     * 创建三方商品备案信息
     * @param array $params
     * @return array
     */
    public function createItemCustomsInfo(array $params): array
    {
        return $this->client->post('order.createItemCustomsInfo', $params);
    }
}
