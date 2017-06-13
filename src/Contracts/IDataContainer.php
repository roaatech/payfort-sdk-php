<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/13/17
 * Time: 11:15 AM
 */

namespace ItvisionSy\PayFort\Contracts;


interface IDataContainer extends \IteratorAggregate, \ArrayAccess, \JsonSerializable, \Countable
{

    public static function make(array $data);

    public static function isKeyAllowed($key);

    public static function standardize(array $data);

    public static function allowedKeys();

    public static function mandatoryFields();

    public static function transformToKeyStyle($key);

    public static function transformToMethodStyle($key);

    public function set($key, $value);

    public function get($key);

}