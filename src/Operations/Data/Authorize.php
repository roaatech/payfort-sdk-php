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
 * Class Authorize
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
 * @method string|Authorize merchantReference(string $set = null)
 * @method string|Authorize amount(string $set = null)
 * @method string|Authorize customerEmail(string $set = null)
 * @method string|Authorize tokenName(string $set = null)
 * @method string|Authorize paymentOption(string $set = null)
 * @method string|Authorize eci(string $set = null)
 * @method string|Authorize orderDescription(string $set = null)
 * @method string|Authorize customerIp(string $set = null)
 * @method string|Authorize customerName(string $set = null)
 * @method string|Authorize merchantExtra(string $set = null)
 * @method string|Authorize merchantExtra2(string $set = null)
 * @method string|Authorize merchantExtra3(string $set = null)
 * @method string|Authorize merchantExtra4(string $set = null)
 * @method boolean|Authorize rememberMe(boolean $set = null)
 * @method string|Authorize phoneNumber(string $set = null)
 * @method string|Authorize settlementReference(string $set = null)
 * @method string|Authorize returnUrl(string $set = null)
 * @method string|Authorize currency(string $set = null)
 */
class Authorize extends OperationData
{

    protected static $optionalFields = [
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
    protected static $mandatoryFields = [
        "merchant_reference",
        "amount",
        "customer_email",
        "token_name",
        "currency"
    ];

    protected function validateRememberMe($value)
    {
        return !!$value;
    }

    protected function validateReturnUrl($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_URL)) {
            throw new InvalidDataException("Return URL should be URL.");
        }
        return $value;
    }

    protected function validateCustomerEmail($value)
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidDataException("Customer email should be a valid email.");
        }
        return $value;
    }

    protected function validatePhoneNumber($value)
    {
        if (!preg_match("/^\+[0-9]+([\- ][0-9]+)+$/", $value)) {
            throw new InvalidDataException("Phone number should be in the international format.");
        }
        return $value;
    }

}