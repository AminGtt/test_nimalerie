<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ClientFixtures extends Fixture
{
    private $pe;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->pe = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $client1 = new Client();
        $client2 = new Client();
        $client3 = new Client();

        $client1->setGender(0);
        $client1->setName('Jon');
        $client1->setLastName('Snow');
        $client1->setEmail('jon@lebatard.com');
        $client1->setPassword($this->pe->encodePassword($client1, 'test'));
        $client1->setBirthDate(\DateTime::createFromFormat('d-m-Y', '05-01-1997'));
        $client1->setFullAdress("Le mur");
        $client1->setRoles(['ROLE_ADMIN']);
        $manager->persist($client1);
        $manager->flush();

        $client2->setGender(1);
        $client2->setName('Jeanne');
        $client2->setLastName('D\'arc');
        $client2->setEmail('ilove@lebucher.com');
        $client2->setPassword($this->pe->encodePassword($client2, 'test'));
        $client2->setBirthDate(\DateTime::createFromFormat('d-m-Y', '10-24-1999'));
        $client2->setFullAdress("Le bucher");
        $client2->setRoles(['ROLE_USER']);
        $manager->persist($client2);
        $manager->flush();

        $client3->setGender(0);
        $client3->setName('Jack');
        $client3->setLastName('Sparrow');
        $client3->setEmail('jack@lepirate.com');
        $client3->setPassword($this->pe->encodePassword($client3, 'test'));
        $client3->setBirthDate(\DateTime::createFromFormat('d-m-Y', '11-09-1980'));
        $client3->setFullAdress("Le black pearl");
        $client3->setRoles(['ROLE_ADMIN']);
        $manager->persist($client3);
        $manager->flush();
    }
}
