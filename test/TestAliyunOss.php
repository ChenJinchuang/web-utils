<?php

use OSS\Core\OssException;
use qinchen\oss\Manager;
use qinchen\oss\storage\aliyun\Aliyun;
use qinchen\oss\storage\StorageConfig;

/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/12
 * Time: 1:10 上午
 */
class TestAliyunOss extends PHPUnit\Framework\TestCase
{
    /**
     * @var Aliyun
     */
    private $storage;

    private function init()
    {
        $config = (new StorageConfig())
            ->setAppId("")
            ->setAppKey("")
            ->setRegion("");

        $this->storage = Manager::storage("aliyun")
            ->init($config)
            ->bucket("");
    }

    /**
     * @test
     * @throws OssException
     */
    public function get()
    {
        $this->init();
        $objectListInfo = $this->storage->get(10);
        $this->assertIsObject($objectListInfo);
    }

    /**
     * @test
     * @throws OssException
     */
    public function put()
    {
        $this->init();
        $path = "";
        $result = $this->storage->put("test.jpg", $path);
        $this->assertIsObject($result);
    }

    /**
     * @test
     * @throws OssException
     */
    public function putPart()
    {
        $this->init();
        $path = "";
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
        $this->assertIsArray($responseCore);
    }
}