<?php 

namespace Bluteki\MpesaGateway\Helpers;
use Bluteki\MpesaGateway\Contracts\Token\RSATokenContract;

class RSAToken implements RSATokenContract {

    public static function make( string $api_key, string $public_key ): string
    {
        $key = self::keysToCertificate($public_key);
        $public_key = openssl_get_publickey($key);
        openssl_public_encrypt($api_key, $token, $public_key, OPENSSL_PKCS1_PADDING);
        return base64_encode($token);
    }

    protected static function keysToCertificate(string $public_key): string
    {
        $certificate = "-----BEGIN PUBLIC KEY-----\n";
        $certificate .= wordwrap($public_key, 60, "\n", true);
        $certificate .= "\n-----END PUBLIC KEY-----";
        return $certificate;
    }
}