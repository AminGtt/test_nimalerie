<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategorieRepository;
use App\Repository\ProductRepository;
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
    public function list(ProductRepository $productRepository, CategorieRepository $categorieRepository): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
            'categories' => $categorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/{slug}", name="listByCategorie")
     */
    public function listByCategorie($slug, CategorieRepository $categorieRepository, ProductRepository $productRepository): Response
    {
        $categorie = $categorieRepository->findOneBy(['slug' => $slug]);
        $products = $productRepository->findBy(['categorie' => $categorie]);

        return $this->render('product/product-by-categorie.html.twig', [
            'categorie' => $categorie,
            'products' => $products,
            'categories' => $categorieRepository->findAll()
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(Product $product): Response
    {
        return $this->render('product/details.html.twig', [
            'product' => $product,
        ]);
    }
}
