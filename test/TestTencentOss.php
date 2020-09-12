<?php

use OSS\Core\OssException;
use qinchen\oss\Manager;
use qinchen\oss\storage\aliyun\Aliyun;
use qinchen\oss\storage\StorageConfig;
use qinchen\oss\storage\tencent\Tencent;

/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/12
 * Time: 1:10 上午
 */
class TestTencentOss extends PHPUnit\Framework\TestCase
{
    /**
     * @var Tencent
     */
    private $storage;


    private function init()
    {
        $config = (new StorageConfig())
            ->setAppId("")
            ->setAppKey("")
            ->setRegion("");

        $this->storage = Manager::storage("tencent")
            ->init($config)
            ->bucket("");
    }

    /**
     * @test
     */
    public function get()
    {
        $this->init();
        $objectListInfo = $this->storage->get(10);
        $this->assertIsObject($objectListInfo, $objectListInfo);
    }

    /**
     * @test
     */
    public function put()
    {
        $path = "";
        $file = fopen($path, 'rb');
        $this->init();
        $result = $this->storage->put("tx-test2.jpg", $file);
        $this->assertIsObject($result);
    }

    /**
     * @test
     */
    public function putPart()
    {
        $path = "";
        $file = fopen($path, 'rb');
        $this->init();
        $result = $this->storage->putPart("tx-test2.jpg", $file);
        $this->assertIsObject($result);
    }

    /**
     * @test
     */
    public function delete()
    {
        $keys = ['tx-test.jpg', 'EightSights_center_10001.jpg'];
        $this->init();
        $delete = $this->storage->delete($keys);
        $this->assertIsObject($delete);
    }

}