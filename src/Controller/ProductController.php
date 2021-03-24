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
     * @Route("/{slug}", name="listByCategorie")
     */
    public function listByCategorie($slug, CategorieRepository $categorieRepository): Response
    {
        $categorie = $categorieRepository->findOneBy(['slug' => $slug]);


        return $this->render('product/product-by-categorie.html.twig', [
            'categorie' => $categorie,
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(): Response
    {
        return $this->render('product/details.html.twig');
    }
}
