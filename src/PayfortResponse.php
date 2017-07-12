<?php

namespace ItvisionSy\PayFort;

use Exception;
use ItvisionSy\PayFort\Contracts\IDataContainer;
use ItvisionSy\PayFort\Contracts\TDataContainer;

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
class PayfortResponse implements IDataContainer {

    use TDataContainer;

    /**
     * @return PayfortResponseCode
     */
    public function code() {
        return new PayfortResponseCode($this->data['response_code']);
    }

    /**
     * @return PayfortResponseStatus
     */
    public function status() {
        return new PayfortResponseStatus($this->data['status']);
    }

    public function offsetSet($offset, $value) {
        throw new Exception("Readonly array access");
    }

    public function offsetUnset($offset) {
        throw new Exception("Readonly array access");
    }

    public static function allowedKeys() {
        return [
            "command",
            "access_code",
            "merchant_identifier",
            "merchant_reference",
            "amount",
            "currency",
            "language",
            "customer_email",
            "token_name",
            "signature",
            "fort_id",
            "payment_option",
            "eci",
            "order_description",
            "authorization_code",
            "response_code",
            "customer_ip",
            "customer_name",
            "merchant_extra",
            "merchant_extra1",
            "merchant_extra2",
            "merchant_extra3",
            "merchant_extra4",
            "expiry_date",
            "card_number",
            "status",
            "card_holder_name",
            "3ds_url",
            "remember_me",
            "phone_number",
            "settlement_reference",
            "return_url",
            "service_command",
            "card_security_code",
            "response_message",
            "response_code",
            "card_bin"
        ];
    }

    public static function mandatoryFields() {
        return [];
    }

    public static function isKeyAllowed($key) {
        return true;
    }

    protected function filterResponseDataForSignature(array $data) {
        return array_filter($data, function($value, $key) {
            return array_search($key, $this->allowedKeys()) !== false && $key !== "signature";
        }, ARRAY_FILTER_USE_BOTH);
    }

    /**
     *
     * @param \ItvisionSy\PayFort\Config $config
     * @return string
     */
    public function signResponseData(Config $config = null) {
        $dataToSign = $this->filterResponseDataForSignature($this->data());
        $signedData = Signature::forResponse($dataToSign, $config);
        return $signedData["signature"];
    }

    /**
     *
     * @param \ItvisionSy\PayFort\Config $config
     * @return boolean
     */
    public function isResponseAuthentic(Config $config = null) {
        $signed = $this->signResponseData($config);
        $sent = $this->signature;
        return $signed === $sent;
    }

}
