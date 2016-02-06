<?php

/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 19/10/2015
 * Time: 19:14
 */
namespace ShoutOUT\SDK;

use ShoutOUT\SDK\Model\Response;

require_once './SignRequest.php';
require_once './Model/Response.php';

class ShoutOUTClient
{
    private $signService;
    private $apikey;
    private $headers;
    private $baseUrl;
    private $stage;

    /**
     * ShoutOUTClient constructor.
     * @param $accessKey your access key
     * @param $secretKey your secret key
     * @param $apikey your api key
     */

    public function __construct($accessKey, $secretKey, $apikey)
    {
        $this->signService = new SignRequest($accessKey, $secretKey);
        $this->apikey = $apikey;
        $host = "lwel2lpoy3.execute-api.us-east-1.amazonaws.com";
        $this->stage = "v6";
        $this->baseUrl = "https://$host";
        $this->headers = array("host" => $host, "x-api-key" => $this->apikey, 'Content-Type' => 'application/json');
    }

    /**
     * ShoutOUTClient Create a new contact or replace existing one.
     * @param $contact Contact object
     * @return Response object
     */
    public function contactsPost($contact)
    {
        return $this->submit("POST", "/$this->stage/contacts", json_encode($contact));

    }

    /**
     * ShoutOUTClient Get contact.
     * @param $user_id
     * @param $mobile_number
     * @param $id
     * @return Contact object
     */
    public function contactsGet($id, $user_id, $mobile_number)
    {
        $query = array("id" => $id, "user_id" => $user_id, "mobile_number" => $mobile_number);
        return $this->submit("GET", "/$this->stage/contacts", null, $query);
    }

    /**
     * ShoutOUTClient Get contact list.
     * @return ContactList object
     */
    public function contactsListGet()
    {
        return $this->submit("GET", "/$this->stage/contacts/list", null);

    }

    /**
     * ShoutOUTClient Create a new contact or update existing one.
     * @param $contact Contact object
     * @return Response object
     */
    public function contactsPut($contact)
    {
        return $this->submit("PUT", "/$this->stage/contacts", json_encode($contact));

    }

    /**
     * ShoutOUTClient post a to a group.
     * @param $activityRecord ActivityRecord object
     * @return Response object
     */
    public function activitiesRecordsPost($activityRecord)
    {
        return $this->submit("POST", "/$this->stage/activities/records", json_encode($activityRecord));

    }

    private function submit($method, $url, $body, $query = array())
    {
        $headerList = $this->signService->calculateSignature($method, $url, $body, $this->headers,$query);
        $headers = array();
        foreach ($headerList as $k => $v) {
            $headers[] = $k . ': ' . $v;
        }
        $headers[] = 'Content-Length:' . strlen($body);
        if(!empty($query)){
            $canonQuery = $this->getCanonicalizedQuery($query);
            $url = $url."?".$canonQuery;
        }
        $ch = curl_init($this->baseUrl . $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_HEADER, true);
        //curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($ch);

        if ($result === FALSE) {
            //     printf("cUrl error (#%d): %s<br>\n", curl_errno($ch),
            //        htmlspecialchars(curl_error($ch)));
        }
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $body = substr($result, $header_size);
        // echo 'HTTP code: ' . $httpcode;
        //rewind($verbose);
        ///$verboseLog = stream_get_contents($verbose);

        // echo "Verbose information:\n<pre>", htmlspecialchars($verboseLog), "</pre>\n";
        curl_close($ch);
        return new Response($httpcode, $body);
    }

    private function getCanonicalizedQuery(array $query)
    {
        unset($query['X-Amz-Signature']);

        if (!$query) {
            return '';
        }

        $qs = '';
        ksort($query);
        foreach ($query as $k => $v) {
            if (!is_array($v)) {
                $qs .= rawurlencode($k) . '=' . rawurlencode($v) . '&';
            } else {
                sort($v);
                foreach ($v as $value) {
                    $qs .= rawurlencode($k) . '=' . rawurlencode($value) . '&';
                }
            }
        }
        return substr($qs, 0, -1);
    }
}