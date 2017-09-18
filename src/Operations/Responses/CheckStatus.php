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
 * @property string $query_command
 * @property string $access_code
 * @property string $merchant_identifier
 * @property string $merchant_reference
 * @property string $language
 * @property string $signature
 * @property string $fort_id
 * @property string $response_code
 * @property string $response_message
 * @property string $status
 * @property string $transaction_status
 * @property string $transaction_code
 * @property string $transaction_message
 * @property string $refunded_amount
 * @property string $captured_amount
 * @property string $authorized_amount
 */
class CheckStatus extends PayfortResponse
{

    public static function allowedKeys()
    {
        return [
            "query_command",
            "access_code",
            "merchant_identifier",
            "merchant_reference",
            "language",
            "signature",
            "fort_id",
            "response_code",
            "response_message",
            "status",
            "transaction_status",
            "transaction_code",
            "transaction_message",
            "refunded_amount",
            "captured_amount",
            "authorized_amount",
        ];
    }

}
