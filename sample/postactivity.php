<?php
/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 19/10/2016
 * Time: 15:46
 */
require_once('autoload.php');

use Swagger\Client\Api\DefaultApi;
use Swagger\Client\ApiClient;
use Swagger\Client\Configuration;

$apiKey = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJqdGkiOiI5YTE2OTcxMC1iMDliLTExZTYtODUyZC00NzljYTFiZWFjYjIiLCJzdWIiOiJTSE9VVE9VVF9BUElfVVNFUiIsImlhdCI6MTQ3OTgwOTMwMywiZXhwIjoxNzk1MzQyMTAzLCJzY29wZXMiOnsiYWN0aXZpdGllcyI6WyJyZWFkIiwid3JpdGUiXSwibWVzc2FnZXMiOlsicmVhZCIsIndyaXRlIl0sImNvbnRhY3RzIjpbInJlYWQiLCJ3cml0ZSJdfSwic29fdXNlcl9pZCI6IjQzIiwic29fdXNlcl9yb2xlIjoidXNlciIsInNvX3Byb2ZpbGUiOiJhbGwiLCJzb191c2VyX25hbWUiOiIiLCJzb19hcGlrZXkiOiJub25lIn0.Q_wmFk3C_Bq2nwjH78ibCL8WJ8Rd_wVieBVmw06UVC0';

$authorization = 'Apikey ' . $apiKey;
$config = new Configuration();
$config->setDebug(true);
$config->setSSLVerification(false);

$apiClient = new ApiClient($config);

$api_instance = new DefaultApi($apiClient);
$activity = array(
    'userId' => 'T001',//Required. your account id
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