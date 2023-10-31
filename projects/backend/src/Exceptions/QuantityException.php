<?php
namespace App\Exceptions;

use Exception;

class QuantityException extends Exception
{
    /**
     * @var
     */
    private $product;

    /**
     * @param $product
     * @param $code
     * @param $previous
     */
    public function __construct($product, $code = 0, $previous = null)
    {
        parent::__construct("", $code, $previous);
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }
}