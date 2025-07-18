<?php

namespace Ledc\XiaoHongShu\HttpClient;

use Ledc\XiaoHongShu\Parameters\Product\GetDetailSkuList;
use Ledc\XiaoHongShu\Parameters\Product\SearchItemList;

/**
 * 商品接口
 */
class ProductClient
{
    use HasClient;

    /**
     * 获取商品Sku详情
     * @param GetDetailSkuList $parameter
     * @return array
     */
    public function getDetailSkuList(GetDetailSkuList $parameter): array
    {
        return $this->client->post('product.getDetailSkuList', $parameter->toArray());
    }

    /**
     * 更新物流方案
     * @param string $skuId skuId
     * @param string $logisticsPlanId 物流方案ID
     * @return array
     */
    public function updateSkuLogisticsPlan(string $skuId, string $logisticsPlanId): array
    {
        return $this->client->post('product.updateSkuLogisticsPlan', [
            'skuId' => $skuId,
            'logisticsPlanId' => $logisticsPlanId
        ]);
    }

    /**
     * 商品SKU上下架
     * @param string $skuId SKU ID
     * @param bool $available 是否上架（商家上架意愿）
     * @return array
     */
    public function updateSkuAvailable(string $skuId, bool $available = true): array
    {
        return $this->client->post('product.updateSkuAvailable', [
            'skuId' => $skuId,
            'available' => $available
        ]);
    }

    /**
     * 更新ITEM V2
     * @param array $params
     * @return array
     */
    public function updateItemV2(array $params): array
    {
        return $this->client->post('product.updateItemV2', $params);
    }

    /**
     * 删除ITEM V2
     * @param array $itemIds
     * @return array
     */
    public function deleteItemV2(array $itemIds): array
    {
        return $this->client->post('product.deleteItemV2', [
            'itemIds' => array_filter($itemIds, fn($itemId) => !is_null($itemId) && $itemId !== '')
        ]);
    }

    /**
     * 更新SKU V2
     * @param array $params
     * @return array
     */
    public function updateSkuV2(array $params): array
    {
        return $this->client->post('product.updateSkuV2', $params);
    }

    /**
     * 删除SKU V2
     * @param array $skuIds
     * @return array
     */
    public function deleteSkuV2(array $skuIds): array
    {
        return $this->client->post('product.deleteSkuV2', [
            'skuIds' => array_filter($skuIds, fn($skuId) => !is_null($skuId) && $skuId !== '')
        ]);
    }

    /**
     * 查询Item列表
     * @param SearchItemList $parameter 查询参数
     * @param int $pageNo 页码
     * @param int $pageSize 每页数量
     * @return array
     */
    public function searchItemList(SearchItemList $parameter, int $pageNo = 1, int $pageSize = 20): array
    {
        return $this->client->post('product.searchItemList', [
            'pageNo' => $pageNo,
            'pageSize' => $pageSize,
            'parameter' => $parameter->jsonSerialize()
        ]);
    }

    /**
     * 获取ITEM详情
     * @param string $itemId 商品ID
     * @param int|null $pageNo 页码
     * @param int|null $pageSize 每页数量
     * @return array
     */
    public function getItemInfo(string $itemId, ?int $pageNo = 1, ?int $pageSize = 20): array
    {
        return $this->client->post('product.getItemInfo', [
            'itemId' => $itemId,
            'pageNo' => $pageNo,
            'pageSize' => $pageSize
        ]);
    }

    /**
     * 修改SKU价格
     * @param string $skuId skuId
     * @param array $price 价格信息，组合品才是list
     * @param string $originalPrice 市场价，单位为分
     * @return array
     */
    public function updateSkuPrice(string $skuId, array $price, string $originalPrice = ''): array
    {
        return $this->client->post('product.updateSkuPrice', [
            'skuId' => $skuId,
            'price' => $price,
            'originalPrice' => $originalPrice
        ]);
    }

    /**
     * 修改商品主图、主图视频
     * @param string $itemId 商品ID
     * @param array $materialUrls 素材url，图片全量覆盖、视频取第一个
     * @param int $materialType 素材类型，1：图片，2：视频
     * @return array
     */
    public function updateItemImage(string $itemId, array $materialUrls, int $materialType = 1): array
    {
        return $this->client->post('product.updateItemImage', [
            'itemId' => $itemId,
            'materialType' => $materialType,
            'materialUrls' => $materialUrls,
        ]);
    }

    /**
     * 创建商品Item+Sku（新）
     * @param array $data
     * @return array
     */
    public function createItemAndSku(array $data): array
    {
        return $this->client->postV2('product.createItemAndSku', $data);
    }

    /**
     * 更新商品Item+Sku（新）
     * @param array $data
     * @return array
     */
    public function updateItemAndSku(array $data): array
    {
        return $this->client->postV2('product.updateItemAndSku', $data);
    }
}
