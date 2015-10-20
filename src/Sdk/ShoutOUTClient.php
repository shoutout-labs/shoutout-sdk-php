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
        $this->signService = new  SignRequest($accessKey, $secretKey);
        $this->apikey = $apikey;
        $host = "lwel2lpoy3.execute-api.us-east-1.amazonaws.com";
        $this->stage="sandbox";
        $this->baseUrl = "https://$host";
        $this->headers = array("host" => $host, "x-api-key" => $this->apikey, 'Content-Type' => 'application/json');
    }
    /**
     * ShoutOUTClient post a to a group.
     * @param $contact Contact object
     * @return Response object
     */
    public function contactsPost($contact)
    {
        return $this->submit("POST", "/$this->stage/contacts", json_encode($contact));

    }

    /**
     * ShoutOUTClient post a message to one or more numbers.
     * @param $message Message object
     * @return Response object
     */
    public function messagesPost($message)
    {
        return $this->submit("POST", "/$this->stage/messages",json_encode($message));

    }

    /**
     * ShoutOUTClient create a group.
     * @param $group Group object
     * @return Response object
     */
    public function groupsPost($group){
        return $this->submit("POST", "/$this->stage/groups",json_encode($group));
    }

    private function submit($method, $url, $body)
    {
        $headerList = $this->signService->calculateSignature($method, $url, $body, $this->headers, array());
        $headers = array();
        foreach ($headerList as $k => $v) {
            $headers[] = $k . ': ' . $v;
        }
        $headers[] = 'Content-Length:' . strlen($body);
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
}