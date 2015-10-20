<?php
/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 20/10/2015
 * Time: 12:56
 */

namespace ShoutOUT\SDK\Model;

class Content implements \JsonSerializable
{
    private $sms;

    /**
     * Content constructor.
     * @param $sms
     */
    public function __construct($sms)
    {
        $this->sms = $sms;
    }

    /**
     * @return mixed
     */
    public function getSms()
    {
        return $this->sms;
    }

    /**
     * @param mixed $sms
     */
    public function setSms($sms)
    {
        $this->sms = $sms;
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