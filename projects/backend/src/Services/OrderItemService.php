<?php
namespace App\Services;

use App\Repository2\OrderItemRepository;

class OrderItemService {

    /**
     * @var OrderItemRepository
     */
    private $orderItemRepository;

    /**
     * @param OrderItemRepository $orderItemRepository
     */
    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function firstOrCreate($orderId, $productId, $quantity, $unitPrice, $total){

    }
}