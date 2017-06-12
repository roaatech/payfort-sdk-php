<?php

namespace ItvisionSy\PayFort;

use Exception;

/**
 * Class Response
 * @package ItvisionSy\PayFort\Response
 * @property string command
 * @property string access_code
 * @property string merchant_identifier
 * @property string merchant_reference
 * @property string amount
 * @property string currency
 * @property string language
 * @property string customer_email
 * @property string token_name
 * @property string signature
 * @property string fort_id
 * @property string payment_option
 * @property string eci
 * @property string order_description
 * @property string authorization_code
 * @property string response_code
 * @property string customer_ip
 * @property string customer_name
 * @property string merchant_extra
 * @property string merchant_extra1
 * @property string merchant_extra2
 * @property string merchant_extra3
 * @property string merchant_extra4
 * @property string expiry_date
 * @property string card_number
 * @property string status
 * @property string card_holder_name
 * @property string 3ds_url
 * @property string remember_me
 * @property string phone_number
 * @property string settlement_reference
 * @property string return_url
 * @property string service_command
 * @property string card_security_code
 * @property string response_message
 * @property string card_bin
 */
class PayfortResponse implements \ArrayAccess, \IteratorAggregate, \JsonSerializable, \Countable
{

    /**
     * @var array
     */
    protected $data;

    /**
     * PayfortResponse constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->offsetExists($name) ? $this->offsetGet($name) : null;
    }

    /**
     * @return PayfortResponseCode
     */
    public function code()
    {
        return new PayfortResponseCode($this->data['response_code']);
    }

    /**
     * @return PayfortResponseStatus
     */
    public function status()
    {
        return new PayfortResponseStatus($this->data['status']);
    }

    /**
     *
     * @return array
     */
    public function raw(){
        return $this->data;
    }

    public function count() {
        return count($this->data);
    }

    public function getIterator() {
        return new \ArrayIterator($this->data);
    }

    public function jsonSerialize() {
        return json_encode($this->data);
    }

    public function offsetExists($offset) {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset) {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value) {
        throw new Exception("Readonly array access");
    }

    public function offsetUnset($offset) {
        throw new Exception("Readonly array access");
    }

}