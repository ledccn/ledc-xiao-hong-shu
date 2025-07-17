<?php

namespace Ledc\XiaoHongShu\HttpClient;

use Ledc\XiaoHongShu\Parameters\AfterSale\AfterSaleList;
use Ledc\XiaoHongShu\Parameters\AfterSale\AuditReturns;

/**
 * 售后接口
 */
class AfterSaleClient
{
    use HasClient;

    /**
     * 获取售后列表（新）
     * @param AfterSaleList $parameter
     * @return array
     */
    public function listAfterSaleInfos(AfterSaleList $parameter): array
    {
        return $this->client->post('afterSale.listAfterSaleInfos', $parameter->jsonSerialize());
    }

    /**
     * 获取售后详情（新）
     * @param string $returnsId 售后单号
     * @param bool $needNegotiateRecord 是否需要协商记录
     * @param array $requestHeader 请求头
     * @return array
     */
    public function getAfterSaleInfo(string $returnsId, bool $needNegotiateRecord = true, array $requestHeader = []): array
    {
        return $this->client->post('afterSale.getAfterSaleInfo', [
            'returnsId' => $returnsId,
            'needNegotiateRecord' => $needNegotiateRecord,
            'requestHeader' => $requestHeader
        ]);
    }

    /**
     * 售后审核（新）
     * @param AuditReturns $parameter
     * @return array
     */
    public function auditReturns(AuditReturns $parameter): array
    {
        return $this->client->post('afterSale.auditReturns', $parameter->jsonSerialize());
    }

    /**
     * 售后确认收货（新）
     * @param string $returnsId 售后id
     * @param int $action 操作类型，1-确认收货；2-拒绝；3-延期
     * @param int $reason 拒绝时必填，需要通过afterSale.rejectReasons获取原因传参，非法参数将拦截请求
     * @param string $description 拒绝原因描述
     * @return array
     */
    public function confirmReceive(string $returnsId, int $action, int $reason, string $description = ''): array
    {
        return $this->client->post('afterSale.confirmReceive', [
            'returnsId' => $returnsId,
            'action' => $action,
            'reason' => $reason,
            'description' => $description
        ]);
    }

    /**
     * 售后换货确认收货并发货
     * @param string $returnsId 售后id
     * @param string $expressCompanyCode 物流公司编码
     * @param string $expressNo 物流单号
     * @return array
     */
    public function receiveAndShip(string $returnsId, string $expressCompanyCode, string $expressNo): array
    {
        return $this->client->post('afterSale.receiveAndShip', [
            'returnsId' => $returnsId,
            'expressCompanyCode' => $expressCompanyCode,
            'expressNo' => $expressNo
        ]);
    }

    /**
     * 获取售后拒绝原因
     * @param string $returnsId 售后id
     * @param int $rejectReasonType 拒绝原因类型 1-审核拒绝；2-收货拒绝
     * @return array
     */
    public function rejectReasons(string $returnsId, int $rejectReasonType): array
    {
        return $this->client->post('afterSale.rejectReasons', [
            'returnsId' => $returnsId,
            'rejectReasonType' => $rejectReasonType
        ]);
    }
}
