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
    $result = $client->createActivity($activity);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when creating activity ', $e->getMessage(), PHP_EOL;
}