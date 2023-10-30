<?php

namespace App\Entity;

use App\Repository\OrderDiscountRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDiscountRepository::class)
 * @ORM\Table(name="`order_discounts`")
 */
class OrderDiscount
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", options={"default":false})
     */
    private $was_it_used;

    /**
     * @ORM\ManyToOne(targetEntity=Rule::class, inversedBy="orderDiscounts")
     * @ORM\JoinColumn(name="rule_id", referencedColumnName="id")
     */
    private $rule;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="orderDiscounts")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function isWasItUsed(): ?bool
    {
        return $this->was_it_used;
    }

    /**
     * @param bool $was_it_used
     * @return $this
     */
    public function setWasItUsed(bool $was_it_used): self
    {
        $this->was_it_used = $was_it_used;

        return $this;
    }
}
