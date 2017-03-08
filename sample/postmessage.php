<?php
/**
 * Created by IntelliJ IDEA.
 * User: asankanissanka
 * Date: 6/6/16
 * Time: 9:34 PM
 */
require __DIR__ . '/../autoload.php';

use Swagger\Client\Api\DefaultApi;
use Swagger\Client\ApiClient;
use Swagger\Client\Configuration;
use Swagger\Client\Model\Message;

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