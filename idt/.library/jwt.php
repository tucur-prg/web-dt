<?php
/**
 * Json Web Token
 */
class JWT
{
    /**
     * 構造の区切り文字
     */
    const SEPARATOR = '.';

    /**
     * 対応アルゴリズム
     */
    public static $methods = array(
        'HS256' => 'sha256',
        'HS384' => 'sha384',
        'HS512' => 'sha512',
    );

    /**
     * JWTエンコード
     *
     * @param  mixed  $payload エンコードデータ
     * @param  string $key     秘密鍵
     * @param  string $alg     暗号アルゴリズム
     * @return string          エンコード文字列
     */
    public static function encode($payload, $key, $alg = 'HS512')
    {
        $header = array('typ' => 'JWT', 'alg' => $alg);

        $segments = array();

        $segments[] = self::urlsafeBase64Encode(json_encode($header));
        $segments[] = self::urlsafeBase64Encode(json_encode($payload));

        $signatureInput = implode(self::SEPARATOR, $segments);

        $signature = $alg == 'none' ? '' : self::sign($signatureInput, $key, $alg);

        $segments[] = self::urlsafeBase64Encode($signature);

        return implode(self::SEPARATOR, $segments);
    }

    /**
     * JWTデコード
     *
     * @param  string  $jwt    エンコード文字列
     * @param  string  $key    秘密鍵
     * @param  boolean $verify 検証実施
     * @return mixed           デコード済みデータ
     */
    public static function decode($jwt, $key = null, $verify = true)
    {
        $arr = explode(self::SEPARATOR, $jwt);

        $header64    = isset($arr[0]) ? $arr[0] : null;
        $payload64   = isset($arr[1]) ? $arr[1] : null;
        $signature64 = isset($arr[2]) ? $arr[2] : null;

        $header = json_decode(self::urlsafeBase64Decode($header64), true);
        if (empty($header) === true) {
            throw new \UnexpectedValueException('Invalid segment encoding');
        }

        $payload = json_decode(self::urlsafeBase64Decode($payload64), true);
        if (empty($payload) === true) {
            throw new \UnexpectedValueException('Invalid segment encoding');
        }

        $signature = self::urlsafeBase64Decode($signature64);
        if ($verify) {
            if (empty($header['alg']) === true) {
                throw new \DomainException('Empty algorithm');
            }

            $signatureInput = $header64.self::SEPARATOR.$payload64;
            if ($signature != self::sign($signatureInput, $key, $header['alg'])) {
                throw new \UnexpectedValueException('Signature verification failed');
            }
        }

        return $payload;
    }

    /**
     * 署名を発行する
     *
     * @param  string $message ハッシュメッセージ
     * @param  string $key     秘密鍵
     * @param  string $method  方式
     * @return string          署名
     */
    public static function sign($message, $key, $method = 'HS256')
    {
        if (isset(self::$methods[$method]) === false) {
            throw new \DomainException('Algorithm not supported');
        }

        return hash_hmac(self::$methods[$method], $message, $key, true);
    }

    /**
     * URL考慮のBase64エンコード
     *
     * @param  string $input 文字列
     * @return string        エンコード文字列
     */
    public static function urlsafeBase64Encode($input)
    {
        return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
    }

    /**
     * URL考慮のBase64デコード
     *
     * @param  string $input エンコード文字列
     * @return string        デコード文字列
     */
    public static function urlsafeBase64Decode($input)
    {
        $remainder = strlen($input) % 4;
        if ($remainder) {
            $padLen = 4 - $remainder;
            $input .= str_repeat('=', $padLen);
        }

        return base64_decode(strtr($input, '-_', '+/'));
    }
}
