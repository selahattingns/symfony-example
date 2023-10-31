<?php
namespace App\Properties\Discount\Rules;

use App\Entity\Order;
use App\Entity\Rule;
use App\Properties\Discount\RuleInterface;
use App\Properties\Discount\RuleTypeSetting;
use Doctrine\ORM\EntityManagerInterface;

class CccRule extends RuleTypeSetting implements RuleInterface {

    /**
     * @var string
     */
    public $type = "Ccc";
    /**
     * @var string
     */
    protected $description = "x ID'li kategoriden y veya daha fazla ürün satın alındığında, en ucuz ürüne %z indirim yapılır.";

    /**
     * @var string[]
     */
    protected $valuesForRuleTable = [
        "[1,2,20]"
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
            foreach ($order->getOrderItems() as $orderItem){
                $product = $orderItem->getProduct();
                /* x id li kategori */
                if ($product->getCategory() === $rule->getJsonRuleValues()[0]){
                    /* y veya daha fazla adet satın almak */
                    if($orderItem->getQuantity() >= $rule->getJsonRuleValues()[1]){
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
        return $order->id . " id'li sipariş'de " . ($rule->json_rule_values[1] ?? "") . " adet veya fazla ürün satın alındığı için %" . ($rule->json_rule_values[2] ?? "") . " indirim";
    }
}
