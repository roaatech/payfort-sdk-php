<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 6:52 PM
 */

namespace ItvisionSy\PayFort\Operations\Responses;

use ItvisionSy\PayFort\PayfortResponse;

/**
 * @property string $command
 * @property string $access_code
 * @property string $merchant_identifier
 * @property string $merchant_reference
 * @property string $amount
 * @property string $currency
 * @property string $language
 * @property string $customer_email
 * @property string $token_name
 * @property string $signature
 * @property string $fort_id
 * @property string $payment_option
 * @property string $eci
 * @property string $order_description
 * @property string $authorization_code
 * @property string $response_code
 * @property string $customer_ip
 * @property string $customer_name
 * @property string $merchant_extra
 * @property string $merchant_extra1
 * @property string $merchant_extra2
 * @property string $merchant_extra3
 * @property string $merchant_extra4
 * @property string $expiry_date
 * @property string $card_number
 * @property string $status
 * @property string $card_holder_name
 * @property string $3ds_url
 * @property string $remember_me
 * @property string $phone_number
 * @property string $settlement_reference
 * @property string $return_url
 * @property string $response_message
 */
class Purchase extends PayfortResponse
{

    public static function allowedKeys()
    {
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
            "response_message"
        ];
    }

}