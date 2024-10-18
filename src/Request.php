<?php

namespace Bluteki\Sdk;

use Bluteki\Sdk\Contracts\EmolaContract;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use \GuzzleHttp\Exception\RequestException;
use \GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\StreamInterface;
use SoapClient;

class Request implements EmolaContract
{

    /**
     * @var string $host
     */
    protected string $host;

    /**
     * @var bool $fake
     */
    protected bool $fake;

    /**
     * @var int $code
     */
    protected int $errorCode;

    /**
     * @var string $status
     */
    protected string $responseStatus;

    /**
     * @var int $partnerCode
     */
    protected int $partnerCode;

    /**
     * @var string $language
     */
    protected string $language;

    /**
     * @var string $key
     */
    protected string $key;

    /**
     * @var string $username
     */
    protected string $username;

    /**
     * @var string $password
     */
    protected string $password;


    public function __construct($host, $username, $password, $key, $partnerCode, $language = 'pt')
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->key = $key;
        $this->partnerCode = $partnerCode;
        $this->language = $language;
    }

    /**
     * @param bool $fake
     * @param int $code
     * @param string $status
     * @return EmolaContract
     */
    public function setFake(bool $fake, int $code, string $status): EmolaContract
    {
        $this->fake = $fake;
        $this->errorCode = $code;
        $this->responseStatus = $status;
        return $this;
    }

    public function c2b(float $amount, string $msisdn, string $transactionID, string $transactionReference, string $smsContent)
    {
        $data = [
            'Input' => [
                'username' => $this->username,
                'password' => $this->password,
                'wscode' => 'pushUssdMessage',
                "param" => [
                    ['name' => 'partnerCode', 'value' => $this->partnerCode],
                    ['name' => 'msisdn', 'value' => $msisdn],
                    ['name' => 'smsContent', 'value' => $smsContent],
                    ['name' => 'transAmount', 'value' => $amount],
                    ['name' => 'transId', 'value' => $transactionID],
                    ['name' => 'language', 'value' => $this->language],
                    ['name' => 'refNo', 'value' => $transactionReference],
                    ['name' => 'key', 'value' => $this->key]
                ],
                'rawData' => '?'
            ]
        ];

        try {
            $client = $this->request($this->host, $data);
            $response = $client->__soapCall('gwOperation', $data);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return new Transaction($response);
    }

    /**
     * Initiates a business to business (b2c) transaction on the M-Pesa API.
     *
     * @param float $amount
     * @param string $msisdn
     * @param string $transactionReference
     * @param $thirdPartyReference
     * @return Transaction
     * @throws Exception|GuzzleException
     */
    public function b2c(float $amount, string $msisdn, string $transactionID, string $smsContent)
    {

        $data = [
            'Input' => [
                'username' => $this->username,
                'password' => $this->password,
                'wscode' => 'pushUssdDisbursementB2C',
                "param" => [
                    ['name' => 'partnerCode', 'value' => $this->partnerCode],
                    ['name' => 'msisdn', 'value' => $msisdn],
                    ['name' => 'smsContent', 'value' => $smsContent],
                    ['name' => 'transAmount', 'value' => $amount],
                    ['name' => 'transId', 'value' => $transactionID],
                    ['name' => 'key', 'value' => $this->key]
                ],
                'rawData' => '?'
            ]
        ];

        try {
            $client = $this->request($this->host, $data);
            $response = $client->__soapCall('gwOperation', $data);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return new Transaction($response);
    }

    /**
     * Initiates a reversal transaction on the M-Pesa API.
     *
     * @param string $transactionID
     * @param string $transactionType
     * @return Transaction
     * @throws Exception|GuzzleException
     */
    public function transaction(string $transactionID, string $transactionType)
    {

        $data = [
            'Input' => [
                'username' => $this->username,
                'password' => $this->password,
                'wscode' => 'pushUssdQueryTrans',
                "param" => [
                    ['name' => 'partnerCode', 'value' => $this->partnerCode],
                    ['name' => 'transId', 'value' => $transactionID],
                    ['name' => 'key', 'value' => $this->key],
                    ['name' => 'transType', 'value' => $transactionType]
                ],
                'rawData' => '?'
            ]
        ];

        try {
            $client = $this->request($this->host, $data);
            $response = $client->__soapCall('gwOperation', $data);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return $response;

    }

    /**
     * Summary of beneficiary
     * @param string $msisdn
     * @param string $transactionID
     * @return mixed
     */
    public function beneficiary(string $msisdn, string $transactionID)
    {
        $data = [
            'Input' => [
                'username' => $this->username,
                'password' => $this->password,
                'wscode' => 'queryBeneficiaryName',
                "param" => [
                    ['name' => 'transId', 'value' => $transactionID],
                    ['name' => 'partnerCode', 'value' => $this->partnerCode],
                    ['name' => 'msisdn', 'value' => $msisdn],
                    ['name' => 'key', 'value' => $this->key],
                ],
                'rawData' => '?'
            ]
        ];

        try {
            $client = $this->request($this->host, $data);
            $response = $client->__soapCall('gwOperation', $data);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    /**
     * Summary of accountBalance
     * @param string $transactionID
     * @return mixed
     */
    public function accountBalance(string $transactionID)
    {

        $data = [
            'Input' => [
                'username' => $this->username,
                'password' => $this->password,
                'wscode' => 'queryAccountBalance',
                "param" => [
                    ['name' => 'transId', 'value' => $transactionID],
                    ['name' => 'partnerCode', 'value' => $this->partnerCode],
                    ['name' => 'key', 'value' => $this->key],
                ],
                'rawData' => '?'
            ]
        ];

        try {
            $client = $this->request($this->host, $data);
            $response = $client->__soapCall('gwOperation', $data);
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }


    /**
     * Summary of request
     * @param string $wsdl
     * @return \SoapClient
     */
    protected function request(string $wsdl, array $body): SoapClient
    {
        return $this->fake ? $this->developmentRequest($body) : $this->productionRequest($wsdl);
    }

    /**
     * @param string $port
     * @return SoapClient
     */
    protected function productionRequest(string $wsdl): SoapClient
    {
        $client = new SoapClient($wsdl, [
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE
        ]);

        return $client;
    }

    protected function developmentRequest(array $data): SoapClient
    {
        $client = new class ($this->errorCode, $this->responseStatus, $data) extends SoapClient {
            protected $errorCode;
            protected $responseStatus;
            protected $fakeData;

            public function __construct($errorCode, $responseStatus, $fakeData)
            {
                $this->errorCode = $errorCode;
                $this->responseStatus = $responseStatus;
                $this->fakeData = $fakeData;
            }

            public function __soapCall($function_name, $arguments, $options = null, $input_headers = null, &$output_headers = null)
            {
                $requestId = random_int(100000000000000, 999999999999999);
                $code = $this->errorCode == '0' ? '0' : '6003';
                
                $response = new \stdClass;
                $response->error = $code;
                $response->original = Response::generateResponse($code, $requestId, $arguments['Input']['wscode']);
                $response->gwtransid = random_int(100000000000000, 999999999999999);
                return $response;
            }
        };

        return $client;
    }


}