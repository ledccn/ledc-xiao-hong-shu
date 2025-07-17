<?php

namespace Ledc\XiaoHongShu\HttpClient;

/**
 * 库存接口
 */
class InventoryClient
{
    use HasClient;

    /**
     * 获取商品SKU库存
     * @param string $skuId 规格ID
     * @return array
     */
    public function getSkuStock(string $skuId): array
    {
        return $this->client->post('inventory.getSkuStock', ['skuId' => $skuId]);
    }

    /**
     * 同步商品SKU库存
     * @param string $skuId 规格ID（限定为未开启多仓区域库存的普通品）
     * @param int $qty qty是需要同步的sku总库存数，其总库存数包含了普通品本身库存+渠道品独立库存+活动独立库存+待支付订单占用库存。接口逻辑会用qty与现在sku的总库存数进行差值计算，去设置可售库存
     * @return array
     */
    public function syncSkuStock(string $skuId, int $qty): array
    {
        return $this->client->post('inventory.syncSkuStock', ['skuId' => $skuId, 'qty' => $qty]);
    }

    /**
     * 增减商品SKU库存
     * @param string $skuId 规格ID（限定为未开启多仓区域库存的普通品）
     * @param int $qty qty是需要增减的sku可售库存数，接口逻辑会将现在sku的可售库存数加上设置的qty，以操作可售库存的增减
     * @return array
     */
    public function incSkuStock(string $skuId, int $qty): array
    {
        return $this->client->post('inventory.incSkuStock', ['skuId' => $skuId, 'qty' => $qty]);
    }

    /**
     * 获取商品库存V2
     * @param string $skuId 规格ID
     * @param int|null $inventoryType 库存类型
     * @return array
     */
    public function getSkuStockV2(string $skuId, ?int $inventoryType = null): array
    {
        return $this->client->post('inventory.getSkuStockV2', ['skuId' => $skuId, 'inventoryType' => $inventoryType]);
    }

    /**
     * 同步库存V2
     * @param string $skuId 规格ID
     * @param array $qtyWithWhcode 多仓区域库存传需要修改的仓数据，"qtyWithWhcode": {"yunnan": 100, "zhejiang": 100}。非多仓区域库存使用默认仓，"qtyWithWhcode": {"CPartner": 100}
     * @return array
     */
    public function syncSkuStockV2(string $skuId, array $qtyWithWhcode): array
    {
        return $this->client->post('inventory.syncSkuStockV2', ['skuId' => $skuId, 'qtyWithWhcode' => $qtyWithWhcode]);
    }

    /**
     * 创建仓库
     * @param string $code 仓库编码，不可重复，创建后不可修改，只能是数字、字母和下划线，长度限制24
     * @param string $name 仓库名称，长度限制50
     * @param string $zoneCode 城镇/街道对应的行政地区编码，需要选到最末级地区编码
     * @param string $address 详细地址
     * @param string $contactName 联系人
     * @param string $contactTel 联系人电话
     * @return array
     */
    public function create(string $code, string $name, string $zoneCode, string $address, string $contactName = '', string $contactTel = ''): array
    {
        return $this->client->post('warehouse.create', [
            'code' => $code,
            'name' => $name,
            'zoneCode' => $zoneCode,
            'address' => $address,
            'contactName' => $contactName,
            'contactTel' => $contactTel,
        ]);
    }

    /**
     * 修改仓库
     * @param string $code 仓库编码
     * @param string $name 仓库名称，长度限制50
     * @param string $zoneCode 城镇/街道对应的行政地区编码，需要选到最末级地区编码
     * @param string $address 详细地址
     * @param string $contactName 联系人
     * @param string $contactTel 联系人电话
     * @return array
     */
    public function update(string $code, string $name, string $zoneCode, string $address, string $contactName = '', string $contactTel = ''): array
    {
        return $this->client->post('warehouse.update', [
            'code' => $code,
            'name' => $name,
            'zoneCode' => $zoneCode,
            'address' => $address,
            'contactName' => $contactName,
            'contactTel' => $contactTel,
        ]);
    }

    /**
     * 仓库列表
     * @param int $pageNo 页码
     * @param int $pageSize 每页数量
     * @param string $code 仓库编码
     * @param string $name 仓库名称
     * @return array
     */
    public function list(int $pageNo = 1, int $pageSize = 50, string $code = '', string $name = ''): array
    {
        return $this->client->post('warehouse.list', [
            'pageNo' => $pageNo,
            'pageSize' => $pageSize,
            'code' => $code,
            'name' => $name,
        ]);
    }

    /**
     * 仓库详情
     * @param string $code 仓库编码
     * @return array
     */
    public function info(string $code): array
    {
        return $this->client->post('warehouse.info', [
            'code' => $code,
        ]);
    }

    /**
     * 设置仓库覆盖地区
     * @param string $whCode 仓库编码
     * @param array $zoneCodeList 行政地区编码列表，只能是一级、二级或三级地区编码
     * @return array
     */
    public function setCoverage(string $whCode, array $zoneCodeList): array
    {
        return $this->client->post('warehouse.setCoverage', [
            'whCode' => $whCode,
            'zoneCodeList' => $zoneCodeList,
        ]);
    }

    /**
     * 设置仓库优先级
     * @param string $zoneCode 地区编码，只支持一级、二级或三级地区编码
     * @param array $warehousePriorityList 仓库优先级列表，优先级高的在前
     * @return array
     */
    public function setPriority(string $zoneCode, array $warehousePriorityList): array
    {
        return $this->client->post('warehouse.setPriority', [
            'zoneCode' => $zoneCode,
            'warehousePriorityList' => $warehousePriorityList,
        ]);
    }
}
