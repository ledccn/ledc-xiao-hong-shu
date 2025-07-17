<?php

namespace Ledc\XiaoHongShu\HttpClient;

use Ledc\XiaoHongShu\Parameters\Common\GetDeliveryRule;

/**
 * 公共接口
 */
class CommonClient
{
    use HasClient;

    /**
     * 获取商品分类
     * @param string $categoryId 父级分类,如果该参数为空，则返回所有的一级分类
     * @return array
     */
    public function getCategories(string $categoryId = ''): array
    {
        return $this->client->post('common.getCategories', ['categoryId' => $categoryId]);
    }

    /**
     * 由末级分类获取规格（新）
     * @param string $categoryId
     * @return array
     */
    public function getVariations(string $categoryId): array
    {
        return $this->client->post('common.getVariations', ['categoryId' => $categoryId]);
    }

    /**
     * 由末级分类获取属性
     * @param string $categoryId
     * @return array
     */
    public function getAttributeLists(string $categoryId): array
    {
        return $this->client->post('common.getAttributeLists', ['categoryId' => $categoryId]);
    }

    /**
     * 由属性获取属性值
     * @param string $attributeId
     * @return array
     */
    public function getAttributeValues(string $attributeId): array
    {
        return $this->client->post('common.getAttributeValues', ['attributeId' => $attributeId]);
    }

    /**
     * 获取快递公司信息
     * @return array
     */
    public function getExpressCompanyList(): array
    {
        return $this->client->post('common.getExpressCompanyList');
    }

    /**
     * 获取物流方案列表
     * @return array
     */
    public function getLogisticsList(): array
    {
        return $this->client->post('common.getLogisticsList');
    }

    /**
     * 运费模版列表
     * @param int $pageIndex 页码
     * @param int $pageSize 每页数量
     * @return array
     */
    public function getCarriageTemplateList(int $pageIndex = 1, int $pageSize = 20): array
    {
        return $this->client->post('common.getCarriageTemplateList', [
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize
        ]);
    }

    /**
     * 运费模版详情
     * @param string $templateId 运费模版ID
     * @return array
     */
    public function getCarriageTemplate(string $templateId): array
    {
        return $this->client->post('common.getCarriageTemplate', [
            'templateId' => $templateId
        ]);
    }

    /**
     * 获取品牌信息
     * @param string $categoryId 末级类目id
     * @param string $keyword 品牌关键字
     * @param int $pageNo 页码
     * @param int $pageSize 每页数量
     * @return array
     */
    public function brandSearch(string $categoryId, string $keyword, int $pageNo = 1, int $pageSize = 10): array
    {
        return $this->client->post('common.brandSearch', [
            'categoryId' => $categoryId,
            'keyword' => $keyword,
            'pageNo' => $pageNo,
            'pageSize' => $pageSize
        ]);
    }

    /**
     * 获取物流模式列表
     * @return array
     */
    public function logisticsMode(): array
    {
        return $this->client->post('common.logisticsMode');
    }

    /**
     * 商品标题类目预测
     * @param string $spuName 商品SPU名称
     * @param int $topK 返回最符合的类目数量，默认为1
     * @param string $externalCategoryName 可能的类目名称
     * @return array
     */
    public function categoryMatch(string $spuName, int $topK = 1, string $externalCategoryName = ''): array
    {
        return $this->client->post('common.categoryMatch', [
            'spuName' => $spuName,
            'topK' => $topK,
            'externalCategoryName' => $externalCategoryName
        ]);
    }

    /**
     * 批量获取发货时间规则
     * @param GetDeliveryRule $parameter
     * @return array
     */
    public function getDeliveryRule(GetDeliveryRule $parameter): array
    {
        return $this->client->post('common.getDeliveryRule', [
            'getDeliveryRuleRequests' => [
                $parameter->toArray()
            ]
        ]);
    }

    /**
     * 获取商家地址库
     * @param int $pageIndex
     * @param int $pageSize
     * @return array
     */
    public function getAddressRecord(int $pageIndex = 1, int $pageSize = 20): array
    {
        return $this->client->post('common.getAddressRecord', [
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize
        ]);
    }

    /**
     * 获取预测类目（新）
     * @param string $name 商品名称
     * @param string[] $imageUrls 商品图片
     * @param int $scene 1:智能推断，2:智能发布，3:类目判定，默认为1
     * @return array
     */
    public function categoryMatchV2(string $name, array $imageUrls, int $scene = 1): array
    {
        return $this->client->postV2('common.categoryMatchV2', [
            'name' => $name,
            'imageUrls' => $imageUrls,
            'scene' => $scene
        ]);
    }

    /**
     * 判断文本中是否含有违禁词
     * @param string $text
     * @return array
     */
    public function checkForbiddenKeyword(string $text): array
    {
        return $this->client->postV2('common.checkForbiddenKeyword', [
            'text' => $text
        ]);
    }
}
