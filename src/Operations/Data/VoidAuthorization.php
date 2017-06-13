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
 * Class Void
 * @package ItvisionSy\PayFort\Operations\Data
 * @property string $merchant_reference
 * @property string $fort_id
 * @property string $order_description
 * @method string|VoidAuthorization merchant_reference(string $set=null)
 * @method string|VoidAuthorization fort_id(string $set=null)
 * @method string|VoidAuthorization order_description(string $set=null)
 */
class VoidAuthorization extends OperationData {

    public static function mandatoryFields() {
        return [
            "merchant_reference",
        ];
    }

    public static function optionalFields() {
        return [
            "fort_id",
            "order_description"
        ];
    }

}
