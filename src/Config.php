<?php

namespace ItvisionSy\PayFort;

use Exception;
use ItvisionSy\PayFort;

/**
 * Class Config
 * @package ItvisionSy\Payment\PayFort
 */
class Config
{

    CONST //sha constants
        SHA_TYPE_SHA128 = 'sha1',
        SHA_TYPE_SHA256 = 'sha256',
        SHA_TYPE_SHA512 = 'sha512';
    const //language constants
        LANG_EN = 'en',
        LANG_AR = 'ar';

    /**
     * Default config
     * @var array
     */
    protected static $defaults = [
        'sandbox' => false,
        'merchant_identifier' => null,
        'access_code' => null,
        'language' => self::LANG_EN,
        'sha_type' => self::SHA_TYPE_SHA256,
        'sha_request_phrase' => null,
        'sha_response_phrase' => null
    ];

    /**
     * Instance config
     * @var array
     */
    protected $config = [];

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config = [])
    {
        $this->config($config);
    }

    /**
     * @param array|null $set
     * @return array
     */
    protected static function defaults(array $set = null)
    {
        if ($set) {
            static::$defaults = static::standardize($set);
        }
        return static::$defaults;
    }

    /**
     * @param array $config
     * @return array
     */
    protected static function standardize(array $config)
    {
        return array_intersect_assoc($config, static::defaults()) + static::defaults();
    }

    /**
     * @param array $set
     * @return array
     */
    public function config(array $set = null)
    {
        if ($set) {
            $this->config = self::standardize($set);
        }
        return $this->config;
    }

    protected static function underscore($key)
    {
        return preg_replace("/[^a-z]+/", "_", strtolower(preg_replace("/([a-z])([A-Z]+[a-z])/", "\\1 \\2", $key)));
    }

    /**
     * Makes current config the default ones
     * @return void
     */
    public function makeDefault()
    {
        static::$defaults = $this->config();
    }

    /**
     * @param array $config
     * @return static|$this|Config
     */
    public static function make(array $config = [])
    {
        return new static($config);
    }

    public function set($name, $value)
    {

    }

    public function get($name)
    {

    }

    public static function setStatic($name, $value)
    {

    }

    public static function getStatic($name)
    {
        $key = static::underscore($name);
        if (array_key_exists($key, static::defaults())) {
            return static::defaults()[$key];
        }
    }

    public function __set($name, $value)
    {
        return $this->set($name, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __call($name, $arguments)
    {
        return count($arguments) == 1 ? $this->set($name, $arguments[0]) : $this->get($name);
    }

    public static function __callStatic($name, $arguments)
    {
        return count($arguments) == 1 ? static::setStatic($name, $arguments[0]) : static::getStatic($name);
    }

    public function __invoke()
    {
        return $this->config();
    }

}