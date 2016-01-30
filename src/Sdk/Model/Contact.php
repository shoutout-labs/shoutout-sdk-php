<?php
/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 20/10/2015
 * Time: 14:41
 */

namespace ShoutOUT\SDK\Model;


class Contact implements \JsonSerializable
{
    private $mobile_number;
    private $user_id;

    /**
     * Contact constructor.
     * @param $mobile_number
     * @param $group_ids
     */
    public function __construct($mobile_number, $user_id)
    {
        $this->mobile_number = $mobile_number;
        $this->user_id = array($user_id);
    }

    /**
     * @return mixed
     */
    public function getMobilenumber()
    {
        return $this->mobile_number;
    }

    /**
     * @param mixed $mobile_number
     */
    public function setMobilenumber($mobile_number)
    {
        $this->mobile_number = $mobile_number;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->user_id;
    }

    /**
     * @param mixed $user_id
     */
    public function setUserid($user_id)
    {
        $this->user_id = $user_id;
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