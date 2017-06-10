<?php

namespace ItvisionSy\PayFort;

/**
 * Class Config
 * @package ItvisionSy\Payment\PayFort
 * @property boolean sandbox
 * @property string merchantIdentifier
 * @property string accessCode
 * @property string language
 * @property string shaType
 * @property string shaRequestPhrase
 * @property string shaResponsePhrase
 * @method boolean sandbox(boolean $setToValue = null)
 * @method string merchantIdentifier(string $setToValue = null)
 * @method string accessCode(string $setToValue = null)
 * @method string language(string $setToValue = null)
 * @method string shaType(string $setToValue = null)
 * @method string shaRequestPhrase(string $setToValue = null)
 * @method string shaResponsePhrase(string $setToValue = null)
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
    public static function defaults(array $set = null)
    {
        if ($set !== null) {
            $config = static::standardize($set);
            foreach ($config as $key => $value) {
                static::setDefault($key, $value);
            }
        }
        return static::$defaults;
    }

    /**
     * @param array $set
     * @return array
     */
    public function config(array $set = null)
    {
        if ($set !== null) {
            $config = self::standardize($set);
            foreach ($config as $key => $value) {
                $this->set($key, $value);
            }
        }
        return $this->config;
    }

    /**
     * @param array $config
     * @return array
     */
    protected static function standardize(array $config)
    {
        return array_intersect_key($config, static::defaults()) + static::defaults();
    }

    /**
     * @param $key
     * @param string $char
     * @return string
     */
    public static function underscore($key, $char = "_")
    {
        return preg_replace("/[^a-z]+/", $char, strtolower(preg_replace("/([a-z])([A-Z]+[a-z])/", "\\1 \\2", $key)));
    }

    /**
     * @param $key
     * @return string
     */
    public static function camelCase($key)
    {
        return str_replace(" ", "", ucwords(static::underscore($key, " ")));
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

    /**
     * @param $name
     * @param $value
     * @return array
     */
    public function set($name, $value)
    {
        $key = static::underscore($name);
        $config = $this->config();
        if (array_key_exists($key, static::defaults())) {
            $validationMethod = "validate" . static::camelCase($key);
            if (method_exists(static::class, $validationMethod)) {
                $value = static::$validationMethod($value);
            }
            $config[$key] = $value;
            $this->config = $config;
        }
        return $config;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        $key = static::underscore($name);
        if (array_key_exists($key, $this->config())) {
            return $this->config()[$key];
        }
        return null;
    }

    /**
     * @param $name
     * @param $value
     * @return array
     */
    public static function setDefault($name, $value)
    {
        $key = static::underscore($name);
        $defaults = static::defaults();
        if (array_key_exists($key, $defaults)) {
            $validationMethod = "validate" . static::camelCase($key);
            if (method_exists(static::class, $validationMethod)) {
                $value = static::$validationMethod($value);
            }
            $defaults[$key] = $value;
            static::$defaults = $defaults;
        }
        return $defaults;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public static function getDefault($name)
    {
        $key = static::underscore($name);
        if (array_key_exists($key, static::defaults())) {
            return static::defaults()[$key];
        }
        return null;
    }

    /**
     * @return bool
     * @throws Exceptions\InvalidConfigException
     */
    public function validate()
    {
        $valid = static::validateArrayKeysSet($this->config());
        if ($valid !== true) {
            throw new Exceptions\InvalidConfigException("Config key {$valid} is not set");
        }
        return true;
    }

    /**
     * @return bool
     * @throws Exceptions\InvalidConfigException
     */
    public static function validateDefaults()
    {
        $valid = static::validateArrayKeysSet(static::defaults());
        if ($valid !== true) {
            throw new Exceptions\InvalidConfigException("Default config key {$valid} is not set");
        }
        return true;
    }

    /**
     * @param array $array
     * @return bool|int|string
     */
    protected static function validateArrayKeysSet(array $array)
    {
        foreach ($array as $key => $value) {
            if (!$value || empty($value) || !isset($value)) {
                return $key;
            }
        }
        return true;
    }

    /**
     * @param $shaType
     * @return mixed
     */
    protected static function validateShaType($shaType)
    {
        static $shaTypes = [self::SHA_TYPE_SHA256, self::SHA_TYPE_SHA128, self::SHA_TYPE_SHA512];
        if (array_search($shaType, $shaTypes) === false) {
            throw new Exceptions\InvalidConfigException("SHA type should be one of " . join(", ", $shaTypes));
        }
        return $shaType;
    }

    /**
     * @param $language
     * @return string
     */
    protected static function validateLanguage($language)
    {
        static $languages = [self::LANG_EN, self::LANG_AR];
        if (array_search($language, $languages) === false) {
            throw new Exceptions\InvalidConfigException("Language should be one of " . join(", ", $languages));
        }
        return $language;
    }

    /**
     * @param $sandbox
     * @return bool
     */
    protected static function validateSandbox($sandbox)
    {
        return !!$sandbox;
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
        return count($arguments) == 1 ? static::setDefault($name, $arguments[0]) : static::getDefault($name);
    }

    public function __invoke()
    {
        return $this->config();
    }

}