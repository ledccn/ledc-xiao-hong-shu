<?php

namespace Ledc\XiaoHongShu\Parameters\Product;

use Ledc\XiaoHongShu\Parameters\Parameters;

/**
 * 获取商品详情接口参数
 */
class GetDetailSkuList extends Parameters
{
    /**
     * 商品编号，使用id查询其他条件可以不填
     * @var string
     */
    public string $id = '';
    /**
     * 商品创建时间开始时间，Unix-Time时间戳
     * @var int|null
     */
    public ?int $createTimeFrom = null;
    /**
     * 商品创建时间结束时间，Unix-Time时间戳
     * @var int|null
     */
    public ?int $createTimeTo = null;
    /**
     * 商品更新时间开始时间，Unix-Time时间戳
     * @var int|null
     */
    public ?int $updateTimeFrom = null;
    /**
     * 商品更新时间结束时间，Unix-Time时间戳
     * @var int|null
     */
    public ?int $updateTimeTo = null;
    /**
     * 是否在架上
     * @var bool|null
     */
    public ?bool $buyable = null;
    /**
     * 库存大于等于某数
     * @var int|null
     */
    public ?int $stockGte = null;
    /**
     * 库存小于等于某数
     * @var int|null
     */
    public ?int $stockLte = null;
    /**
     * 返回页码
     * - 默认 1，页码从 1 开始
     * - PS：当前采用分页返回，数量和页数会一起传，如果不传，则采用 默认值
     * @var int
     */
    public int $pageNo = 1;
    /**
     * 返回数量，默认50最大100
     * @var int
     */
    public int $pageSize = 50;
    /**
     * 商品条形码
     * @var string
     */
    public string $barcode = '';
    /**
     * 只返回单品类型的商品
     * @var bool|null
     */
    public ?bool $singlePackOnly = null;
    /**
     * 查询起始商品id，全店商品时间倒序
     * @var string
     */
    public string $lastId = '';
    /**
     * 不传返回全部，传true只返回渠道商品，传false只返回非渠道商品
     * @var bool|null
     */
    public ?bool $isChannel = null;

    /**
     * 获取必填参数
     * @return array
     */
    protected function getRequiredKeys(): array
    {
        return [];
    }
}