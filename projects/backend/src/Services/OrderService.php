<?php
namespace App\Services;

use App\Entity\Customer;
use App\Entity\Order;
use App\Exceptions\QuantityException;
use App\Properties\Discount\DiscountProperty;
use App\Repository\CustomerRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class OrderService extends ContainerService {

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @var OrderRepository
     */
    private $repository;

    /**
     * @param ContainerInterface $container
     * @param EntityManagerInterface $manager
     */
    public function __construct(ContainerInterface $container, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($container);
        $this->repository = $this->container->get(OrderRepository::class);
    }

    /**
     * @return string[]
     */
    public static function getSubscribedServices(): array
    {
        return [
            CustomerRepository::class => CustomerRepository::class,
            OrderRepository::class => OrderRepository::class,
            ProductService::class => ProductService::class,
            OrderItemService::class => OrderItemService::class
        ];
    }

    /**
     * @param $customer
     * @param $total
     * @param bool $flush
     * @return Order
     */
    public function create($customer, $total, bool $flush = true)
    {
        $order = new Order();
        $order->setTotal($total);
        $order->setCustomer($customer);

        $this->repository->add($order, $flush);

        return $order;
    }

    /**
     * @param $id
     * @return Order|null
     */
    public function findWithItems($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param $id
     * @return Order|null
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * @param EntityManagerInterface $manager
     * @param $customerId
     * @param $items
     * @return Order|string|null
     * @throws QuantityException
     */
    public function newOrder(EntityManagerInterface $manager, $customerId, $items)
    {
        /**
         * @var CustomerRepository $customerRepository
         */
        $customerRepository = $this->container->get(CustomerRepository::class);
        $customer = $customerRepository->find($customerId);

        if ($customer){
            $total = 0;
            $order = $this->create($customer, 0, false);

            /**
             * @var OrderItemService $orderItemService
             */
            $orderItemService = $this->container->get(OrderItemService::class);

            foreach ($items as $item) {
                /**
                 * @var ProductService $productService
                 */
                $productService = $this->container->get(ProductService::class);
                $product = $productService->find($item["product_id"]);
                if (!$product || $product->getStock() < $item["quantity"]){
                    throw new QuantityException($product);
                }
                if ($product){
                    $total += $product->getPrice() * $item["quantity"];
                    $product->setStock($product->getStock() - $item["quantity"]);
                    $manager->persist($product);

                    $orderItemService->create($order, $product, $item["quantity"], $product->getPrice(), $product->getPrice() * $item["quantity"], false);
                }
            }

            $order->setTotal($total);
            $manager->persist($order);
            $manager->flush();

            (new DiscountProperty())->detectDiscount($manager, $order);

            return $this->findWithItems($order->getId());
        }
        return "Customer Not Found";
    }
}