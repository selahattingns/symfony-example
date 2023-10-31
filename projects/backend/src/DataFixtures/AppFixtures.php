<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager)
    {
        // ...
    }

    /**
     * @return string[]
     */
    public function getDependencies()
    {
        return [
            CustomerFixtures::class,
            ProductFixtures::class,
            RuleTypeFixtures::class
        ];
    }
}
