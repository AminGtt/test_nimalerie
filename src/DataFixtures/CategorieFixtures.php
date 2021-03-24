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
        $categorie5 = new Categorie();
        $categorie6 = new Categorie();
        $categorie7 = new Categorie();
        $categorie8 = new Categorie();
        $categorie9 = new Categorie();
        $categorie10 = new Categorie();

        $categorie1->setName("Animaux");
        $this->cs->addCategory($categorie1);

        $categorie2->setName("Chiens");
        $categorie2->setParent($categorie1);
        $this->cs->addCategory($categorie2);

        $categorie3->setName("Chats");
        $categorie3->setParent($categorie1);
        $this->cs->addCategory($categorie3);

        $categorie4->setName("Oiseaux");
        $categorie4->setParent($categorie1);
        $this->cs->addCategory($categorie4);

        $categorie5->setName("Rongeurs");
        $categorie5->setParent($categorie1);
        $this->cs->addCategory($categorie5);

        $categorie6->setName("Poissons");
        $categorie6->setParent($categorie1);
        $this->cs->addCategory($categorie6);

        $categorie7->setName("Reptiles & Co");
        $categorie7->setParent($categorie1);
        $this->cs->addCategory($categorie7);

        $categorie8->setName("Animalerie 3.0");
        $categorie8->setParent($categorie1);
        $this->cs->addCategory($categorie8);



        $categorie9->setName("Nourriture");
        $this->cs->addCategory($categorie9);

        $categorie10->setName("Hygiène");
        $this->cs->addCategory($categorie10);

    }
}
