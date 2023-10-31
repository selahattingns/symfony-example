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
     * @param EntityManagerInterface $manager
     * @return array
     */
    public function getRules(EntityManagerInterface $manager)
    {
        $ruleType = $this->getRuleType($manager);
        return []; // $ruleType ? Rule::where('rule_type_id',$ruleType->id)->get() : [];
    }

    /**
     * @param EntityManagerInterface $manager
     * @return null
     */
    public function getRuleType(EntityManagerInterface $manager)
    {
        return null; //RuleType::where('type', $this->type)->first();
    }

    /**
     * @param EntityManagerInterface $manager
     * @param $orderId
     * @param $ruleId
     * @return void
     */
    public function ruleDefinition(EntityManagerInterface $manager, $orderId, $ruleId)
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
        $ruleType = $this->getRuleType($manager);
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
     * @param EntityManagerInterface $manager
     * @param $order
     * @return void
     */
    public function detectDiscountAndBindRule(EntityManagerInterface $manager, $order)
    {
        $rules = $this->getRules($manager);
        foreach ($rules as $rule){
            $this->checkForRule($manager, $order, $rule);
        }
    }

    /**
     * @param EntityManagerInterface $manager
     * @param $order
     * @return array|null
     */
    public function getDiscounts(EntityManagerInterface $manager, $order)
    {
        foreach ($this->getRules($manager) as $rule){
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
