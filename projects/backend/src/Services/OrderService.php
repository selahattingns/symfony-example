<?php
namespace App\Services;

use App\Repository\CustomerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Container\ContainerInterface;

class OrderService extends ContainerService {

    /**
     * @var EntityManagerInterface
     */
    private $manager;

    /**
     * @param ContainerInterface $container
     * @param EntityManagerInterface $manager
     */
    public function __construct(ContainerInterface $container, EntityManagerInterface $manager)
    {
        $this->manager = $manager;
        parent::__construct($container);
    }

    public static function getSubscribedServices(): array
    {
        return [
            CustomerRepository::class => CustomerRepository::class
        ];
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


    /**
     * todo
     *
     * @param $customerId
     * @param $items
     * @return null
     */
    public function newOrder($customerId, $items)
    {
        $total = 0;
        $order = $this->create($customerId, 0);

        foreach ($items as $item) {
            /**
             * @var ProductService $productService
             */
            $productService = $this->container->get(ProductService::class);
            $product = $productService->find($item["product_id"]);
            if (!$product || $product->stock < $item["quantity"]){
                //throw new QuantityException($product);
            }
            if ($product){
                $total += $product->price * $item["quantity"];
                $product->stock -= $item["quantity"];
                $product->save();
                /**
                 * @var OrderItemService $orderItemService
                 */
                $orderItemService = $this->container->get(OrderItemService::class);
                $orderItemService->firstOrCreate($order->id, $product->id, $item["quantity"], $product->price, $product->price * $item["quantity"]);
            }
        }

        $order->total = $total;
        $order->save();

        return $this->findWithItems($order->id);
    }
}