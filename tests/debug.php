<?php

require_once "../vendor/autoload.php";

use ItvisionSy\PayFort\Config;
Config::defaults();
Config::defaults(['language' => Config::LANG_AR]);
$config = Config::make(['sha_type' => Config::SHA_TYPE_SHA512]);
dd($config->get('language'));