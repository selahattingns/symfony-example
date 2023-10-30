<?php
namespace App\Properties\Discount;

use App\Properties\Discount\Rules\AaaRule;
use App\Properties\Discount\Rules\BbbRule;
use App\Properties\Discount\Rules\CccRule;

class DiscountProperty {
    private $namespacesForRuleType = [
        AaaRule::class,
        BbbRule::class,
        CccRule::class
    ];

    /**
     * @param $order
     * @return void
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function detectDiscount($order)
    {
        foreach ($this->namespacesForRuleType as $namespaceForRuleType){
            (new $namespaceForRuleType())->detectDiscountAndBindRule($order);
        }
    }

    /**
     * @param $order
     * @return array
     */
    public function getDiscounts($order)
    {
        $discounts = [];
        foreach ($this->namespacesForRuleType as $namespaceForRuleType){
            $ruleClass = new $namespaceForRuleType();
            $discountsForRuleType = $ruleClass->getDiscounts($order);
            if ($discountsForRuleType){
                $discounts[] = [
                    $ruleClass->type => $discountsForRuleType
                ];
            }
        }return $discounts;
    }

    /**
     * @return void
     */
    public function ruleTypeSeeder()
    {
        foreach ($this->namespacesForRuleType as $namespaceForRuleType){
            (new $namespaceForRuleType())->firstOrCreateForTypeTable()->createRules();
        }
    }
}
