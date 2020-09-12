<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/11
 * Time: 4:56 下午
 */

namespace qinchen\oss\storage;


use qinchen\oss\exception\ConfigException;

class StorageConfig
{

    private $appId;

    private $appKey;

    private $region;


    /**
     * @return string
     */
    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * 云 API 密钥，请到相应云存储平台的控制台获取
     * 腾讯云为SecretId
     * 阿里云为AccessKeyId
     * @param string $appId
     * @return StorageConfig
     */
    public function setAppId(string $appId): StorageConfig
    {
        $this->appId = $appId;
        return $this;
    }

    /**
     * @return string
     */
    public function getAppKey(): string
    {
        return $this->appKey;
    }

    /**
     * 云 API 密钥，请到相应云存储平台的控制台获取
     * 腾讯云SecretKey
     * 阿里云为AccessKeySecret
     * @param string $appKey
     * @return StorageConfig
     */
    public function setAppKey(string $appKey): StorageConfig
    {
        $this->appKey = $appKey;
        return $this;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * 设置使用的存储桶名称
     * @param string $region
     * @return StorageConfig
     */
    public function setRegion(string $region): StorageConfig
    {
        $this->region = $region;
        return $this;
    }

    /**
     * 配置参数基础检查
     * @return bool
     * @throws ConfigException
     */
    public function checkParams(): bool
    {
        $objectVars = get_object_vars($this);
        foreach ($objectVars as $key => $value) {
            if (is_null($value)) {
                throw new ConfigException("配置参数{$key}未配置");
            }
        }
        return true;
    }
}