<?php
namespace App\Services;

use App\Entity\OrderItem;
use App\Repository\OrderItemRepository;
use Psr\Container\ContainerInterface;

class OrderItemService extends ContainerService {

    /**
     * @var OrderItemRepository
     */
    private $repository;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->repository = $this->container->get(OrderItemRepository::class);
    }

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
;
        $this->repository->add($orderItem, $flush);
    }
}