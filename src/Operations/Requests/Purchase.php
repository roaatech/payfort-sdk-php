<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 4:29 AM
 */

namespace ItvisionSy\PayFort\Operations\Requests;

use ItvisionSy\PayFort\AmountDecimals;
use ItvisionSy\PayFort\ServiceBasedOperation;

/**
 * Class Purchase
 * @package ItvisionSy\PayFort\Operations
 * @property \ItvisionSy\PayFort\Operations\Data\Purchase $data
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
     * @return string
     */
    public function payfortURL()
    {
        return $this->config->sandbox ? "https://sbpaymentservices.payfort.com/FortAPI/paymentApi" : "https://paymentservices.payfort.com/FortAPI/paymentApi";
    }

    protected function overrideRequestData()
    {
        return [
            "amount" => AmountDecimals::forRequest($this->data->amount, $this->data->currency),
        ];
    }

    protected function makeResponse(array $responseData)
    {
        return new \ItvisionSy\PayFort\Operations\Responses\Purchase($responseData);
    }

}
