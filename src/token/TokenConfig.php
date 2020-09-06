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
     * @var bool 是否开启双令牌模式
     */
    private $dualToken;
    /**
     * @var string access令牌秘钥
     */
    private $accessSecretKey;
    /**
     * @var string refresh令牌秘钥
     */
    private $refreshSecretKey;
    /**
     * @var string 算法类型，支持：
     * ES256、HS256、HS384、HS512、RS256、RS384、RS512
     */
    private $algorithms;
    /**
     * @var string 令牌签发者
     */
    private $iss;
    /**
     * @var int 令牌签发时间
     */
    private $iat;
    /**
     * @var int access令牌过期时间，单位秒
     */
    private $accessExp;

    /**
     * @var int refresh令牌过期时间，单位秒
     */
    private $refreshExp;
    /**
     * @var array 令牌内容扩展字段，用于存放自定义信息
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
     * 设置令牌模式
     * @param bool $dualToken true：双令牌;false: 单令牌模式
     * @return TokenConfig
     */
    public function dualToken(bool $dualToken): TokenConfig
    {
        $this->dualToken = $dualToken;
        return $this;
    }

    /**
     * 设置access令牌秘钥
     * @param string $accessSecretKey 随机字符串，用于加解密
     * @return TokenConfig
     */
    public function setAccessSecretKey(string $accessSecretKey): TokenConfig
    {
        $this->accessSecretKey = $accessSecretKey;
        return $this;
    }

    /**
     * 设置refresh令牌秘钥，仅开启双令牌下需设置
     * @param string $refreshSecretKey 随机字符串，用于加解密
     * @return TokenConfig
     */
    public function setRefreshSecretKey(string $refreshSecretKey): TokenConfig
    {
        $this->refreshSecretKey = $refreshSecretKey;
        return $this;

    }

    /**
     * 设置加密算法类型
     * @param string $algorithms 支持：ES256、HS256、HS384、HS512、RS256、RS384、RS512
     * @return TokenConfig
     */
    public function setAlgorithms(string $algorithms): TokenConfig
    {
        $this->algorithms = $algorithms;
        return $this;

    }

    /**
     * 设置令牌签发者
     * @param string $iss
     * @return TokenConfig
     */
    public function setIss(string $iss): TokenConfig
    {
        $this->iss = $iss;
        return $this;

    }

    /**
     * 设置签发时间
     * @param int $iat 签发时的时间戳
     * @return TokenConfig
     */
    public function setIat(int $iat): TokenConfig
    {
        $this->iat = $iat;
        return $this;
    }

    /**
     * 设置Access令牌过期时间
     * @param int $accessExp 令牌过期时间，单位秒
     * @return TokenConfig
     */
    public function setAccessExp(int $accessExp): TokenConfig
    {
        $this->accessExp = $accessExp;
        return $this;
    }

    /**
     * Refresh令牌过期时间，仅开启双令牌下需设置
     * @param int $refreshExp 令牌过期时间，单位秒
     * @return TokenConfig
     */
    public function setRefreshExp(int $refreshExp): TokenConfig
    {
        $this->refreshExp = $refreshExp;
        return $this;

    }

    /**
     * 设置令牌扩展字段内容
     * @param array $extend 自定义内容
     * @return TokenConfig
     */
    public function setExtend(array $extend): TokenConfig
    {
        $this->extend = $extend;
        return $this;
    }

    /**
     * 参数检查
     * @return bool
     * @throws \Exception
     */
    public function checkParams(): bool
    {
        if ((empty($this->refreshSecretKey) || empty($this->refreshExp)) && $this->dualToken) {
            throw new \Exception("双令牌模式下refreshExp和refreshSecretKey属性不能为空");
        }

        $objectVars = get_object_vars($this);
        foreach ($objectVars as $key => $value) {
            if ($key !== 'extend' && $key !== 'refreshExp' && $key !== 'refreshSecretKey' && is_null($value)) {
                throw new \Exception("令牌参数{$key}未配置");
            }
        }
        return true;
    }
}