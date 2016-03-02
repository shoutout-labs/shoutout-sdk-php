<?php

require_once './ShoutOUTClient.php';
require_once './Model/Message.php';

$accessKey = 'ACCESS_KEY';
$secretKey = 'SECRET_KEY';
$apiKey = 'API_KEY';


$client = new \ShoutOUT\SDK\ShoutOUTClient($accessKey, $secretKey, $apiKey);


/* Create or Update Existing Contact */
$contact = array('mobile_number' => array('s' => '94715121914'), 'user_id' => array('s' => 'A000001'), 'name' => array('s' => 'John'));

$contactPutResp = $client->contactsPut($contact);

echo $contactPutResp->getHttpStatus();
echo "\r\n";
echo $contactPutResp->getResponse();
echo "\r\n";

/* Record Activity */
$activityRecord = array('user_id' => 'A000001', 'mobile_number' => '94715121914', 'activity_name' => 'Collect Points', 'activity_data' => array('bill' => '200', 'ref' => 'I001'));

$activityRecordPostResp = $client->activitiesRecordsPost($activityRecord);

echo $activityRecordPostResp->getHttpStatus();
echo "\r\n";
echo $activityRecordPostResp->getResponse();
echo "\r\n";

/* Record Activity - Redeem Points */
$activityRedeemRecord = array('user_id' => 'A000001', 'activity_id' => '623ab314fb8ffd56785966185f4762c87adab34e','activity_name' => 'Redeem Points', 'activity_data' => array('points' => 5));

$activityRecordPostResp = $client->activitiesRecordsPost($activityRedeemRecord);

echo $activityRecordPostResp->getHttpStatus();
echo "\r\n";
echo $activityRecordPostResp->getResponse();
echo "\r\n";

/* Get Contact - Using User ID */
$contactGetResp = $client->contactsGet(null, "A000001",null);

echo $contactGetResp->getHttpStatus();
echo "\r\n";
echo $contactGetResp->getResponse();
echo "\r\n";

/* Get Contact List */
$contactListResp = $client->contactsListGet();

echo $contactListResp->getHttpStatus();
echo "\r\n";
echo $contactListResp->getResponse();
echo "\r\n";

/* Send Message */
$message = new \ShoutOUT\SDK\Model\Message('QMEDS',['94715121914'],'Sent via SMS Gateway');

$messagesPostResp = $client->messagesPost($message);

echo $messagesPostResp->getHttpStatus();
echo "\r\n";
echo $messagesPostResp->getResponse();
echo "\r\n";