<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 4:35 AM
 */

namespace ItvisionSy\PayFort;

use ItvisionSy\PayFort\Exceptions\InvalidDataException;

abstract class OperationData
{

    protected static $optionalFields = [];
    protected static $mandatoryFields = [];

    protected $data = [];

    /**
     * @param array $data
     * @return static|$this|OperationData
     */
    public static function make(array $data = [])
    {
        return new static($data);
    }

    /**
     * Data constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        $this->data($data);
    }

    /**
     * @param $name
     * @param $value
     * @return array
     */
    protected function set($name, $value)
    {
        $key = static::underscore($name);
        $data = $this->data();
        if (array_key_exists($key, static::allFields())) {
            $validationMethod = "validate" . static::camelCase($key);
            if (method_exists(static::class, $validationMethod)) {
                $value = static::$validationMethod($value);
            }
            $data[$key] = $value;
            $this->data = $data;
        }
        return $data;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    protected function get($name)
    {
        $key = static::underscore($name);
        if (array_key_exists($key, $this->data())) {
            return $this->data()[$key];
        }
        return null;
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

    public function __invoke()
    {
        return $this->data();
    }

    /**
     * @param array $set
     * @return array
     */
    public function data(array $set = null)
    {
        if ($set !== null) {
            $data = self::standardize($set);
            foreach ($data as $key => $value) {
                $this->set($key, $value);
            }
        }
        return $this->data;
    }

    protected static function allFields()
    {
        return array_flip(array_merge(static::$mandatoryFields, static::$optionalFields));
    }

    /**
     * @param array $data
     * @return array
     */
    protected static function standardize(array $data)
    {
        return array_intersect_key($data, static::allFields());
    }

    /**
     * @param $key
     * @param string $char
     * @return string
     */
    protected static function underscore($key, $char = "_")
    {
        return preg_replace("/[^a-z]+/", $char, strtolower(preg_replace("/([a-z])([A-Z]+[a-z])/", "\\1 \\2", $key)));
    }

    /**
     * @param $key
     * @return string
     */
    protected static function camelCase($key)
    {
        return str_replace(" ", "", ucwords(static::underscore($key, " ")));
    }

    /**
     * @return bool
     * @throws InvalidDataException
     */
    public function validate()
    {
        $emptyFields = array_filter($this->data, function ($value, $index) {
            return empty($value);
        });
        if (count($emptyFields) > 0) {
            throw new InvalidDataException("Empty values are not accepted: " . join(", ", $emptyFields));
        }
        $mandatorySet = count(static::$mandatoryFields) === count(array_intersect_key($this->data(), static::$mandatoryFields));
        if ($mandatorySet !== true) {
            throw new InvalidDataException("All keys should be provided: " . join(", ", static::$mandatoryFields));
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

}