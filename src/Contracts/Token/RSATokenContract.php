<?php

namespace Bluteki\MpesaGateway\Contracts\Token;

interface RSATokenContract{

    /**
     * @param string $api_key
     * @param string $public_key
     * @return string
     */
    public static function make( string $api_key, string $public_key ): string;
}