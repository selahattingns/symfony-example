<?php
namespace App\Services;

use App\Repository2\OrderItemRepository;

class OrderItemService {

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

    public function firstOrCreate($orderId, $productId, $quantity, $unitPrice, $total){

    }
}