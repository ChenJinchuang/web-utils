<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/11
 * Time: 5:26 下午
 */

namespace qinchen\oss\response;


class DeleteResponse
{
    private $deleted;

    private $sourceData;

    /**
     * PutResponse constructor.
     * @param $deleted
     * @param $sourceData
     */
    public function __construct(array $deleted, $sourceData)
    {
        $this->deleted = $deleted;
        $this->sourceData = $sourceData;
    }

    /**
     * @return mixed
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @return mixed
     */
    public function getSourceData(): array
    {
        return $this->sourceData;
    }
}