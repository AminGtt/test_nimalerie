<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixtures extends Fixture
{
    private $pe;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->pe = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin1 = new Admin();

        $admin1->setUsername('LaTerreEstPlate');
        $admin1->setPassword($this->pe->encodePassword($admin1, 'Issou2021'));
        $admin1->setRoles(['ROLE_ADMIN']);
        $manager->persist($admin1);
        $manager->flush();
    }
}
