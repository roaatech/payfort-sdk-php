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
 * Class Refund
 * @package ItvisionSy\PayFort\Operations\Data
 */
class Refund extends OperationData
{

    public static function mandatoryFields()
    {
        return [];
    }

    public static function optionalFields()
    {
        return [];
    }
}