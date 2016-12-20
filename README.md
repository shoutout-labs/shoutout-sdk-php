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

```php
<?php
require_once(__DIR__ . '/vendor/autoload.php');

// Configure API key authorization: ShoutOUTCustomAuthorizer
Swagger\Client\Configuration::getDefaultConfiguration()->setApiKey('Authorization', 'YOUR_API_KEY');
// Uncomment below to setup prefix (e.g. Bearer) for API key, if needed
// Swagger\Client\Configuration::getDefaultConfiguration()->setApiKeyPrefix('Authorization', 'Bearer');

$api_instance = new Swagger\Client\Api\DefaultApi();
$activity = new \Swagger\Client\Model\Activity(); // \Swagger\Client\Model\Activity | 
$authorization = "authorization_example"; // string | 

try {
    $result = $api_instance->activitiesPost($activity, $authorization);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->activitiesPost: ', $e->getMessage(), PHP_EOL;
}

?>
```



