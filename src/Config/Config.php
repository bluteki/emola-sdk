<?php

namespace Bluteki\Sdk\Config;

class Config {

    /**
     * @var string $environment
     */
    private static string $environment = 'development';

    /**
     * @var string $host
     */
    private static string $host = 'api.sandbox.vm.co.mz';

    /**
     * @var string $origin
     */
    private static string $origin = 'developer.mpesa.vm.co.mz';

    /**
     * @var string $api_key
     */
    private static string $api_key;

    /**
     * @var string $public_key
     */
    private static string $public_key;

    /**
     * @var string $port
     */
    private static string $port = '18352';

    /**
     * @var string $service_provider_code
     */
    private static string $service_provider_code = '171717';


    /**
     * @var string $initiatorIdentifier
     */
    private static string $initiatorIdentifier = 'MPesa2018';

    /**
     * @var string $securityCredential
     */
    private static string $securityCredential = 'Mpesa2019';

    /**
     * @var string $username
     */
    private static string $username;

    /**
     * @var string $password
     */
    private static string $password;

    /**
     * @var string $key
     */
    private static string $key;

    /**
     * @var int $partnerCode
     */
    private static int $partnerCode;

    /**
     * @var string $language
     */
    private static string $language;


    public static function config( 
        string $host, 
        string $username,
        string $password,
        string $key,
        string $partnerCode,
        string $language
    ) {
        self::$host = $host;
        self::$username = $username;
        self::$password = $password;
        self::$key = $key;
        self::$partnerCode = $partnerCode;
        self::$language = $language;
    }

    /**
     * @return string
     */
    public static function getEnvironment(): string 
    {
        return self::$environment;
    }

    /**
     * @return string
     */
    public static function getHost(): string 
    {
        return self::$host;
    }

    /**
     * @return string
     */
    public static function getApiKey(): string 
    {
        return self::$api_key;
    }

    /**
     * @return string
     */
    public static function getPublicKey(): string 
    {
        return self::$public_key;
    }

    /**
     * @return string
     */
    public static function getPort(): string 
    {
        return self::$port;
    }

    /**
     * @return string
     */
    public static function getServiceProviderCode(): string 
    {
        return self::$service_provider_code;
    }

    public static function getOrigin(): string
    {
        return self::$origin;
    }

    public static function getInitiatorIdentifier(): string
    {
        return self::$initiatorIdentifier;
    }

    public static function getSecurityCredentials(): string 
    {
        return self::$securityCredential;
    }

    public static function getUsername(): string 
    {
        return self::$username;
    }

    public static function getPassword(): string 
    {
        return self::$password;
    }

    public static function getKey(): string 
    {
        return self::$key;
    }

    public static function getPartnerCode(): string 
    {
        return self::$partnerCode;
    }

    public static function getLanguage(): string 
    {
        return self::$language;
    }
}