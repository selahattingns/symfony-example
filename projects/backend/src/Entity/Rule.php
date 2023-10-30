<?php

namespace App\Entity;

use App\Repository\RuleRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RuleRepository::class)
 * @ORM\Table(name="`rules`")
 */
class Rule
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $rule_values;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="rules")
     * @ORM\JoinColumn(name="rule_type_id", referencedColumnName="id")
     */
    private $ruleType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRuleValues(): ?string
    {
        return $this->rule_values;
    }

    public function setRuleValues(?string $rule_values): self
    {
        $this->rule_values = $rule_values;

        return $this;
    }
}
