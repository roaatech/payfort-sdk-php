<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/10/17
 * Time: 10:03 AM
 */

namespace ItvisionSy\PayFort;

/**
 * Class Operation
 * @package ItvisionSy\PayFort
 * @property Config $config
 */
abstract class Operation
{

    /**
     * @var Config
     */
    protected $config;

    public function __construct(Config $config = null)
    {
        $this->setConfig($config ?: Config::make([]));
    }

    /**
     * @param Config $config
     */
    protected function setConfig(Config $config)
    {
        $config->validate();
        $this->config = $config;
    }

    /**
     * @param Config|null $set
     * @return Config
     */
    public function config(Config $set = null)
    {
        if ($set) {
            $this->setConfig($set);
        }
        return $this->config;
    }

    /**
     * @return string
     */
    abstract public function command();

    /**
     * @return string
     */
    public function payfortURL()
    {
        return $this->config->sandbox
            ? "https://sbpaymentservices.payfort.com/FortAPI/paymentApi"
            : "https://paymentservices.payfort.com/FortAPI/paymentApi";
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
        trigger_error("Undefined property: " . static::class . ":{$property}", E_USER_NOTICE);
        return null;
    }

}