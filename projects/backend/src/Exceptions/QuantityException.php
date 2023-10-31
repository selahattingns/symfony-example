<?php
namespace App\Exceptions;

use App\Entity\Product;
use Exception;

class QuantityException extends Exception
{
    /**
     * @var Product
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
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
}