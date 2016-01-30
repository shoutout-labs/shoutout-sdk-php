<?php
/**
 * Created by IntelliJ IDEA.
 * User: asankanissanka
 * Date: 1/30/16
 * Time: 11:14 AM
 */

require_once './ShoutOUTClient.php';
require_once './Model/Contact.php';


$client = new \ShoutOUT\SDK\ShoutOUTClient('AKIAIX4Z42EJFBN3GUCA', '0Miwpi3HIxwURgWV/VzYDeDZk+Yr3AGjABoYjXP+', 'DaEa0439CJ5FRa5ImeeR52R1e1JAyexF8sx8w38H');

$contact = array('mobile_number' => array('s' => '94777359997'), 'user_id' => array('s' => 'A000001'),'name'=>array('s'=>'Chanaka'));

$contactPutResp = $client->contactsPut($contact);

echo $contactPutResp->getHttpStatus();
echo $contactPutResp->getResponse();