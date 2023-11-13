<?php
namespace App\Properties\Discount;

use App\Entity\Order;
use App\Entity\OrderDiscount;
use App\Entity\Rule;
use Doctrine\ORM\EntityManagerInterface;

interface RuleInterface {

    /**
     * $this->ruleDefinition($manager, $order->id, $rule->id)
     *
     * @param EntityManagerInterface $manager
     * @param Order $order
     * @param Rule $rule
     * @return void
     */
    public function checkForRule(EntityManagerInterface $manager, $order, $rule);

    /**
     * @param Order $order
     * @param Rule $rule
     * @param OrderDiscount $discount
     * @return string
     */
    public function setMessage($order, $rule, $discount): string;
}
