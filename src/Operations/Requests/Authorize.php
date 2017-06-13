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
 * Class Authorize
 * @package ItvisionSy\PayFort\Operations
 * @property \ItvisionSy\PayFort\Operations\Data\Authorize $data
 * @method \ItvisionSy\PayFort\Operations\Responses\Authorize execute()
 */
class Authorize extends ServiceBasedOperation
{

    /**
     * @return string
     */
    public function command()
    {
        return "AUTHORIZE";
    }

    /**
     *
     * @param array $responseData
     * @return \ItvisionSy\PayFort\Operations\Responses\Authorize
     */
    protected function makeResponse(array $responseData)
    {
        return new \ItvisionSy\PayFort\Operations\Responses\Authorize($responseData);
    }

}
