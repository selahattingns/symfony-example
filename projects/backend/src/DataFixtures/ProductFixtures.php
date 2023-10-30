<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Enumerations\ProductEnumeration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $customer = new Product();
        $customer->setName("Decker A7062 40 Parça Cırcırlı Tornavida Seti");
        $customer->setCategory(ProductEnumeration::CATEGORY_ONE);
        $customer->setPrice(120.75);
        $customer->setStock(10);
        $manager->persist($customer);

        $customer = new Product();
        $customer->setName("Reko Mini Tamir Hassas Tornavida Seti 32'li");
        $customer->setCategory(ProductEnumeration::CATEGORY_ONE);
        $customer->setPrice(49.50);
        $customer->setStock(10);
        $manager->persist($customer);

        $customer = new Product();
        $customer->setName("Viko Karre Anahtar - Beyaz");
        $customer->setCategory(ProductEnumeration::CATEGORY_TWO);
        $customer->setPrice(11.28);
        $customer->setStock(10);
        $manager->persist($customer);

        $customer = new Product();
        $customer->setName("Legrand Salbei Anahtar, Alüminyum");
        $customer->setCategory(ProductEnumeration::CATEGORY_TWO);
        $customer->setPrice(22.80);
        $customer->setStock(10);
        $manager->persist($customer);

        $customer = new Product();
        $customer->setName("Schneider Asfora Beyaz Komütatör");
        $customer->setCategory(ProductEnumeration::CATEGORY_TWO);
        $customer->setPrice(12.95);
        $customer->setStock(10);
        $manager->persist($customer);

        $manager->flush();
    }
}
