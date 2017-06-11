<?php

namespace ItvisionSy\PayFort;

/**
 * Class Response
 * @package ItvisionSy\PayFort\Response
 *
 * @property string service_command
 * @property string access_code
 * @property string merchant_identifier
 * @property string merchant_reference
 * @property string language
 * @property string expiry_date
 * @property string card_number
 * @property string signature
 * @property string token_name
 * @property string response_message
 * @property string status
 * @property string card_bin
 * @property string card_holder_name
 * @property string remember_me
 * @property string return_url
 * @property string command
 * @property string amount
 * @property string currency
 * @property string customer_email
 * @property string fort_id
 * @property string payment_option
 * @property string eci
 * @property string order_description
 * @property string authorization_code
 * @property string customer_ip
 * @property string customer_name
 * @property string merchant_extra
 * @property string merchant_extra1
 * @property string merchant_extra2
 * @property string merchant_extra3
 * @property string merchant_extra4
 * @property string 3ds_url
 * @property string phone_number
 * @property string settlement_reference
 */
class PayfortResponse
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
        return array_key_exists($name, $this->data) ? $this->data[$name] : null;
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

}