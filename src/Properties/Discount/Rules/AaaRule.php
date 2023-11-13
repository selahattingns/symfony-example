<?php
namespace App\Properties\Discount\Rules;

use App\Entity\Order;
use App\Entity\OrderDiscount;
use App\Entity\Rule;
use App\Properties\Discount\RuleInterface;
use App\Properties\Discount\RuleTypeSetting;
use Doctrine\ORM\EntityManagerInterface;

class AaaRule extends RuleTypeSetting implements RuleInterface {

    /**
     * @var string
     */
    public $type = "Aaa";
    /**
     * @var string
     */
    protected $description = "Toplam x TL ve üzerinde alışveriş yapan bir müşteri, siparişin tamamından %y indirim kazanır";

    /**
     * @var string[]
     */
    protected $valuesForRuleTable = [
        "[500,5]",
        "[1000,20]",
    ];

    /**
     * @param EntityManagerInterface $manager
     * @param Order $order
     * @param Rule $rule
     * @return void
     */
    public function checkForRule(EntityManagerInterface $manager, $order, $rule): void
    {
        /* x adet ve üzeri alışveriş */
        if (isset($rule->getJsonRuleValues()[0]) && $order->getTotal() >= $rule->getJsonRuleValues()[0]){
            $this->ruleDefinition($manager, $order, $rule);
        }
    }

    /**
     * @param Order $order
     * @param Rule $rule
     * @param OrderDiscount $discount
     * @return string
     */
    public function setMessage($order, $rule, $discount): string
    {
        return $order->getId() . " id'li sipariş'de toplam " . ($rule->getJsonRuleValues()[0] ?? "") . "TL ve üzeri alışveriş için %" . ($rule->getJsonRuleValues()[1] ?? "") . " indirim";
    }
}
