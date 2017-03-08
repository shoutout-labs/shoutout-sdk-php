<?php
/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 19/10/2016
 * Time: 15:46
 */
require __DIR__ . '/../autoload.php';

use Swagger\Client\Api\DefaultApi;
use Swagger\Client\ApiClient;
use Swagger\Client\Configuration;

$apiKey = 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX';

$authorization = 'Apikey ' . $apiKey;
$config = new Configuration();
$config->setDebug(true);
$config->setSSLVerification(false);

$apiClient = new ApiClient($config);

$api_instance = new DefaultApi($apiClient);
$activity = array(
    'userId' => '94777123456',//Required. your account id
    //arbitrary attributes
    'activityName' => 'Sample Activity',
    'activityData' => array(
        'param1' => 'val1',
        'param2' => 'val2',
        'param3' => 'val3'
    )
);

try {
    $result = $api_instance->activitiesPost($authorization, $activity);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->contactPut: ', $e->getMessage(), PHP_EOL;
}