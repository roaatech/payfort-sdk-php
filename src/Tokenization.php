<?php
/**
 * Created by PhpStorm.
 * User: Muhannad Shelleh <muhannad.shelleh@live.com>
 * Date: 6/10/17
 * Time: 10:02 AM
 */

namespace ItvisionSy\PayFort;

class Tokenization extends Operation
{

    /**
     * @var string
     */
    protected $merchantReference;
    /**
     * @var string|null
     */
    protected $returnUrl;

    /**
     * Tokenization constructor.
     * @param string $merchantReference The merchant order unique id for the operation
     * @param string|null $returnUrl The URL to return back to after tokenization done
     * @param Config|null $config PayFort config object
     */
    public function __construct($merchantReference, $returnUrl = null, Config $config = null)
    {
        parent::__construct($config);
        $this->merchantReference = $merchantReference;
        $this->returnUrl = $returnUrl;
    }

    public function sign()
    {
        $data = $this->payfortEntries();
        return Signature::forRequest($data, $this->config());
    }

    public function additionalFormFields()
    {
        return $this->sign();
    }

    /**
     * @return string
     */
    public function command()
    {
        return "TOKENIZATION";
    }

    /**
     * @return array
     */
    protected function payfortEntries()
    {
        $entries = [
            'service_command' => $this->command(),
            'merchant_reference' => $this->merchantReference
        ];
        if ($this->returnUrl) {
            $entries['return_url'] = $this->returnUrl;
        }
        return $entries;
    }
}