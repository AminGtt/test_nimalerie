<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Repository\BrandRepository;
use App\Repository\CategorieRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{

    private $brandRepository;
    private $categorieRepository;

    public function __construct(BrandRepository $brandRepository, CategorieRepository $categorieRepository)
    {
        $this->brandRepository = $brandRepository;
        $this->categorieRepository = $categorieRepository;
    }

    public function load(ObjectManager $manager)
    {
        $product1 = new Product();
        $product2 = new Product();
        $product3 = new Product();
        $product4 = new Product();

        $product1->setTitle('Croquettes au poulet pour chien');
        $product1->setDescription('Lorem ipsum');
        $product1->setExcltaxPrice(15.95);
        $product1->setIsActive(true);
        $product1->setBrand($this->brandRepository->findOneBy(['name' => 'Sheba']));
        $product1->setCategorie($this->categorieRepository->findOneBy(['name' => 'Chiens']));
        $manager->persist($product1);
        $manager->flush();

        $product2->setTitle('Paté au boeuf pour chats');
        $product2->setDescription('Lorem ipsum');
        $product2->setExcltaxPrice(11.95);
        $product2->setIsActive(true);
        $product2->setBrand($this->brandRepository->findOneBy(['name' => 'Purina']));
        $product2->setCategorie($this->categorieRepository->findOneBy(['name' => 'Chats']));
        $manager->persist($product2);
        $manager->flush();

        $product3->setTitle('Voyage sur la lune!');
        $product3->setDescription('Lorem ipsum');
        $product3->setExcltaxPrice(140000);
        $product3->setIsActive(true);
        $product3->setBrand($this->brandRepository->findOneBy(['name' => 'SpaceX']));
        $product3->setCategorie($this->categorieRepository->findOneBy(['name' => 'Animalerie 3.0']));
        $manager->persist($product3);
        $manager->flush();

        $product4->setTitle('Nourriture pour poisson');
        $product4->setDescription('Lorem ipsum');
        $product4->setExcltaxPrice(9.95);
        $product4->setIsActive(true);
        $product4->setBrand($this->brandRepository->findOneBy(['name' => 'Sheba']));
        $product4->setCategorie($this->categorieRepository->findOneBy(['name' => 'Poissons']));
        $manager->persist($product4);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            BrandFixtures::class,
            CategorieFixtures::class,
        ];
    }
}
