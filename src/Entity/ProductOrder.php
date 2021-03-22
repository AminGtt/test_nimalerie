<?php

namespace App\Entity;

use App\Repository\ProductOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=ProductOrderRepository::class)
 */
class ProductOrder
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productOrders", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Veuillez selectionner un produit.")
     * @Assert\Choice(message="Veuillez selectionner un produit.")
     */
    private $product;
    /**
     * @ORM\ManyToOne(targetEntity=Order::class, inversedBy="productOrders", fetch="EAGER")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Veuillez selectionner une commande.")
     * @Assert\Choice(message="Veuillez selectionner une commande.")
     */
    private $order;
    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Veuillez selectionner une quantité.")
     * @Assert\Positive(message="La quantité ne peux être nul ou négative.")
     */
    private $quantity;

    /**
     * @return mixed
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @param mixed $product
     */
    public function setProduct($product): void
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    /**
     * @param mixed $order
     */
    public function setOrder($order): void
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }


}
