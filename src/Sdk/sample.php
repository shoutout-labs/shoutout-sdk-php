<?php
/**
 * Created by IntelliJ IDEA.
 * User: asankanissanka
 * Date: 1/30/16
 * Time: 11:14 AM
 */

require_once './ShoutOUTClient.php';
require_once './Model/Contact.php';

$accessKey = 'ACCESS_KEY';
$secretKey = 'SECRET_KEY';
$apiKey = 'API_KEY';


$client = new \ShoutOUT\SDK\ShoutOUTClient($accessKey,$secretKey,$apiKey);


/* Create or Update Existing Contact */
$contact = array('mobile_number' => array('s' => '94718121914'), 'user_id' => array('s' => 'A000001'),'name'=>array('s'=>'Chanaka'));

$contactPutResp = $client->contactsPut($contact);

echo $contactPutResp->getHttpStatus();
echo "\r\n";
echo $contactPutResp->getResponse();
echo "\r\n";

/* Record Activity */
$activityRecord = array('mobile_number' => '94718121914', 'user_id' => 'A000001','activity_name'=>'Collect Points','activity_data'=>array('bill'=>'2400','ref'=>'I001'));

$activityRecordPostResp = $client->activitiesRecordsPost($activityRecord);

echo $activityRecordPostResp->getHttpStatus();
echo "\r\n";
echo $activityRecordPostResp->getResponse();
echo "\r\n";

/* Get Contact List */
$contactListResp = $client->contactsListGet();

echo $contactListResp->getHttpStatus();
echo "\r\n";
echo $contactListResp->getResponse();
echo "\r\n";