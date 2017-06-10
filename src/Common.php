<?php

/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/10/17
 * Time: 12:49 PM
 */

namespace ItvisionSy\PayFort;

class Common
{

    public static function payfortEntries(Config $config)
    {
        return [
            'merchant_identifier' => $config->merchantIdentifier,
            'access_code' => $config->accessCode,
            'language' => $config->language
        ];
    }

}