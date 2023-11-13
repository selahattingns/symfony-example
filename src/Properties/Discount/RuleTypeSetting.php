<?php
namespace App\Properties\Discount;

use App\Entity\Order;
use App\Entity\OrderDiscount;
use App\Entity\Rule;
use App\Entity\RuleType;
use App\Repository\OrderDiscountRepository;
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
        /**
         * @var RuleType $ruleType
         */
        $ruleType = $this->getRuleType($manager);
        return $ruleType ? $manager->getRepository(Rule::class)->findBy(['ruleType' => $ruleType->getId()]) : [];
    }

    /**
     * @param EntityManagerInterface $manager
     * @return null
     */
    public function getRuleType(EntityManagerInterface $manager)
    {
        return $manager->getRepository(RuleType::class)->findOneBy(['type' => $this->type]);
    }

    /**
     * @param EntityManagerInterface $manager
     * @param $order
     * @param $rule
     * @return void
     */
    public function ruleDefinition(EntityManagerInterface $manager, $order, $rule)
    {
        $orderDiscount = new OrderDiscount();
        $orderDiscount->setWasItUsed(false);
        $orderDiscount->setOrder($order);
        $orderDiscount->setRule($rule);
        $manager->persist($orderDiscount);
        $manager->flush();
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
     * @param Order $order
     * @return array|null
     */
    public function getDiscounts(EntityManagerInterface $manager, Order $order)
    {
        foreach ($this->getRules($manager) as $rule){
            /**
             * @var OrderDiscountRepository $orderDiscountRepository
             * @var Rule $rule
             */
            $orderDiscountRepository = $manager->getRepository(OrderDiscount::class);
            $orderDiscounts = $orderDiscountRepository->findBy(["order" => $order->getId(), "rule" => $rule->getId()]);

            foreach ($orderDiscounts as $discount){
                $data[] = [
                    "message" => $this->setMessage($order, $rule, $discount),
                    "rule_id" => $rule->getId()
                ];
            }
        }return $data ?? null;
    }
}
