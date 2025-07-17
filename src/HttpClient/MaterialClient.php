<?php

namespace Ledc\XiaoHongShu\HttpClient;

/**
 * 素材中心接口
 */
class MaterialClient
{
    use HasClient;

    /**
     * 素材列表
     * @param array $params
     * @return array
     */
    public function queryMaterial(array $params): array
    {
        return $this->client->post('material.queryMaterial', $params);
    }

    /**
     * 上传素材
     * @param string $name 素材名
     * @param int $type 素材类型，IMAGE传0/VIDEO传1
     * @param string $materialContent 素材文件字节数组，使用读取照片或视频后的byte[]数组， 请求转json时byte[]数组通过base64编码转成String
     * @return array
     */
    public function uploadMaterial(string $name, int $type, string $materialContent): array
    {
        return $this->client->post('material.uploadMaterial', [
            'name' => $name,
            'type' => $type,
            'materialContent' => $materialContent
        ]);
    }

    /**
     * 修改素材
     * @param string $materialId 素材id
     * @param string $materialName 素材名
     * @return array
     */
    public function updateMaterial(string $materialId, string $materialName): array
    {
        return $this->client->post('material.getMaterial', [
            'materialId' => $materialId,
            'materialName' => $materialName
        ]);
    }

    /**
     * 删除素材
     * @param string $materialId 素材id
     * @return array
     */
    public function deleteMaterial(string $materialId): array
    {
        return $this->client->post('material.getMaterial', [
            'materialId' => $materialId
        ]);
    }
}
