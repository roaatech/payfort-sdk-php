<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 4:29 AM
 */

namespace ItvisionSy\PayFort\Operations\Requests;

use ItvisionSy\PayFort\AmountDecimals;
use ItvisionSy\PayFort\Common;
use ItvisionSy\PayFort\ServiceBasedOperation;
use ItvisionSy\PayFort\Signature;

/**
 * Class Purchase
 * @package ItvisionSy\PayFort\Operations
 * @property \ItvisionSy\PayFort\OperationData\Purchase $data
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
        return $this->config->sandbox
            ? "https://sbpaymentservices.payfort.com/FortAPI/paymentApi"
            : "https://paymentservices.payfort.com/FortAPI/paymentApi";
    }

    public function execute()
    {
        $data = $this->sign();
        $result = $this->invokeApi($data);
        json($result);
        return $result;
    }

    public function sign()
    {
        $data = [
                "amount" => AmountDecimals::forRequest($this->data->amount, $this->data->currency),
                "command" => $this->command()
            ] + $this->data->data() + Common::payfortEntries($this->config);
        $data = Signature::forRequest($data, $this->config);
        dd($data);
        return $data;
    }

}