<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categorie();
        $categorie2 = new Categorie();
        $categorie3 = new Categorie();
        $categorie4 = new Categorie();

        $categorie1->setName("Nourriture");
        $manager->persist($categorie1);
        $manager->flush();

        $categorie2->setName("Animalerie 3.0");
        $manager->persist($categorie2);
        $manager->flush();

        $categorie3->setName("Croquette");
        $categorie3->setParent($categorie1);
        $manager->persist($categorie3);
        $manager->flush();

        $categorie4->setName("Paté");
        $categorie4->setParent($categorie1);
        $manager->persist($categorie4);
        $manager->flush();
    }
}
