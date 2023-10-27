<?php

namespace App\Entity;

use App\Repository\OrderDetailRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrderDetailRepository::class)
 */
class OrderDetail
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $count2;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="details")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id")
     */
    private $order;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCount2(): ?int
    {
        return $this->count2;
    }

    public function setCount(int $count2): self
    {
        $this->count2 = $count2;

        return $this;
    }
}
