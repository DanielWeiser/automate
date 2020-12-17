<?php

namespace App\Entity;

use App\Repository\OrdersProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=OrdersProductRepository::class)
 */
class OrdersProduct
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_id;

    /**
     * @ORM\ManyToOne(targetEntity=Contract::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $contract_id;

    /**
     * @ORM\ManyToOne(targetEntity=Order::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $order_id;

    /**
     * @ORM\Column(type="float")
     */
    private $quantity;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?Product
    {
        return $this->product_id;
    }

    public function setProductId(?Product $product_id): self
    {
        $this->product_id = $product_id;

        return $this;
    }

    public function getContractId(): ?Contract
    {
        return $this->contract_id;
    }

    public function setContractId(?Contract $contract_id): self
    {
        $this->contract_id = $contract_id;

        return $this;
    }

    public function getOrderId(): ?Order
    {
        return $this->order_id;
    }

    public function setOrderId(?Order $order_id): self
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }
}
