<?php

namespace App\DataFixtures;

use App\Entity\State;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StateFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $state1 = new State();
        $state2 = new State();
        $state3 = new State();
        $state4 = new State();

        $state1->setName('En cours');
        $manager->persist($state1);
        $manager->flush();

        $state2->setName('Accépté');
        $manager->persist($state2);
        $manager->flush();

        $state3->setName('Remboursé');
        $manager->persist($state3);
        $manager->flush();

        $state4->setName('Expédié');
        $manager->persist($state4);
        $manager->flush();

    }
}
