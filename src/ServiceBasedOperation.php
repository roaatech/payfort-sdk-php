<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 12:12 PM
 */

namespace ItvisionSy\PayFort;

use ItvisionSy\PayFort\AmountDecimals;

/**
 * Class ServiceBasedOperation
 * @package ItvisionSy\PayFort
 * @property OperationData $data;
 */
abstract class ServiceBasedOperation extends Operation
{

    /**
     * @var OperationData
     */
    protected $data;
    //allow access to data property
    protected static $public = ['data'];

    public function __construct(OperationData $data, Config $config = null)
    {
        parent::__construct($config);
        $this->setData($data);
    }

    protected function setData(OperationData $data)
    {
        $data->validate();
        $this->data = $data;
    }

    protected function invokeApi(array $data)
    {
        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0");
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json;charset=UTF-8',
        ]);
        curl_setopt($ch, CURLOPT_URL, $this->payfortURL()); //set the URL
        curl_setopt($ch, CURLOPT_POST, 1); //is a POST request
        curl_setopt($ch, CURLOPT_FAILONERROR, 1); //stop on error
        curl_setopt($ch, CURLOPT_ENCODING, "compress, gzip"); //compress the request
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, !$this->config->sandbox); //ssl verification on env type
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //get the response into a variable
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // allow redirects
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0); // The number of seconds to wait while trying to connect
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data)); //the payload
        //execute the request
        $response = curl_exec($ch);

        //close the connection
        curl_close($ch);

        //parse the response
        $responseData = json_decode($response, true);

        //on empty response, throw an error
        if (!$response || empty($responseData)) {
            throw new Exceptions\InvalidResponseException("Invalid response structure");
        }

        //returned parsed data
        return $responseData;
    }

    protected function finalRequestData()
    {
        $data = $this->overrideRequestData();
        $data += ["command" => $this->command()];
        $data += $this->data->data();
        $data += Common::payfortEntries($this->config);
        return $data;
    }

    /**
     * The logic of the operation
     * @return mixed
     */
    public function execute()
    {
        $responseData = $this->invokeApi($this->sign());
        return $this->makeResponse($responseData);
    }

    public function sign()
    {
        return Signature::forRequest($this->finalRequestData(), $this->config);
    }

    /**
     *
     * @param array $responseData
     * @return PayfortResponse
     */
    protected function makeResponse(array $responseData)
    {
        return new PayfortResponse($responseData);
    }

    /**
     * @return string
     */
    public function payfortURL()
    {
        return $this->config->sandbox ? "https://sbpaymentservices.payfort.com/FortAPI/paymentApi" : "https://paymentservices.payfort.com/FortAPI/paymentApi";
    }

    /**
     *
     * @return array
     */
    protected function overrideRequestData()
    {
        return [
            "amount" => AmountDecimals::forRequest($this->data->amount, $this->data->currency),
        ];
    }

}
