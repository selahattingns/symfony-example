<?php
namespace App\Services;

use App\Repository\OrderRepository;

class OrderService {

    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function firstOrCreate($customerId, $total)
    {

    }

    public function create($customerId, $total)
    {

    }

    public function findWithItems($id)
    {

    }

    public function find($id)
    {

    }

    public function updateWithId($id, $total)
    {

    }

    public function newOrder($customerId, $items)
    {
        return [];
    }
}