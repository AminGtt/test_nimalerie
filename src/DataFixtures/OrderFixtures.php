<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Repository\ClientRepository;
use App\Repository\StateRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    private $sr;
    private $cr;

    public const REF_ORDER1 = 'order1';
    public const REF_ORDER2 = 'order2';
    public const REF_ORDER3 = 'order3';
    public const REF_ORDER4 = 'order4';

    public function __construct(StateRepository $stateRepository, ClientRepository $clientRepository)
    {
        $this->sr = $stateRepository;
        $this->cr = $clientRepository;
    }

    public function load(ObjectManager $manager)
    {
        $order1 = new Order();
        $order2 = new Order();
        $order3 = new Order();
        $order4 = new Order();

        $order1->setClient($this->cr->findOneBy(['email' => 'jon@lebatard.com']));
        $order1->setState($this->sr->findOneBy(["name" => 'Accépté']));
        $manager->persist($order1);
        $manager->flush();

        $order2->setClient($this->cr->findOneBy(['email' => 'jon@lebatard.com']));
        $order2->setState($this->sr->findOneBy(["name" => 'Accépté']));
        $manager->persist($order2);
        $manager->flush();

        $order3->setClient($this->cr->findOneBy(['email' => 'jack@lepirate.com']));
        $order3->setState($this->sr->findOneBy(["name" => 'Accépté']));
        $manager->persist($order3);
        $manager->flush();

        $order4->setClient($this->cr->findOneBy(['email' => 'ilove@lebucher.com']));
        $order4->setState($this->sr->findOneBy(["name" => 'Accépté']));
        $manager->persist($order4);
        $manager->flush();

        $this->addReference(self::REF_ORDER1, $order1);
        $this->addReference(self::REF_ORDER2, $order2);
        $this->addReference(self::REF_ORDER3, $order3);
        $this->addReference(self::REF_ORDER4, $order4);
    }

    public function getDependencies()
    {
        return [
            StateFixtures::class,
            ClientFixtures::class,
        ];
    }
}
