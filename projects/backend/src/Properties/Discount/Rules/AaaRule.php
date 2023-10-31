<?php
namespace App\Properties\Discount\Rules;

use App\Entity\Order;
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
     * @param $order
     * @param $rule
     * @param $discount
     * @return string
     */
    public function setMessage($order, $rule, $discount): string
    {
        return $order->id . " id'li sipariş'de toplam " . ($rule->json_rule_values[0] ?? "") . "TL ve üzeri alışveriş için %" . ($rule->json_rule_values[1] ?? "") . " indirim";
    }
}
