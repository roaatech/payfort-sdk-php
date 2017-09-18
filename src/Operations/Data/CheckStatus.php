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
 * Class CheckStatus
 * @package ItvisionSy\PayFort\Operations\Data
 * @property string $merchant_reference
 * @property string $fort_id
 * @method string|CheckStatus merchant_reference(string $set=null)
 * @method string|CheckStatus fort_id(string $set=null)
 */
class CheckStatus extends OperationData {

    public static function mandatoryFields() {
        return [
            "merchant_reference",
        ];
    }

    public static function optionalFields() {
        return [
            "fort_id",
        ];
    }

}
