# Token

## example

```php
<?php
/**
 * Created by PhpStorm
 * Author: 沁塵
 * Date: 2020/9/6
 * Time: 12:41 下午
 */

namespace qinchen\example;


use qinchen\token\Token;
use qinchen\token\TokenConfig;

class Example
{
    public function singleToken()
    {
        $config = (new TokenConfig())->dualToken(false)
            ->setAccessSecretKey('djakljsdijw')
            ->setAccessExp(7200)
            ->setIss('qinchen')
            ->setIat(time())
            ->setAlgorithms('HS256')
            ->setExtend(['uid' => 857]);

        $token = Token::makeToken($config);
        print_r($token);
        $payload = Token::verifyToken($token['accessToken'], 'access', $config);
        print_r($payload);
    }

    public function dualToken()
    {
        $config = (new TokenConfig())->dualToken(true)
            ->setAccessSecretKey('djakljsdijw')
            ->setAccessExp(7200)
            ->setRefreshSecretKey('12@.sowi1')
            ->setRefreshExp(684000)
            ->setIss('qinchen')
            ->setIat(time())
            ->setAlgorithms('HS256')
            ->setExtend(['uid' => 857]);

        $token = Token::makeToken($config);
        print_r($token);
        $newToken = Token::refresh($token['refreshToken'], $config);
        print_r($newToken);
        $payload = Token::verifyToken($newToken['accessToken'], 'access', $config);
        print_r($payload);
        $payload = Token::verifyToken($token['refreshToken'], 'refresh', $config);
        print_r($payload);
    }
}

```