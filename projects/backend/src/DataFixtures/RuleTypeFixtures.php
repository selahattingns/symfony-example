<?php

namespace App\DataFixtures;

use App\Properties\Discount\DiscountProperty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RuleTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        (new DiscountProperty())->ruleTypeSeeder($manager);
    }
}
