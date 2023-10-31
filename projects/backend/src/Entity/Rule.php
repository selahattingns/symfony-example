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
     * @ORM\ManyToOne(targetEntity="RuleType", inversedBy="rules")
     * @ORM\JoinColumn(name="rule_type_id", referencedColumnName="id")
     */
    private $ruleType;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getRuleValues(): ?string
    {
        return $this->rule_values;
    }

    /**
     * @return array
     */
    public function getJsonRuleValues(): array
    {
        return json_decode($this->rule_values) ?? [];
    }

    /**
     * @param string|null $rule_values
     * @return $this
     */
    public function setRuleValues(?string $rule_values): self
    {
        $this->rule_values = $rule_values;

        return $this;
    }

    /**
     * @return RuleType|null
     */
    public function getRuleType(): ?RuleType
    {
        return $this->ruleType;
    }

    /**
     * @param RuleType|null $ruleType
     * @return $this
     */
    public function setRuleType(?RuleType $ruleType): self
    {
        $this->ruleType = $ruleType;
        return $this;
    }
}
