# OSS

## Introduction

Supper quick use [Aliyun OSS](https://www.aliyun.com/product/oss) or [Tencent COS](https://cloud.tencent.com/product/cos) 、
 [Qiniu](https://www.qiniu.com/products/kodo) to get、put、delete Object.

## example

```php
use qinchen\oss\Manager;
use qinchen\oss\storage\StorageConfig;

    // string $appId, string $appKey, string $region
    $config = new StorageConfig("控制台查看获取", "控制台查看获取", "七牛云不需要配置这个参数，留空字符串");

    $storage = Manager::storage("云存储厂商") // 阿里云：aliyun、腾讯云：tencent、七牛云：qiniu
        ->init($config) // 初始化配置
        ->bucket("存储桶名称"); // 指定操作的存储桶

    // 查看文件列表
    $storage->get(10); // 指定查看10条
    // 上传文件
    $path = "./test.jpg";
    $result = $this->storage->put("test.jpg", $path);
    // 删除文件
    $keys = ['test.jpg'];
    $result = $this->storage->delete($keys);
```

