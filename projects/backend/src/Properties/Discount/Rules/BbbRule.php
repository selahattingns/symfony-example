<?php
namespace App\Properties\Discount\Rules;

use App\Entity\Order;
use App\Entity\Rule;
use App\Properties\Discount\RuleInterface;
use App\Properties\Discount\RuleTypeSetting;
use Doctrine\ORM\EntityManagerInterface;

class BbbRule extends RuleTypeSetting implements RuleInterface {

    /**
     * @var string
     */
    public $type = "Bbb";
    /**
     * @var string
     */
    protected $description = "x ID'li kategoriye ait bir üründen y adet satın alındığında, z tanesi ücretsiz olarak verilir.";

    /**
     * @var string[]
     */
    protected $valuesForRuleTable = [
        "[2,6,1]"
    ];

    /**
     * @param EntityManagerInterface $manager
     * @param Order $order
     * @param Rule $rule
     * @return void
     */
    public function checkForRule(EntityManagerInterface $manager, $order, $rule): void
    {
        if (isset($rule->getJsonRuleValues()[0], $rule->getJsonRuleValues()[1])){
            foreach (/*$order->items*/ [] as $item){
                /* x id li kategori */
                if (optional($item->product)->category === $rule->getJsonRuleValues()[0]){
                    /* y adet satın almak */
                    if($item->quantity === $rule->getJsonRuleValues()[1]){
                        $this->ruleDefinition($manager, $order, $rule);
                    }
                }
            }
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
        return $order->id . " id'li sipariş'de " . ($rule->json_rule_values[1] ?? "") . " adet ürün satın alındığı için " . ($rule->json_rule_values[2] ?? "") . " tanesi ücretsiz";
    }
}
