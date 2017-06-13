<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/13/17
 * Time: 11:16 AM
 */

namespace ItvisionSy\PayFort\Contracts;

use ItvisionSy\PayFort\Exceptions\InvalidDataException;

trait TDataContainer
{

    protected $data = [];

    /**
     * @param array $data
     * @return static|$this
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
     * @return $this|static|self
     */
    public function set($name, $value)
    {
        $key = static::transformToKeyStyle($name);
        $data = $this->data();
        if (static::isKeyAllowed($key)) {
            $validationMethod = "validate" . static::transformToMethodStyle($key);
            if (method_exists(static::class, $validationMethod)) {
                $value = static::$validationMethod($value);
            }
            $data[$key] = $value;
            $this->data = $data;
        }
        return $this;
    }

    public static function isKeyAllowed($key)
    {
        return array_search($key, static::allowedKeys()) !== false;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function get($name)
    {
        $key = static::transformToKeyStyle($name);
        if (array_key_exists($key, $this->data())) {
            return $this->data()[$key];
        }
        return null;
    }

    /**
     * @param array $set
     * @return array
     */
    public function data(array $set = null)
    {
        if ($set !== null) {
            foreach ($set as $key => $value) {
                $this->set($key, $value);
            }
        }
        return $this->data;
    }

    /**
     * @param array $data
     * @return array
     */
    public static function standardize(array $data)
    {
        return array_intersect_key($data, array_flip(static::allowedKeys()));
    }

    /**
     * @return bool
     * @throws InvalidDataException
     */
    public function validate()
    {
        $emptyFields = array_filter($this->data, function ($value) {
            return empty($value);
        });
        if (count($emptyFields) > 0) {
            throw new InvalidDataException("Empty values are not accepted: " . join(", ", $emptyFields));
        }
        $mandatorySet = count(static::mandatoryFields()) === count(array_intersect_key($this->data(), array_flip(static::mandatoryFields())));
        if ($mandatorySet !== true) {
            throw new InvalidDataException("All keys should be provided: " . join(", ", static::mandatoryFields()));
        }
        return true;
    }

    public static function transformToMethodStyle($key)
    {
        return studlyCaps($key);
    }

    public static function transformToKeyStyle($key)
    {
        return underscore($key);
    }

    public function count()
    {
        return count($this->data);
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->data);
    }

    public function jsonSerialize()
    {
        return json_encode($this->data);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->data);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
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

}
