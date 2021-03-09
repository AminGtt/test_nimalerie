<?php

namespace App\DataFixtures;

use App\Entity\Photo;
use App\Repository\ProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class PhotoFixtures extends Fixture implements DependentFixtureInterface
{
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function load(ObjectManager $manager)
    {
        $photo1 = new Photo();
        $photo2 = new Photo();
        $photo3 = new Photo();
        $photo4 = new Photo();

        $photo1->setLink('http://place-hold.it/350x150');
        $photo1->setProduct($this->productRepository->findOneBy(['title' => 'Croquettes au poulet pour chien']));
        $manager->persist($photo1);
        $manager->flush();

        $photo2->setLink('http://place-hold.it/350x150');
        $photo2->setProduct($this->productRepository->findOneBy(['title' => 'Paté au boeuf pour chats']));
        $manager->persist($photo2);
        $manager->flush();

        $photo3->setLink('http://place-hold.it/350x150');
        $photo3->setProduct($this->productRepository->findOneBy(['title' => 'Voyage sur la lune!']));
        $manager->persist($photo3);
        $manager->flush();

        $photo4->setLink('http://place-hold.it/350x150');
        $photo4->setProduct($this->productRepository->findOneBy(['title' => 'Nourriture pour poisson']));
        $manager->persist($photo4);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
        ];
    }
}
