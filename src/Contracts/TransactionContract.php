<?php

namespace Bluteki\Sdk\Contracts;

interface TransactionContract {

    /**
     * Construct transaction from mpesa api.
     *
     * @param array $response
     */
    public function __construct(array $response);

    /**
     * Convert the model instance to an array
     * 
     * @return array
     */
    public function toArray(): array;

    
}