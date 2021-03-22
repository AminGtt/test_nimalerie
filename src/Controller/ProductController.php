<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function list(): Response
    {
        return $this->render('product/index.html.twig');
    }

    /**
     * @Route("/{name}", name="listByCategorie")
     */
    public function listByCategorie($name, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findOneBy(['name' => $name]);
        return $this->render('product/index.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(): Response
    {
        return $this->render('product/index.html.twig');
    }
}
