<?php
namespace App\Services;

use App\Repository2\ProductRepository;

class ProductService {

    /**
     * @var
     */
    private $repository;

    /**
     *
     */
    public function __construct(/*Repository $repository*/)
    {
        //$this->repository = $repository;
    }

    public function firstOrCreate($name, $category, $price, $stock)
    {

    }

    public function find($id)
    {

    }
}