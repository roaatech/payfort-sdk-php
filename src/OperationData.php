<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/11/17
 * Time: 4:35 AM
 */

namespace ItvisionSy\PayFort;

use Exception;
use ItvisionSy\PayFort\Contracts\IDataContainer;
use ItvisionSy\PayFort\Contracts\TDataContainer;

abstract class OperationData implements IDataContainer
{

    use TDataContainer;

    protected static $optionalFields = [];
    protected static $mandatoryFields = [];

    abstract public static function mandatoryFields();

    abstract public static function optionalFields();

    public static function allowedKeys()
    {
        return array_flip(array_merge(static::mandatoryFields(), static::optionalFields()));
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

    public function offsetSet($offset, $value)
    {
        throw new Exception("Readonly array access");
    }

    public function offsetUnset($offset)
    {
        throw new Exception("Readonly array access");
    }

}