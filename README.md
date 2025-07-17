# 说明

小红书开放平台，自研商家SDK

## 安装

`composer require ledc/xiao-hong-shu`

## 使用说明

开箱即用，只需要传入一个配置，初始化一个实例即可：

```php
use Ledc\XiaoHongShu\Config;
use Ledc\XiaoHongShu\Merchant;

// 数据库或环境变量内的配置信息
$config = [
    'appKey' => '',
    'appSecret' => '',
    'version' => '2.0',
    'storeId' => '',
    'timeout' => 10,
    'enabled' => true,
];

$merchant = new Merchant(new Config($config));
```

在创建实例后，所有的方法都可以由IDE自动补全；例如：

```php
/** @var \Ledc\XiaoHongShu\Merchant $merchant */

// 获取小红书HTTP客户端（处理了签名逻辑）
$client = $merchant->getClient();

// 售后接口
$afterSaleClient = $merchant->getAfterSaleClient();

// 获取公共接口
$commonClient = $merchant->getCommonClient();

// 获取库存接口
$inventoryClient = $merchant->getInventoryClient();

// 获取素材接口
$materialClient = $merchant->getMaterialClient();

// 获取授权接口
$oauthClient = $merchant->getOauthClient();

// 获取订单接口
$orderClient = $merchant->getOrderClient();

// 获取商品接口
$productClient = $merchant->getProductClient();

// 更多...
```

## 官方文档

https://open.xiaohongshu.com/home

## 捐赠

![reward](reward.png)