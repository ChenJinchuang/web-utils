<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/11
 * Time: 3:38 下午
 */

namespace qinchen\oss\storage\tencent;


use Qcloud\Cos\Client;
use qinchen\oss\exception\ConfigException;
use qinchen\oss\response\DeleteResponse;
use qinchen\oss\response\PutResponse;
use qinchen\oss\storage\ICloudStorage;
use qinchen\oss\storage\StorageConfig;

class Tencent implements ICloudStorage
{

    /**
     * @var Client
     */
    private $ossClient;

    /**
     * @var string;
     */
    private $bucket;

    /**
     * 根据配置类初始化云API
     * @param StorageConfig $config
     * @return Tencent
     * @throws ConfigException
     */
    public function init(StorageConfig $config): Tencent
    {
        $config->checkParams();
        $this->ossClient = new Client([
            'region' => $config->getRegion(),
            'schema' => 'https', //协议头部，默认为http
            'credentials' => [
                'secretId' => $config->getAppId(),
                'secretKey' => $config->getAppKey()
            ]
        ]);
        return $this;
    }

    /**
     * 指定操作的存储桶
     * @param string $bucket 存储桶名称
     * @return Tencent
     */
    public function bucket(string $bucket): Tencent
    {
        $this->bucket = $bucket;
        return $this;
    }

    /**
     * 文件列表查询
     * @param int $limit 查询条目数
     * @param string $delimiter 要分隔符分组结果
     * @param string $prefix 指定key前缀查询
     * @param string $marker 标明本次列举文件的起点
     * @return mixed
     */
    public function get(int $limit, string $delimiter = '', string $prefix = '', string $marker = '')
    {
        $options = [
            'Bucket' => $this->bucket,
            'Delimiter' => $delimiter,
            'Prefix' => $prefix,
            'MaxKeys' => $limit,
            'Marker' => $marker,
        ];
        return $this->ossClient->listObjects($options);
    }

    /**
     * 单文件上传
     * @param string $key 指定唯一的文件key
     * @param string $path 上传内容
     * @return PutResponse
     * @throws ConfigException
     */
    public function put(string $key, string $path): PutResponse
    {
        if (!is_file($path)) {
            throw new ConfigException("Parameter 2 must be a valid file path");
        }

        $file = fopen($path, 'rb');

        $ossRes = $this->ossClient->upload($this->bucket, $key, $file);
        return new PutResponse($key, $ossRes);
    }

    /**
     * 分块文件上传
     * @param string $key 指定唯一的文件key
     * @param string $path 上传内容
     * @param int|null $partSize 指定块大小
     * @return PutResponse
     * @throws ConfigException
     */
    public function putPart(string $key, string $path, int $partSize = null): PutResponse
    {
        return $this->put($key, $path);
    }

    /**
     * 删除指定key的文件
     * @param array $keys 待删除的key数组
     * @return DeleteResponse
     */
    public function delete(array $keys): DeleteResponse
    {
        $objects = array_map(function ($key) {
            return ['Key' => $key];
        }, $keys);
        $options = [
            'Bucket' => $this->bucket,
            'Objects' => $objects,
        ];
        $ossRes = $this->ossClient->deleteObjects($options);

        return new DeleteResponse($keys, $ossRes);
    }

}