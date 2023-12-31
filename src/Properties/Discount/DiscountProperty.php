<?php
namespace App\Properties\Discount;

use App\Properties\Discount\Rules\AaaRule;
use App\Properties\Discount\Rules\BbbRule;
use App\Properties\Discount\Rules\CccRule;
use Doctrine\ORM\EntityManagerInterface;

class DiscountProperty {
    /**
     * @var string[]
     */
    private $namespacesForRuleType = [
        AaaRule::class,
        BbbRule::class,
        CccRule::class
    ];

    /**
     * @param $manager
     * @param $order
     * @return void
     */
    public function detectDiscount($manager, $order)
    {
        foreach ($this->namespacesForRuleType as $namespaceForRuleType){
            (new $namespaceForRuleType())->detectDiscountAndBindRule($manager, $order);
        }
    }

    /**
     * @param EntityManagerInterface $manager
     * @param $order
     * @return array
     */
    public function getDiscounts(EntityManagerInterface $manager, $order)
    {
        $discounts = [];
        foreach ($this->namespacesForRuleType as $namespaceForRuleType){
            $ruleClass = new $namespaceForRuleType();
            $discountsForRuleType = $ruleClass->getDiscounts($manager, $order);
            if ($discountsForRuleType){
                $discounts[] = [
                    $ruleClass->type => $discountsForRuleType
                ];
            }
        }return $discounts;
    }

    /**
     * @param $manager
     * @return void
     */
    public function ruleTypeSeeder($manager)
    {
        foreach ($this->namespacesForRuleType as $namespaceForRuleType){
            (new $namespaceForRuleType())->firstOrCreateForTypeTable($manager)->createRules($manager);
        }
    }
}
