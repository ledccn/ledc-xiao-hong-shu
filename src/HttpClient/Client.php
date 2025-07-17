<?php

namespace Ledc\XiaoHongShu\HttpClient;

use Ledc\XiaoHongShu\Config;
use Ledc\XiaoHongShu\HttpResponse;
use RuntimeException;

/**
 * 小红书Client
 * @author david <367013672@qq.com>
 */
class Client
{
    /**
     * 配置
     * @var Config
     */
    private Config $config;

    /**
     * 构造函数
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * 获取配置
     * @return Config
     */
    public function getConfig(): Config
    {
        return $this->config;
    }

    /**
     * 签名
     * @param string $method 小红书接口方法名称
     * @param array $data 业务方法参数
     * @return array
     */
    protected function signature(string $method, array $data): array
    {
        $timestamp = time();
        $params = array_filter($data, fn($value) => null !== $value && '' !== $value);
        $params['appId'] = $this->getConfig()->getAppKey();
        $params['timestamp'] = $timestamp;
        $params['version'] = $this->getConfig()->getVersion();
        $params['method'] = $method;
        $params['sign'] = $this->getConfig()->generateSignature($method, $timestamp, $this->getConfig()->getVersion());

        return $params;
    }

    /**
     * POST请求
     * @param string $method 小红书接口方法名称
     * @param array $data 业务方法参数
     * @param bool $withAccessToken 是否携带AccessToken
     * @return array
     */
    final public function post(string $method, array $data = [], bool $withAccessToken = true): array
    {
        return $this->parseHttpResponse($this->request($method, $data, $withAccessToken));
    }

    /**
     * POST请求
     * @param string $method 小红书接口方法名称
     * @param array $data 业务方法参数
     * @param bool $withAccessToken 是否携带AccessToken
     * @return array
     */
    final public function postV2(string $method, array $data = [], bool $withAccessToken = true): array
    {
        return $this->parseHttpResponseV2($this->request($method, $data, $withAccessToken));
    }

    /**
     * 请求
     * @param string $method 小红书接口方法名称
     * @param array $data 业务方法参数
     * @param bool $withAccessToken 是否携带AccessToken
     * @return HttpResponse
     */
    final public function request(string $method, array $data, bool $withAccessToken): HttpResponse
    {
        $params = $this->signature($method, $data);
        if ($withAccessToken) {
            $params['accessToken'] = $this->getConfig()->getAccessToken();
        }

        $payload = json_encode($params);
        $this->writeLog($method . '_request', $payload);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json; charset=utf-8']);
        if (parse_url(Config::API_URL, PHP_URL_SCHEME) === 'https') {
            //false 禁止 cURL 验证对等证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //0 时不检查名称（SSL 对等证书中的公用名称字段或主题备用名称（Subject Alternate Name，简称 SNA）字段是否与提供的主机名匹配）
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        }

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

        curl_setopt($ch, CURLOPT_URL, Config::API_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this->getConfig()->getTimeout());
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->getConfig()->getTimeout());
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);    // 自动跳转，跟随请求Location
        curl_setopt($ch, CURLOPT_MAXREDIRS, 2);         // 递归次数
        $response = curl_exec($ch);
        $this->writeLog($method . '_response', $response);
        $result = new HttpResponse(
            $response,
            (int)curl_getinfo($ch, CURLINFO_RESPONSE_CODE),
            curl_errno($ch),
            curl_error($ch)
        );
        curl_close($ch);

        return $result;
    }

    /**
     * 写日志
     * @param string $method
     * @param bool|string $response
     * @return void
     */
    private function writeLog(string $method, $response): void
    {
        if (is_string($response)) {
            $dir = runtime_path('xiao-hong-shu');
            is_dir($dir) or mkdir($dir, 0755, true);
            file_put_contents($dir . $method . '.json', $response);
        }
    }

    /**
     * 解析HTTP响应
     * @param HttpResponse $httpResponse
     * @return array
     */
    final public function parseHttpResponse(HttpResponse $httpResponse): array
    {
        if ($httpResponse->isFailed()) {
            throw new RuntimeException('CURL请求小红书接口失败：' . $httpResponse->toJson(JSON_UNESCAPED_UNICODE));
        }

        $response = json_decode($httpResponse->getResponse(), true);
        $status = $response['error_code'] ?? -1;
        $msg = $response['error_msg'] ?? '';
        $success = $response['success'] ?? false;
        if (0 === $status && $success) {
            return $response['data'] ?? [];
        }

        $message = (string)($msg ?: $httpResponse->getResponse());
        throw new RuntimeException('小红书接口返回错误：' . $message);
    }

    /**
     * 解析HTTP响应
     * @param HttpResponse $httpResponse
     * @return array
     */
    final public function parseHttpResponseV2(HttpResponse $httpResponse): array
    {
        if ($httpResponse->isFailed()) {
            throw new RuntimeException('CURL请求小红书接口失败：' . $httpResponse->toJson(JSON_UNESCAPED_UNICODE));
        }

        $response = json_decode($httpResponse->getResponse(), true);
        $code = $response['code'] ?? -1;
        $msg = $response['msg'] ?? '';
        $success = $response['success'] ?? false;
        if (200 === $code && $success) {
            return $response['data'] ?? [];
        }

        $message = (string)($msg ?: $httpResponse->getResponse());
        throw new RuntimeException('小红书接口返回错误：' . $message);
    }
}
