<?php

namespace App\DataFixtures;

use App\Entity\Customer;
use App\Repository\CustomerRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CustomerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $customer = new Customer();
        $customer->setName("Türker Jöntürk");
        $customer->setSince(\DateTime::createFromFormat('Y-m-d', '2014-06-28'));
        $customer->setRevenue(492.12);
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName("Kaptan Devopuz");
        $customer->setSince(\DateTime::createFromFormat('Y-m-d', '2015-01-15'));
        $customer->setRevenue(1505.95);
        $manager->persist($customer);

        $customer = new Customer();
        $customer->setName("İsa Sonuyumaz");
        $customer->setSince(\DateTime::createFromFormat('Y-m-d', '2016-02-11'));
        $customer->setRevenue(0.00);
        $manager->persist($customer);

        $manager->flush();
    }
}
