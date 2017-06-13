<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/13/17
 * Time: 11:10 AM
 */

namespace ItvisionSy\PayFort\Operations\Requests;

use ItvisionSy\PayFort\ServiceBasedOperation;

class Capture extends ServiceBasedOperation
{

    /**
     * @return string
     */
    public function command()
    {
        return "CAPTURE";
    }

    /**
     *
     * @param array $responseData
     * @return \ItvisionSy\PayFort\Operations\Responses\Capture
     */
    protected function makeResponse(array $responseData)
    {
        return new \ItvisionSy\PayFort\Operations\Responses\Capture($responseData);
    }

}