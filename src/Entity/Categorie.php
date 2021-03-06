<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 * @UniqueEntity("slug", message="Une catégorie avec le même slug existe déjà.")
 * @UniqueEntity("name", message="Une catégorie avec le même nom existe déjà.")
 */
class Categorie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Une catégorie doit avoir un nom.")
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * One Category has Many Categories.
     * @ORM\OneToMany(targetEntity="Categorie", mappedBy="parent", orphanRemoval=true)
     */
    private $childrens;

    /**
     * Many Categories have One Category.
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="childrens")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $parent;


    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="categorie", orphanRemoval=true)
     */
    private $products;

    public function __toString()
    {
        return $this->getName();
    }

    public function __construct()
    {
        $this->childrens = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * @param mixed $parent
     */
    public function setParent($parent): void
    {
        $this->parent = $parent;
    }


    public function addChildren(Categorie $categorie){
        if(!$this->childrens->contains($categorie)) {
            $this->childrens->add($categorie);
        }
    }

    public function removeChildren(Categorie $categorie){
        if($this->childrens->containsKey($categorie)){
            $this->childrens->removeElement($categorie);
        }
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $name): self
    {
        $this->slug = $name;

        return $this;
    }

    public function getIsChild(): ?bool
    {
        return $this->isChild;
    }

    public function setIsChild(bool $isChild): self
    {
        $this->isChild = $isChild;

        return $this;
    }

    public function getParentName(): ?string
    {
        return $this->parentName;
    }

    public function setParentName(?string $parentName): self
    {
        $this->parentName = $parentName;

        return $this;
    }

    /**
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): self
    {
        if (!$this->products->contains($product)) {
            $this->products[] = $product;
        }

        return $this;
    }

    public function removeProduct(Product $product): self
    {
        $this->products->removeElement($product);

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getChildrens(): Collection
    {
        return $this->childrens;
    }
}
