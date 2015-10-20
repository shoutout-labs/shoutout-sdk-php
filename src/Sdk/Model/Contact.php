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
    private $msisdn;
    private $group_ids;

    /**
     * Contact constructor.
     * @param $msisdn
     * @param $group_ids
     */
    public function __construct($msisdn, $group_id)
    {
        $this->msisdn = $msisdn;
        $this->group_ids = array($group_id);
    }

    /**
     * @return mixed
     */
    public function getMsisdn()
    {
        return $this->msisdn;
    }

    /**
     * @param mixed $msisdn
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = $msisdn;
    }

    /**
     * @return mixed
     */
    public function getGroupIds()
    {
        return $this->group_ids;
    }

    /**
     * @param mixed $group_ids
     */
    public function setGroupIds($group_ids)
    {
        $this->group_ids = $group_ids;
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