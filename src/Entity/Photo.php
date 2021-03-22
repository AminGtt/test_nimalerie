<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PhotoRepository::class)
 */
class Photo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     * @Assert\Url(message="Veuillez entrer une URL valide svp")
     * @Assert\NotBlank(message="Ce champ ne peux être vide")
     */
    private $link;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="photos")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\Choice(message="Veuillez choisir un produit.")
     */
    private $product;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
