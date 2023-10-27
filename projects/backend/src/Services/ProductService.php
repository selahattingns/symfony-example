<?php
namespace App\Services;

use App\Repository2\ProductRepository;

class ProductService {

    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function firstOrCreate($name, $category, $price, $stock)
    {

    }

    public function find($id)
    {

    }
}