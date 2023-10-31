<?php
namespace App\Services;

use App\Entity\OrderItem;
use App\Repository\OrderItemRepository;

class OrderItemService extends ContainerService {

    public static function getSubscribedServices(): array
    {
        return [
            OrderItemRepository::class => OrderItemRepository::class
        ];
    }

    /**
     * @param $order
     * @param $product
     * @param $quantity
     * @param $unitPrice
     * @param $total
     * @param bool $flush
     * @return void
     */
    public function create($order, $product, $quantity, $unitPrice, $total, bool $flush = true){
        $orderItem = new OrderItem();
        $orderItem->setTotal($total);
        $orderItem->setQuantity($quantity);
        $orderItem->setUnitPrice($unitPrice);
        $orderItem->setOrder($order);
        $orderItem->setProduct($product);

        /**
         * @var OrderItemRepository $orderItemRepository
         */
        $orderItemRepository = $this->container->get(OrderItemRepository::class);
        $orderItemRepository->add($orderItem, $flush);
    }
}