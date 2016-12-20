# ShoutOUT SDK for PHP
__version: 1.0.0__

## Requirements

PHP 5.4.0 and later

## Installation

You can install **shoutout-sdk** via composer or by downloading the source

#### Via Composer

**shoutout-sdk** is available on Packagist as the
[`shoutoutlabs/shoutout-sdk`](https://packagist.org/packages/shoutoutlabs/shoutout-sdk) package

```sh
composer require shoutoutlabs/shoutout-sdk
```

## Getting Started

Please follow the [installation Procedure](#installation) and then run the following:

#### Send Message

```php
<?php

$apiKey = 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX';

$config = Swagger\Client\Configuration::getDefaultConfiguration();
$config->setApiKey('Authorization',$apiKey);
$config->setApiKeyPrefix('Authorization', 'Apikey');
$config->setSSLVerification(false);

$apiInstance = new Swagger\Client\Api\DefaultApi();

$message = new Swagger\Client\Model\Message(array(
    'source' => 'ShoutDEMO',
    'destinations' => ['94XXXXXXXXX'],
    'content' => array(
        'sms' => 'Sent via ShoutOUT Lite'
    ),
    'transports' => ['SMS']
));

$result = $apiInstance->messagesPost($message,$config);

?>
```



