<?php

namespace App\DataFixtures;

use App\Entity\ProductOrder;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductOrderFixtures extends Fixture implements DependentFixtureInterface
{
    private $or;
    private $pr;

    public function __construct(OrderRepository $orderRepository, ProductRepository $productRepository)
    {
        $this->or = $orderRepository;
        $this->pr = $productRepository;
    }

    public function load(ObjectManager $manager)
    {
        $productOrder1 = new ProductOrder();
        $productOrder2 = new ProductOrder();
        $productOrder3 = new ProductOrder();
        $productOrder4 = new ProductOrder();

        $productOrder1->setProduct($this->pr->findOneBy(['title' => 'Paté au boeuf pour chats']));
        $productOrder1->setOrder($this->getReference(OrderFixtures::REF_ORDER1));
        $productOrder1->setQuantity(4);
        $manager->persist($productOrder1);
        $manager->flush();

        $productOrder2->setProduct($this->pr->findOneBy(['title' => 'Croquettes au poulet pour chien']));
        $productOrder2->setOrder($this->getReference(OrderFixtures::REF_ORDER4));
        $productOrder2->setQuantity(3);
        $manager->persist($productOrder2);
        $manager->flush();

        $productOrder3->setProduct($this->pr->findOneBy(['title' => 'Voyage sur la lune!']));
        $productOrder3->setOrder($this->getReference(OrderFixtures::REF_ORDER1));
        $productOrder3->setQuantity(1);
        $manager->persist($productOrder3);
        $manager->flush();

        $productOrder4->setProduct($this->pr->findOneBy(['title' => 'Croquettes au poulet pour chien']));
        $productOrder4->setOrder($this->getReference(OrderFixtures::REF_ORDER2));
        $productOrder4->setQuantity(2);
        $manager->persist($productOrder4);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProductFixtures::class,
            OrderFixtures::class,
        ];
    }
}
