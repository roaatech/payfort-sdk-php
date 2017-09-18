<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/13/17
 * Time: 11:10 AM
 */

namespace ItvisionSy\PayFort\Operations\Requests;

use ItvisionSy\PayFort\Common;
use ItvisionSy\PayFort\ServiceBasedOperation;

class CheckStatus extends ServiceBasedOperation
{

    /**
     * @return string
     */
    public function command()
    {
        return "CHECK_STATUS";
    }

    /**
     *
     * @param array $responseData
     * @return \ItvisionSy\PayFort\Operations\Responses\CheckStatus
     */
    protected function makeResponse(array $responseData)
    {
        return new \ItvisionSy\PayFort\Operations\Responses\CheckStatus($responseData);
    }

    protected function finalRequestData()
    {
        $data = ["query_command" => $this->command()];
        $data += $this->data->data();
        $data += Common::payfortEntries($this->config);
        return $data;
    }

}