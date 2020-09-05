<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/5
 * Time: 12:21 上午
 */

namespace qinchen\token;


class TokenConfig
{
    /**
     * @var bool
     */
    private $dualToken;
    /**
     * @var string
     */
    private $accessSecretKey;
    /**
     * @var string
     */
    private $refreshSecretKey;
    /**
     * @var string
     */
    private $algorithms;
    /**
     * @var string
     */
    private $iss;
    /**
     * @var int
     */
    private $iat;
    /**
     * @var int
     */
    private $accessExp;

    /**
     * @var int
     */
    private $refreshExp;
    /**
     * @var array
     */
    private $extend;

    /**
     * @return bool
     */
    public function isDualToken(): bool
    {
        return $this->dualToken;
    }

    /**
     * @return string
     */
    public function getAccessSecretKey(): string
    {
        return $this->accessSecretKey;
    }

    /**
     * @return string
     */
    public function getRefreshSecretKey(): string
    {
        return $this->refreshSecretKey;
    }

    /**
     * @return string
     */
    public function getAlgorithms(): string
    {
        return $this->algorithms;
    }

    /**
     * @return string
     */
    public function getIss(): string
    {
        return $this->iss;
    }

    /**
     * @return int
     */
    public function getIat(): int
    {
        return $this->iat;
    }

    /**
     * @return int
     */
    public function getAccessExp(): int
    {
        return $this->accessExp;
    }

    /**
     * @return int
     */
    public function getRefreshExp(): int
    {
        return $this->refreshExp;
    }


    /**
     * @return array
     */
    public function getExtend(): array
    {
        return $this->extend;
    }

    /**
     * 是否生成双令牌
     * @param bool $dualToken
     * @return TokenConfig
     */
    public function dualToken(bool $dualToken): TokenConfig
    {
        $this->dualToken = $dualToken;
        return $this;
    }

    /**
     * 令牌秘钥
     * @param string $accessSecretKey
     * @return TokenConfig
     */
    public function setAccessSecretKey(string $accessSecretKey): TokenConfig
    {
        $this->accessSecretKey = $accessSecretKey;
        return $this;
    }

    /**
     * 令牌秘钥，仅开启双令牌下需设置
     * @param string $refreshSecretKey
     * @return TokenConfig
     */
    public function setRefreshSecretKey(string $refreshSecretKey): TokenConfig
    {
        $this->refreshSecretKey = $refreshSecretKey;
        return $this;

    }

    /**
     * 加密算法类型
     * @param string $algorithms
     * @return TokenConfig
     */
    public function setAlgorithms(string $algorithms): TokenConfig
    {
        $this->algorithms = $algorithms;
        return $this;

    }

    /**
     * 令牌签发者
     * @param string $iss
     * @return TokenConfig
     */
    public function setIss(string $iss): TokenConfig
    {
        $this->iss = $iss;
        return $this;

    }

    /**
     * 签发时间
     * @param int $iat
     * @return TokenConfig
     */
    public function setIat(int $iat): TokenConfig
    {
        $this->iat = $iat;
        return $this;
    }

    /**
     * Access令牌过期时间
     * @param int $accessExp
     * @return TokenConfig
     */
    public function setAccessExp(int $accessExp): TokenConfig
    {
        $this->accessExp = $accessExp;
        return $this;
    }

    /**
     * Refresh令牌过期时间，仅开启双令牌下需设置
     * @param int $refreshExp
     * @return TokenConfig
     */
    public function setRefreshExp(int $refreshExp): TokenConfig
    {
        $this->refreshExp = $refreshExp;
        return $this;

    }

    /**
     * 设置令牌扩展字段内容
     * @param array $extend
     * @return TokenConfig
     */
    public function setExtend(array $extend): TokenConfig
    {
        $this->extend = $extend;
        return $this;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    public function checkParams(): bool
    {
        $objectVars = get_object_vars($this);
        foreach ($objectVars as $key => $value) {
            if ($key !== 'extend' && is_null($value)) {
                throw new \Exception("令牌参数{$key}未配置");
            }
        }
        return true;
    }
}