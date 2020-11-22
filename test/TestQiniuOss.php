<?php

use qinchen\oss\Manager;
use qinchen\oss\storage\qiniu\Qiniu;
use qinchen\oss\storage\StorageConfig;

/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/12
 * Time: 1:10 上午
 */
class TestQiniuOss extends PHPUnit\Framework\TestCase
{
    /**
     * @var Qiniu
     */
    private $storage;

    private function init()
    {
        $config = new StorageConfig("控制台查看获取", "控制台查看获取", "七牛云不需要配置这个参数，留空字符串");
        $this->storage = Manager::storage("qiniu")
            ->init($config)
            ->bucket("存储桶名称");
    }

    /**
     * @test
     */
    public function get()
    {
        $this->init();
        $objectListInfo = $this->storage->get(10);
        $this->assertIsArray($objectListInfo);
    }

    /**
     * @test
     */
    public function put()
    {
        $this->init();
        $path = "带扩展名的完整文件路径";
        $result = $this->storage->put("test.jpg", $path);
        $this->assertIsObject($result);
    }

    /**
     * @test
     */
    public function putPart()
    {
        $this->init();
        $path = "带扩展名的完整文件路径";
        $result = $this->storage->putPart("test.jpg", $path);
        $this->assertIsObject($result);
    }

    /**
     * @test
     */
    public function delete()
    {
        $this->init();
        $keys = ['test.jpg'];
        $responseCore = $this->storage->delete($keys);
        $this->assertIsObject($responseCore);
    }
}