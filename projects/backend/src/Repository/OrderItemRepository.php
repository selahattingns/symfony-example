<?php
namespace App\Repository;

use App\Interfaces\OrderItemInterface;

class OrderItemRepository implements OrderItemInterface {

    public function firstOrCreate($orderId, $productId, $quantity, $unitPrice, $total){

    }
}