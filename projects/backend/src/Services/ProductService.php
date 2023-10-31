<?php
namespace App\Services;

use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class ProductService extends ContainerService {

    public static function getSubscribedServices(): array
    {
        return [
            ProductRepository::class => ProductRepository::class
        ];
    }

    public function firstOrCreate($name, $category, $price, $stock)
    {

    }

    /**
     * @param $id
     * @return \App\Entity\Product|null
     */
    public function find($id)
    {
        /**
         * @var ProductRepository $productRepository
         */
        $productRepository = $this->container->get(ProductRepository::class);
        return $productRepository->find($id);
    }
}