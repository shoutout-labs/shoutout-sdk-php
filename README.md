# ShoutOUT SDK for PHP
__version: 1.9.0__

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

require __DIR__ . '/vendor/autoload.php';

$apiKey = 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX';

$authorization = 'Apikey ' . $apiKey;
$config = new Configuration();
$config->setDebug(true);
$config->setSSLVerification(false);

$apiClient = new ApiClient($config);

$api_instance = new DefaultApi($apiClient);
$message = new Message(array(
    'source' => 'ShoutDEMO',
    'destinations' => ['94777123456'],
    'content' => array(
        'sms' => 'Sent via SMS Gateway'
    ),
    'transports' => ['SMS']
));

try {
    echo $message->__toString();
    $result = $api_instance->messagesPost($authorization,$message);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->messagesPost: ', $e->getMessage(), PHP_EOL;
}

?>
```