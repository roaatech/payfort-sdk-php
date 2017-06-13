<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/13/17
 * Time: 11:10 AM
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
 * @property string $signature
 * @property string $fort_id
 * @property string $order_description
 * @property string $response_code
 * @property string $response_message
 * @property string $status
 */
class VoidAuthorization extends PayfortResponse {

    public static function allowedKeys() {
        return [
            "command",
            "access_code",
            "merchant_identifier",
            "merchant_reference",
            "language",
            "signature",
            "fort_id",
            "order_description",
            "response_code",
            "response_message",
            "status",
        ];
    }

}
