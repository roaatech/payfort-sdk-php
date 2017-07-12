<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 4:33 AM
 */

namespace ItvisionSy\PayFort\Operations\Data;

use ItvisionSy\PayFort\OperationData;
use ItvisionSy\PayFort\Exceptions\InvalidDataException;

/**
 * Class Purchase
 * @package ItvisionSy\PayFort\OperationData
 *
 * @property string $merchantReference
 * @property string $amount
 * @property string $customerEmail
 * @property string $tokenName
 * @property string $paymentOption
 * @property string $eci
 * @property string $orderDescription
 * @property string $customerIp
 * @property string $customerName
 * @property string $merchantExtra
 * @property string $merchantExtra2
 * @property string $merchantExtra3
 * @property string $merchantExtra4
 * @property boolean $rememberMe
 * @property string $phoneNumber
 * @property string $settlementReference
 * @property string $returnUrl
 * @property string $currency
 * @method string|Purchase merchantReference(string $set = null)
 * @method string|Purchase amount(string $set = null)
 * @method string|Purchase customerEmail(string $set = null)
 * @method string|Purchase tokenName(string $set = null)
 * @method string|Purchase paymentOption(string $set = null)
 * @method string|Purchase eci(string $set = null)
 * @method string|Purchase orderDescription(string $set = null)
 * @method string|Purchase customerIp(string $set = null)
 * @method string|Purchase customerName(string $set = null)
 * @method string|Purchase merchantExtra(string $set = null)
 * @method string|Purchase merchantExtra2(string $set = null)
 * @method string|Purchase merchantExtra3(string $set = null)
 * @method string|Purchase merchantExtra4(string $set = null)
 * @method boolean|Purchase rememberMe(boolean $set = null)
 * @method string|Purchase phoneNumber(string $set = null)
 * @method string|Purchase settlementReference(string $set = null)
 * @method string|Purchase returnUrl(string $set = null)
 * @method string|Purchase currency(string $set = null)
 */
class Purchase extends OperationData {

    public static function optionalFields() {
        return [
            "payment_option",
            "eci",
            "order_description",
            "customer_ip",
            "customer_name",
            "merchant_extra",
            "merchant_extra2",
            "merchant_extra3",
            "merchant_extra4",
            "remember_me",
            "phone_number",
            "settlement_reference",
            "return_url",
            "card_security_code"
        ];
    }

    public static function mandatoryFields() {
        return [
            "merchant_reference",
            "amount",
            "customer_email",
            "token_name",
            "currency"
        ];
    }

    protected function validateRememberMe($value) {
        return !!$value ? "YES" : null;
    }

    protected function validateReturnUrl($value) {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidDataException("Return URL should be URL.");
        }
        return $value;
    }

    protected function validateCustomerEmail($value) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidDataException("Customer email should be a valid email.");
        }
        return $value;
    }

    protected function validatePhoneNumber($value) {
        if (!preg_match("/^\+[0-9]+([\- ][0-9]+)+$/", $value)) {
            throw new InvalidDataException("Phone number should be in the international format.");
        }
        return $value;
    }

}
