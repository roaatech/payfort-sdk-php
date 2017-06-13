<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/13/17
 * Time: 11:10 AM
 */

namespace ItvisionSy\PayFort\Operations\Data;

use ItvisionSy\PayFort\OperationData;

/**
 * Class Capture
 * @package ItvisionSy\PayFort\Operations\Data
 * @property string $merchant_reference
 * @property string $amount
 * @property string $currency
 * @property string $fort_id
 * @property string $order_description
 * @method string|Capture merchant_reference(string $set=null)
 * @method string|Capture amount(string $set=null)
 * @method string|Capture currency(string $set=null)
 * @method string|Capture fort_id(string $set=null)
 * @method string|Capture order_description(string $set=null)
 */
class Capture extends OperationData {

    public static function mandatoryFields() {
        return [
            "merchant_reference",
            "amount",
            "currency"
        ];
    }

    public static function optionalFields() {
        return [
            "fort_id",
            "order_description"
        ];
    }

}
