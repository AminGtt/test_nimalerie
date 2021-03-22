<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use App\Service\CategoryService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    private $cs;

    public function __construct(CategoryService $cs)
    {
        $this->cs = $cs;
    }

    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categorie();
        $categorie2 = new Categorie();
        $categorie3 = new Categorie();
        $categorie4 = new Categorie();

        $categorie1->setName("Nourriture");
        $this->cs->addCategory($categorie1);

        $categorie2->setName("Animalerie 3.0");
        $this->cs->addCategory($categorie2);

        $categorie3->setName("Croquette");
        $categorie3->setParent($categorie1);
        $this->cs->addCategory($categorie3);

        $categorie4->setName("Paté");
        $categorie4->setParent($categorie1);
        $this->cs->addCategory($categorie4);
    }
}
