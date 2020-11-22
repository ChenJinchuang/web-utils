<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/11
 * Time: 12:14 下午
 */

namespace qinchen\oss;


use qinchen\oss\exception\NonsupportStorageTypeException;
use qinchen\oss\storage\aliyun\Aliyun;
use qinchen\oss\storage\qiniu\Qiniu;
use qinchen\oss\storage\tencent\Tencent;

class Manager
{

    /**
     * 获取指定云存储实例
     * @param string $type 云存储类型，阿里云：aliyun、腾讯云：tencent、七牛云：qiniu
     * @return Aliyun|Tencent 具体类型云存储实例
     * @throws NonsupportStorageTypeException
     */
    public static function storage(string $type)
    {
        $storage = null;
        switch ($type) {
            case "aliyun":
                $storage = new Aliyun();
                break;
            case "tencent":
                $storage = new Tencent();
                break;
            case "qiniu":
                $storage = new Qiniu();
                break;
            default:
                throw new NonsupportStorageTypeException();
        }
        return $storage;
    }
}