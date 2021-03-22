<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use App\Service\PriceService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OrderRepository::class)
 * @ORM\Table(name="`order`")
 */
class Order
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $totalPrice;

    /**
     * @ORM\ManyToOne(targetEntity=State::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Une commande doit avoir un état.")
     */
    private $state;

    /**
     * @ORM\OneToMany(targetEntity=ProductOrder::class, mappedBy="order", orphanRemoval=true)
     */
    private $productOrders;
    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank(message="Veuillez choisir un client.")
     * @Assert\Choice(message="Une commande doit appartenir à un client.")
     */
    private $client;

    public function __construct()
    {
        $this->productOrders = new ArrayCollection();
    }

    /**
     * @return Collection|ProductOrder[]
     */
    public function getProductOrders(): Collection
    {
        return $this->productOrder;
    }

    public function addProductOrders(ProductOrder $productOrder): self
    {
        if (!$this->productOrders->contains($productOrder)) {
            $this->productOrders[] = $productOrder;
            $productOrder->setProduct($this);
        }

        return $this;
    }

    public function removeProductOrders(ProductOrder $productOrder): self
    {
        if ($this->productOrders->removeElement($productOrder)) {
            // set the owning side to null (unless already changed)
            if ($productOrder->getProduct() === $this) {
                $productOrder->setProduct(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
        return 'Commande n° ' . $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice, PriceService $ps): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getState(): ?State
    {
        return $this->state;
    }

    public function setState(?State $state): self
    {
        $this->state = $state;

        return $this;
    }


    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
