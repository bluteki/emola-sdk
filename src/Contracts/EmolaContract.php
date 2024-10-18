<?php

namespace Bluteki\Sdk\Contracts;

interface EmolaContract {

    /**
     * @param string $host
     * @param string $origin
     * @param string $token
     * @param string $serviceProviderCode
     * @param string $initiatorIdentifier
     * @param string $securityCredential
     */
    public function __construct(
        string $host,
        string $origin,
        string $token,
        string $serviceProviderCode,
        string $initiatorIdentifier,
        string $securityCredential
    );

    public function c2b(
        float $amount,
        string $msisdn,
        string $transactionID,
        string $transactionReference,
        string $smsContent
    );

    public function b2c(
        float $amount,
        string $msisdn,
        string $transactionID,
        string $smsContent
    );

    public function transaction(
        string $transactionID,
        string $transactionType,
    );

    public function beneficiary(
        string $msisdn,
        string $transactionID
    );

    public function accountBalance(
        string $transactionID
    );
}