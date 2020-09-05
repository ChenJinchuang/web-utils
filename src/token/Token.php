<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/4
 * Time: 11:32 下午
 */

namespace qinchen\token;

use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\SignatureInvalidException;
use UnexpectedValueException;

class Token
{
    /**
     * 生成令牌
     * @param TokenConfig $tokenConfig
     * @return array
     * @throws \Exception
     */
    public static function makeToken(TokenConfig $tokenConfig): array
    {
        $result = [];
        $payload = self::generatePayload($tokenConfig);

        $accessToken = self::generateToken($payload['accessPayload'], $tokenConfig->getAccessSecretKey(), $tokenConfig->getAlgorithms());
        $result['accessToken'] = $accessToken;

        if ($tokenConfig->isDualToken()) {
            $refreshToken = self::generateToken($payload['refreshPayload'], $tokenConfig->getRefreshSecretKey(), $tokenConfig->getAlgorithms());
            $result['refreshToken'] = $refreshToken;
        }
        return $result;
    }

    /**
     * 刷新令牌
     * @param string $token
     * @param TokenConfig $tokenConfig
     * @return array
     */
    public static function refresh(string $token, TokenConfig $tokenConfig): array
    {
        $tokenPayload = self::verifyToken($token, 'refresh', $tokenConfig);
        $tokenPayload['exp'] = $tokenConfig->getAccessExp();
        $token = self::generateToken($tokenPayload, $tokenConfig->getAccessSecretKey(), $tokenConfig->getAlgorithms());
        return [
            'accessToken' => $token
        ];
    }

    /**
     * 令牌校验
     * @param string $token
     * @param string $tokenType
     * @param TokenConfig $tokenConfig
     * @return array 令牌解密后的内容
     * @throws SignatureInvalidException    Provided JWT was invalid because the signature verification failed
     * @throws BeforeValidException         Provided JWT is trying to be used before it's eligible as defined by 'nbf'
     * @throws BeforeValidException         Provided JWT is trying to be used before it's been created as defined by 'iat'
     * @throws ExpiredException             Provided JWT has since expired, as defined by the 'exp' claim
     * @throws UnexpectedValueException     Provided JWT was invalid
     */
    public static function verifyToken(string $token, string $tokenType, TokenConfig $tokenConfig): array
    {
        $secretKey = $tokenType === 'access' ? $tokenConfig->getAccessSecretKey() : $tokenConfig->getRefreshSecretKey();
        return $jwt = (array)JWT::decode($token, $secretKey, array($tokenConfig->getAlgorithms()));
    }

    private static function generateToken(array $payload, string $secretKey, string $algorithms)
    {
        return JWT::encode($payload, $secretKey, $algorithms);
    }

    /**
     * @param TokenConfig $tokenConfig
     * @return array[]
     * @throws \Exception
     */
    private static function generatePayload(TokenConfig $tokenConfig)
    {
        $tokenConfig->checkParams();

        $resPayLoad = [
            'accessPayload' => [],
            'refreshPayload' => [],
        ];

        $basePayload = [
            'iss' => $tokenConfig->getIss(), //签发者
            'iat' => $tokenConfig->getIat(), //什么时候签发的
            'extend' => $tokenConfig->getExtend()  //扩展信息
        ];

        $basePayload['exp'] = time() + $tokenConfig->getAccessExp();
        $resPayLoad['accessPayload'] = $basePayload;

        if ($tokenConfig->isDualToken()) {
            $basePayload['exp'] = time() + $tokenConfig->getRefreshExp();
            $resPayLoad['refreshPayload'] = $basePayload;
        }

        return $resPayLoad;
    }

}