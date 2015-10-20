<?php

/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 20/10/2015
 * Time: 12:23
 */
namespace ShoutOUT\SDK\Model;
class Response implements \JsonSerializable
{
    private $httpStatus;
    private $response;

    /**
     * Response constructor.
     * @param $httpStatus
     * @param $response
     */
    public function __construct($httpStatus, $response)
    {
        $this->httpStatus = $httpStatus;
        $this->response = $response;
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }



    /**
     * @return mixed
     */
    public function getHttpStatus()
    {
        return $this->httpStatus;
    }


    /**
     * (PHP 5 &gt;= 5.4.0)<br/>
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     */
    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}