<?php

namespace Bluteki\Sdk;

use Bluteki\Sdk\Contracts\EmolaStaticContract;
use Bluteki\Sdk\Config\Config;
use Bluteki\MpesaGateway\Helpers\RSAToken;

class Emola extends Config implements EmolaStaticContract {

    /**
     * @var bool $test
     */
    protected static bool $fake = false;

    /**
     * @var string
     */
    protected static string $status = "";

    /**
     * @var int
     */
    protected static string $responseCode = '0';

    /**
     * @param string $responseCode
     * @param string $status
     */
    public static function fake(string $responseCode = '0', string $status = ""): void
    {
        self::$fake = true;
        self::$status = $status;
        self::$responseCode = $responseCode;
    }

    /**
     * @param string $status
     */
    public static function setStatus(string $status): void
    {
        self::$status = $status;
    }

    /**
     * @param int $code
     */
    public static function setResponseCode(int $code): void
    {
        self::$responseCode = $code;
    }
 
    public static function c2b( float $amount, string $msisdn, string $transactionID, string $transactionReference, string $smsContent ) {
        return (new static())->mPesa()->c2b( $amount, $msisdn, $transactionID, $transactionReference, $smsContent );
    }

    /**
     * Initiates a business to business (b2c) transaction on the M-Pesa API.
     *
     * @param float $amount
     * @param string $msisdn
     * @param string $transactionID
     * @param $smsContent
     * @return mixed
     */
    public static function b2c(float $amount, string $msisdn, string $transactionID, $smsContent) {
        return (new static())->mPesa()->b2c($amount, $msisdn, $transactionID, $smsContent);
    }

    /**
     * Get transaction in M-Pesa API.
     *
     * @param string $transactionID
     * @param string $transactionType
     * @return Transaction
     */
    public static function transaction( string $transactionID, string $transactionType) {
        return (new static())->mPesa()->transaction($transactionID, $transactionType);
    }

    /**
     * Summary of beneficiary
     * @param string $msisdn
     * @param string $transactionID
     * @return mixed
     */
    public static function beneficiary( string $msisdn, string $transactionID) {
        return (new static())->mPesa()->beneficiary($msisdn, $transactionID);
    }

    /**
     * Summary of beneficiary
     * @param string $msisdn
     * @param string $transactionID
     * @return mixed
     */
    public static function accountBalance( string $transactionID) {
        return (new static())->mPesa()->accountBalance($transactionID );
    }

 
    protected function mPesa()
    {
        // $token = RSAToken::make(self::getApiKey(), self::getPublicKey());
        $request = new Request(self::getHost(), self::getUsername(), self::getPassword(), self::getKey(), self::getPartnerCode(), self::getLanguage());
        return $request->setFake(self::$fake, self::$responseCode, self::$status);
    }
}