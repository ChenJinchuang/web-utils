<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/11
 * Time: 3:32 下午
 */

namespace qinchen\oss\exception;


class NonsupportStorageTypeException extends \Exception
{
    protected $message = "不支持该类型云存储";
}