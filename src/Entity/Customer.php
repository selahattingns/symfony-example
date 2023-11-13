<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 * @ORM\Table(name="`customers`")
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $since;

    /**
     * @ORM\Column(type="float")
     */
    private $revenue;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="customer", orphanRemoval=true, cascade={"persist"})
     */
    private $orders;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getSince(): ?\DateTimeInterface
    {
        return $this->since;
    }

    /**
     * @param \DateTimeInterface $since
     * @return $this
     */
    public function setSince(\DateTimeInterface $since): self
    {
        $this->since = $since;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getRevenue(): ?float
    {
        return $this->revenue;
    }

    /**
     * @param float $revenue
     * @return $this
     */
    public function setRevenue(float $revenue): self
    {
        $this->revenue = $revenue;

        return $this;
    }
}
