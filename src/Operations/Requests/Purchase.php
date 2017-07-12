<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 4:29 AM
 */

namespace ItvisionSy\PayFort\Operations\Requests;

use ItvisionSy\PayFort\ServiceBasedOperation;

/**
 * Class Purchase
 * @package ItvisionSy\PayFort\Operations
 * @property \ItvisionSy\PayFort\Operations\Data\Purchase $data
 * @method \ItvisionSy\PayFort\Operations\Responses\Purchase execute()
 */
class Purchase extends ServiceBasedOperation
{

    /**
     * @return string
     */
    public function command()
    {
        return "PURCHASE";
    }

    /**
     *
     * @param array $responseData
     * @return \ItvisionSy\PayFort\Operations\Responses\Purchase
     */
    protected function makeResponse(array $responseData)
    {
        return new \ItvisionSy\PayFort\Operations\Responses\Purchase($responseData);
    }

}
