<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/11
 * Time: 12:12 下午
 */

namespace qinchen\oss\storage;


use qinchen\oss\response\DeleteResponse;
use qinchen\oss\response\PutResponse;

interface ICloudStorage
{
    /**
     * 根据配置类初始化云API
     * @param StorageConfig $config
     * @return mixed
     */
    public function init(StorageConfig $config);

    /**
     * 指定操作的存储桶
     * @param string $bucket 存储桶名称
     * @return mixed
     */
    public function bucket(string $bucket);

    /**
     * 文件列表查询
     * @param int $limit 查询条目数
     * @param string $delimiter 要分隔符分组结果
     * @param string $prefix 指定key前缀查询
     * @return mixed
     */
    public function get(int $limit, string $delimiter = '', string $prefix = '');

    /**
     * 单文件上传
     * @param string $key 指定唯一的文件key
     * @param string|resource $body 上传内容
     * @return PutResponse
     */
    public function put(string $key, $body): PutResponse;

    /**
     * 分块文件上传
     * @param string $key 指定唯一的文件key
     * @param resource $body 上传内容
     * @param int $partSize 指定块大小
     * @return PutResponse
     */
    public function putPart(string $key, $body, int $partSize): PutResponse;

    /**
     * 删除指定key的文件
     * @param array $keys 待删除的key数组
     * @return DeleteResponse
     */
    public function delete(array $keys): DeleteResponse;
}