<?php
namespace App\Repository;

use App\Interfaces\OrderInterface;

class OrderRepository implements OrderInterface {

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