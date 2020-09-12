<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/11
 * Time: 5:26 下午
 */

namespace qinchen\oss\response;


class PutResponse
{
    private $key;

    private $sourceData;

    /**
     * PutResponse constructor.
     * @param $key
     * @param $sourceData
     */
    public function __construct(string $key, $sourceData)
    {
        $this->key = $key;
        $this->sourceData = $sourceData;
    }


    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function getSourceData(): array
    {
        return $this->sourceData;
    }
}