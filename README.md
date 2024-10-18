# MPESA DEPENDENCY 

Dependency for consumption of the Emola WebService 

## Installation

To install this dependency, just run the command below:
```shell
composer require blutekic/emola-sdk
```

## Usage

To use this manager, just follow the example below:

### C2B
```php
<?php

require __DIR__.'/../../vendor/autoload.php';

use \Bluteki\Sdk\Emola;

// configuring api access credentials
Emola::config(
    'Emola WSDL',
    'Your Username',
    'Your Password',
    'You Key',
    'Partner Code',
    'Language (pt | en)'
);

$transactionID = strtoupper(bin2hex(random_bytes(8)));
$transactionReference = strtoupper(bin2hex(random_bytes(8)));
$response = Emola::c2b( 10, '877777777', $transactionID, $transactionReference, 'SMS CONTENT WITHOUT AMOUNT');

echo '<pre>';
print_r($response->toArray());
```

### B2C
```php
<?php

require __DIR__.'/../../vendor/autoload.php';

use \Bluteki\Sdk\Mpesa;

// configuring api access credentials
Emola::config(
    'Emola WSDL',
    'Your Username',
    'Your Password',
    'You Key',
    'Partner Code',
    'Language (pt | en)'
);
$transactionID = strtoupper(bin2hex(random_bytes(8)));
$transactionReference = strtoupper(bin2hex(random_bytes(8)));
$response = Emola::b2c( 10, '877777777', $transactionID, 'SMS CONTENT');

echo '<pre>';
print_r($response->toArray());
```

### FAKE TRANSACTIONS (C2B & B2C)
```php
<?php

require __DIR__.'/../../vendor/autoload.php';

use \Bluteki\Sdk\Mpesa;

// configuring api access credentials
Emola::config(
    'Emola WSDL',
    'Your Username',
    'Your Password',
    'You Key',
    'Partner Code',
    'Language (pt | en)'
);

Emola::setFake();

$transactionID = strtoupper(bin2hex(random_bytes(8)));
$transactionReference = strtoupper(bin2hex(random_bytes(8)));

// start c2b fake transaction
$response = Emola::c2b( 10, '877777777', $transactionID, $transactionReference, 'SMS CONTENT WITHOUT AMOUNT');

// start b2c fake transaction
$response = Emola::b2c( 10, '877777777', $transactionID, 'SMS CONTENT');

echo '<pre>';
print_r($response->toArray());
```

## Requirements
- PHP 8.0 or higher required