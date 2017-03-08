<?php
/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 19/10/2016
 * Time: 13:12
 */
require __DIR__ . '/../autoload.php';

use Swagger\Client\Api\DefaultApi;
use Swagger\Client\ApiClient;
use Swagger\Client\Configuration;

$apiKey = 'XXXXXXXXX.XXXXXXXXX.XXXXXXXXX';

$authorization = 'Apikey ' . $apiKey;//Replace <API_KEY> with your API Key
$config = new Configuration();
$config->setDebug(true);
$config->setSSLVerification(false);

$apiClient = new ApiClient($config);

$api_instance = new DefaultApi($apiClient);

$contact = array(
    'mobile_number' => '94777123456',//Required if not specified user_id
    'user_id' => '94777123456',//Optional. if specified, this will be used to generate the contact id, otherwise mobile_number will be used to generate contact id
    //arbitrary attributes
    'email' => 'duke@test.com',
    'tags' => ['lead'],
    'name' => 'Duke'
);
$contacts = array($contact);

try {
    $result = $api_instance->contactsPost($authorization, $contacts);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->contactsPost: ', $e->getMessage(), PHP_EOL;
}