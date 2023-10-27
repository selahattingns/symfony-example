<?php
namespace App\Services;

use App\Repository2\OrderRepository;

class OrderService {

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