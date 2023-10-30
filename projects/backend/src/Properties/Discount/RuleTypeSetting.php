<?php
namespace App\Properties\Discount;

use App\Entity\OrderDiscount;
use App\Entity\Rule;
use App\Entity\RuleType;
use Doctrine\ORM\EntityManagerInterface;

class RuleTypeSetting {

    /**
     * @var string
     */
    public $type = "";
    /**
     * @var string
     */
    protected $description = "";

    /**
     * @var array
     */
    protected $valuesForRuleTable = [];

    /**
     * @param EntityManagerInterface $manager
     * @return $this
     */
    public function firstOrCreateForTypeTable(EntityManagerInterface $manager)
    {
        $ruleType = new RuleType();
        $ruleType->setType($this->type);
        $ruleType->setDescription($this->description);
        $manager->persist($ruleType);
        $manager->flush();
        return $this;
    }

    /**
     * @return array
     */
    public function getRules()
    {
        $ruleType = $this->getRuleType();
        return []; // $ruleType ? Rule::where('rule_type_id',$ruleType->id)->get() : [];
    }

    /**
     * @return mixed
     */
    public function getRuleType()
    {
        return null; //RuleType::where('type', $this->type)->first();
    }

    /**
     * @param $orderId
     * @param $ruleId
     * @return void
     */
    public function ruleDefinition($orderId, $ruleId)
    {
        $orderDiscount = new OrderDiscount();
        $orderDiscount->setWasItUsed(false);
        //$orderDiscount->setOrder();
        //$orderDiscount->setRule();
        //todo manager
    }

    /**
     * @param EntityManagerInterface $manager
     * @return void
     */
    public function createRules(EntityManagerInterface $manager)
    {
        $ruleType = $this->getRuleType();
        if ($ruleType){
            foreach ($this->valuesForRuleTable as $value){
                $rule = new Rule();
                $rule->setRuleValues($value);
                $rule->setRuleType($ruleType);
                $manager->persist($rule);
                $manager->flush();
            }
        }
    }

    /**
     * @param $order
     * @return void
     */
    public function detectDiscountAndBindRule($order)
    {
        $rules = $this->getRules();
        foreach ($rules as $rule){
            $this->checkForRule($order, $rule);
        }
    }

    /**
     * @param $order
     * @return array|null
     */
    public function getDiscounts($order)
    {
        foreach ($this->getRules() as $rule){
            $discounts = $order->discounts()->where('rule_id', $rule->id)->get();
            foreach ($discounts as $discount){
                $data[] = [
                    "message" => $this->setMessage($order, $rule, $discount),
                    "rule_id" => $rule->id
                ];
            }
        }return $data ?? null;
    }
}
