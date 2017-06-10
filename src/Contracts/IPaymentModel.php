<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/10/17
 * Time: 2:48 PM
 */

namespace ItvisionSy\PayFort\Contracts;

interface IPaymentModel
{

    public function reference();

    public function amount();

    public function currency();

    public function userId();

}