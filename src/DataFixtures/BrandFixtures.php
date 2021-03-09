<?php

namespace App\DataFixtures;

use App\Entity\Brand;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BrandFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $brand1 = new Brand();
        $brand2 = new Brand();
        $brand3 = new Brand();
        $brand4 = new Brand();

        $brand1->setName('Sheba');
        $manager->persist($brand1);
        $manager->flush();

        $brand2->setName('SpaceX');
        $manager->persist($brand2);
        $manager->flush();

        $brand3->setName('Julius K9');
        $manager->persist($brand3);
        $manager->flush();

        $brand4->setName('Purina');
        $manager->persist($brand4);
        $manager->flush();
    }
}
