<?php

/**
 * Created by IntelliJ IDEA.
 * User: Madura
 * Date: 20/10/2015
 * Time: 12:46
 */
namespace ShoutOUT\SDK\Model;
require_once ('Content.php');

class Message implements \JsonSerializable
{
    private $source;
    private $destinations;
    private $transport;
    private $content;

    /**
     * Message constructor.
     * @param $source sender id
     * @param $destinations array of contacts
     * @param $content message content
     */
    public function __construct($source, $destinations, $content)
    {
        $this->source = $source;
        $this->destinations = $destinations;
        $this->content = new Content($content);
        $this->transport=array('SMS');
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getDestinations()
    {
        return $this->destinations;
    }

    /**
     * @param mixed $destinations
     */
    public function setDestinations($destinations)
    {
        $this->destinations = $destinations;
    }

    /**
     * @return mixed
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param mixed $source
     */
    public function setSource($source)
    {
        $this->source = $source;
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