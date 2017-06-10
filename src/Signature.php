<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/8/17
 * Time: 6:18 PM
 */

namespace ItvisionSy\PayFort;

class Signature
{

    /**
     * @param array $data
     * @param Config $config
     * @return array
     */
    public static function forRequest(array $data, Config $config)
    {
        $data = [] + $data;
        return static::sign($data, $config, true);
    }

    /**
     * @param array $data
     * @param Config|null $config
     * @return array
     */
    public static function forResponse(array $data, Config $config = null)
    {
        $data = [] + $data;
        return static::sign($data, $config, false);
    }

    /**
     * @param array $data
     * @param Config $config
     * @param bool $forRequest
     * @return array
     */
    public static function sign(array &$data, Config $config, $forRequest = true)
    {
        $data = $data + Common::payfortEntries($config);
        $shaPhrase = $forRequest ? $config->shaRequestPhrase : $config->shaResponsePhrase;
        $data['signature'] = static::generateSignature($data, $config->shaType, $shaPhrase);
        return $data;
    }

    /**
     * @param array $signatureData
     * @param string $shaType
     * @param string $shaPhrase
     * @return string
     */
    protected static function generateSignature(array $signatureData, $shaType, $shaPhrase)
    {
        ksort($signatureData);
        $shaString = $shaPhrase;
        foreach ($signatureData as $key => $value) {
            $shaString .= "$key=$value";
        }
        $shaString .= $shaPhrase;
        $signature = hash($shaType, $shaString);
        return $signature;
    }
}