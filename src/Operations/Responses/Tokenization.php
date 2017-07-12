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
 * @property string service_command
 * @property string access_code
 * @property string merchant_identifier
 * @property string merchant_reference
 * @property string language
 * @property string expiry_date
 * @property string card_number
 * @property string card_security_code
 * @property string signature
 * @property string token_name
 * @property string card_holder_name
 * @property string remember_me
 * @property string response_message
 * @property string status
 * @property string card_bin
 * @property string return_url
 */
class Tokenization extends PayfortResponse
{

    public static function allowedKeys()
    {
        return [
            "service_command",
            "access_code",
            "merchant_identifier",
            "merchant_reference",
            "language",
            "expiry_date",
            "card_number",
            "card_security_code",
            "signature",
            "token_name",
            "card_holder_name",
            "remember_me",
            "response_code",
            "response_message",
            "status",
            "card_bin",
            "return_url",
        ];
    }

}
