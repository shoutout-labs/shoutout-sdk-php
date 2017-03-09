<?php
/**
 * Created by IntelliJ IDEA.
 * User: asankanissanka
 * Date: 6/6/16
 * Time: 9:34 PM
 */
require __DIR__ . '/../autoload.php';

use Swagger\Client\ShoutoutClient;

$apiKey = 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX';

$client = new ShoutoutClient($apiKey,true,false);


$message = array(
    'source' => 'ShoutDEMO',
    'destinations' => ['94777123456'],
    'content' => array(
        'sms' => 'Sent via SMS Gateway'
    ),
    'transports' => ['SMS']
);

try {
    $result = $client->sendMessage($message);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when sending message: ', $e->getMessage(), PHP_EOL;
}