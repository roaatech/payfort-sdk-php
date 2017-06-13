<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/13/17
 * Time: 11:10 AM
 */

namespace ItvisionSy\PayFort\Operations\Requests;

use ItvisionSy\PayFort\ServiceBasedOperation;

class VoidAuthorization extends ServiceBasedOperation
{

    /**
     * @return string
     */
    public function command()
    {
        return "VOID_AUTHORIZATION";
    }

    /**
     *
     * @param array $responseData
     * @return \ItvisionSy\PayFort\Operations\Responses\VoidAuthorization
     */
    protected function makeResponse(array $responseData)
    {
        return new \ItvisionSy\PayFort\Operations\Responses\VoidAuthorization($responseData);
    }

    protected function overrideRequestData() {
        return [];
    }

}