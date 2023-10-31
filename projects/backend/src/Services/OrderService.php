<?php
namespace App\Services;

use App\Entity\Customer;
use App\Entity\Order;
use App\Repository\CustomerRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class OrderService extends ContainerService {

    /**
     * @var EntityManagerInterface
     */
    private $manager;

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

    public static function getSubscribedServices(): array
    {
        return [
            CustomerRepository::class => CustomerRepository::class,
            OrderRepository::class => OrderRepository::class,
            ProductService::class => ProductService::class,
            OrderItemService::class => OrderItemService::class
        ];
    }

    public function firstOrCreate($customerId, $total)
    {

    }

    /**
     * @param $customer
     * @param $total
     * @return Order
     */
    public function create($customer, $total)
    {
        $order = new Order();
        $order->setTotal($total);
        $order->setCustomer($customer);

        $this->repository->add($order, true);

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

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function updateWithId($id, $total)
    {

    }


    /**
     * todo
     *
     * @param $customerId
     * @param $items
     * @return null
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
            $order = $this->create($customer, 0);

            foreach ($items as $item) {
                /**
                 * @var ProductService $productService
                 */
                $productService = $this->container->get(ProductService::class);
                $product = $productService->find($item["product_id"]);
                if (!$product || $product->getStock() < $item["quantity"]){
                    //throw new QuantityException($product); //todo ----------------------------------------------------
                }
                if ($product){
                    $total += $product->getPrice() * $item["quantity"];
                    $product->setStock($product->getStock() - $item["quantity"]);
                    $manager->persist($product);
                    $manager->flush();
                    /**
                     * @var OrderItemService $orderItemService
                     */
                    $orderItemService = $this->container->get(OrderItemService::class);
                    $orderItemService->create($order, $product, $item["quantity"], $product->getPrice(), $product->getPrice() * $item["quantity"]);
                }
            }

            $order->setTotal($total);
            $manager->persist($order);
            $manager->flush();

            return $this->findWithItems($order->getId());
        }
        return "Customer Not Found";
    }
}