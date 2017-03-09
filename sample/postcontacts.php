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
    $result = $client->createContacts($contacts);
    print_r($result);
} catch (Exception $e) {
    echo 'Exception when creating contacts ', $e->getMessage(), PHP_EOL;
}