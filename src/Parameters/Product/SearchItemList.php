<?php

namespace Ledc\XiaoHongShu\Parameters\Product;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 查询Item列表的接口参数
 */
class SearchItemList extends Parameters
{
    /**
     * 商品名称关键词
     * @var string
     */
    public string $keyword = '';
    /**
     * 一级品类
     * @var array
     */
    public array $topCategoryIds = [];
    /**
     * 二级品类
     * @var array
     */
    public array $lvl2CategoryIds = [];
    /**
     * 三级品类
     * @var array
     */
    public array $lvl3CategoryIds = [];
    /**
     * 四级品类
     * @var array
     */
    public array $lvl4CategoryIds = [];
    /**
     * 在架状态
     * @var bool|null
     */
    public ?bool $buyable = null;
    /**
     * 关键词：小红书编码/条形码/商品ID/SPUID/货号
     * @var array
     */
    public array $keywords = [];
    /**
     * 商品物流方案ID
     * @var array
     */
    public array $logisticsPlanIds = [];
    /**
     * 商品创建时间大于
     * @var int|null
     */
    public ?int $createTimeFrom = null;
    /**
     * 商品创建时间小于
     * @var int|null
     */
    public ?int $createTimeTo = null;
    /**
     * 查询起始itemId，全店item按照时间倒序
     * @var string
     */
    public string $lastId = '';

    /**
     * 获取必填字段
     * @return array
     */
    protected function getRequiredKeys(): array
    {
        return [];
    }
}