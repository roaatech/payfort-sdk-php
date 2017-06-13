<?php

namespace ItvisionSy\PayFort;

use ItvisionSy\CreditCard\CreditCard as BaseCreditCard;

class CreditCard extends BaseCreditCard
{

    /**
     * @param array $postData
     * @return CreditCard|null
     */
    public static function makeFromPostData(array $postData)
    {
        $cardNumber = $cardHolderName = $cardExpiryDate = $cardCVV2 = $cardExpiryMonth = $cardExpiryYear = null;
        foreach ($postData as $key => $value) {
            if (preg_match("#card_number|number#", $key)) {
                $cardNumber = $value;
            } elseif (preg_match("#holder|name|owner#", $key)) {
                $cardHolderName = $value;
            } elseif (preg_match("#expiry#", $key)) {
                if (preg_match("#month#", $key)) {
                    $cardExpiryMonth = $value;
                } elseif (preg_match("#year#", $key)) {
                    $cardExpiryYear = $value;
                } else {
                    $cardExpiryDate = $value;
                }
            } elseif (preg_match("#security|cvv2|cvv#", $key)) {
                $cardCVV2 = $value;
            }
        }
        if (!$cardExpiryDate && $cardExpiryMonth && $cardExpiryYear) {
            $cardExpiryDate = $cardExpiryYear . $cardExpiryMonth;
        }
        return static::make($cardNumber, $cardHolderName, $cardExpiryDate, $cardCVV2);
    }

    /**
     * @param string $numberKey
     * @param string $holderKey
     * @param string $expiryKey
     * @param string $securityKey
     * @return array
     */
    public function toArray($numberKey = 'card_number', $holderKey = 'card_holder_name', $expiryKey = 'expiry_date', $securityKey = 'card_security_code')
    {
        $data = [];
        $data[$numberKey] = $this->getCardNumber();
        $data[$expiryKey] = $this->getCardExpiryDate();
        $data[$securityKey] = $this->getCardCVV2();
        $data[$holderKey] = $this->getCardHolderName();
        return $data;
    }

}
