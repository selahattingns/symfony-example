<?php
namespace App\Services;

use App\Repository\ProductRepository;
use Psr\Container\ContainerInterface;

class ProductService extends ContainerService {

    /**
     * @var ProductRepository
     */
    private $repository;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        parent::__construct($container);
        $this->repository = $this->container->get(ProductRepository::class);
    }

    public static function getSubscribedServices(): array
    {
        return [
            ProductRepository::class => ProductRepository::class
        ];
    }

    /**
     * @param $id
     * @return \App\Entity\Product|null
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }
}