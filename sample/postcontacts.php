<?php
/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 19/10/2016
 * Time: 13:12
 */
require_once('autoload.php');

use Swagger\Client\Api\DefaultApi;
use Swagger\Client\ApiClient;
use Swagger\Client\Configuration;

$apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI5YTE2OTcxMC1iMDliLTExZTYtODUyZC00NzljYTFiZWFjYjIiLCJzdWIiOiJTSE9VVE9VVF9BUElfVVNFUiIsImlhdCI6MTQ3OTgwOTMwMywiZXhwIjoxNzk1MzQyMTAzLCJzY29wZXMiOnsiYWN0aXZpdGllcyI6WyJyZWFkIiwid3JpdGUiXSwibWVzc2FnZXMiOlsicmVhZCIsIndyaXRlIl0sImNvbnRhY3RzIjpbInJlYWQiLCJ3cml0ZSJdfSwic29fdXNlcl9pZCI6IjQzIiwic29fdXNlcl9yb2xlIjoidXNlciIsInNvX3Byb2ZpbGUiOiJhbGwiLCJzb191c2VyX25hbWUiOiIiLCJzb19hcGlrZXkiOiJub25lIn0.Q_wmFk3C_Bq2nwjH78ibCL8WJ8Rd_wVieBVmw06UVC0';

$authorization = 'Apikey ' . $apiKey;//Replace <API_KEY> with your API Key
$config = new Configuration();
$config->setDebug(true);
$config->setSSLVerification(false);

$apiClient = new ApiClient($config);

$api_instance = new DefaultApi($apiClient);

$contact = array(
    'mobile_number' => '94778845713',//Required if not specified user_id
    'user_id' => '94778845713',//Optional. if specified, this will be used to generate the contact id, otherwise mobile_number will be used to generate contact id
    //arbitrary attributes
    'email' => 'madura@sqrmobile.com',
    'tags' => ['lead'],
    'name' => 'Madura'
);
$contacts = array($contact);

try {
    $result = $api_instance->contactsPost($authorization, $contacts);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when calling DefaultApi->contactPut: ', $e->getMessage(), PHP_EOL;
}