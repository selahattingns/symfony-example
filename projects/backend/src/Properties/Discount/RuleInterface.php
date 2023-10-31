<?php
namespace App\Properties\Discount;

use Doctrine\ORM\EntityManagerInterface;

interface RuleInterface {

    /**
     * $this->ruleDefinition($manager, $order->id, $rule->id)
     *
     * @param EntityManagerInterface $manager
     * @param $order
     * @param $rule
     * @return void
     */
    public function checkForRule(EntityManagerInterface $manager, $order, $rule);

    /**
     * @param $order
     * @param $rule
     * @param $discount
     * @return string
     */
    public function setMessage($order, $rule, $discount): string;
}
