<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\CategorieRepository;
use App\Repository\ProductRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function list(Request $request, CartService $cartService, ProductRepository $productRepository, CategorieRepository $categorieRepository): Response
    {
        if(count($request->request->all()) > 0) {
            $article = [];
            $product = $productRepository->find($request->request->get('product_id'));
            $article['qty'] = $request->request->get('qty');
            $article['product'] = $product;

            $cartService->addToCart($article);
        }

        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(),
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{slug}", name="listByCategorie")
     */
    public function listByCategorie(Request $request, $slug, CategorieRepository $categorieRepository, ProductRepository $productRepository, CartService $cartService): Response
    {
        if(count($request->request->all()) > 0) {
            $article = [];
            $product = $productRepository->find($request->request->get('product_id'));
            $article['qty'] = $request->request->get('qty');
            $article['product'] = $product;

            $cartService->addToCart($article);
        }

        $categorie = $categorieRepository->findOneBy(['slug' => $slug]);
        $products = $productRepository->findBy(['categorie' => $categorie]);

        return $this->render('product/product-by-categorie.html.twig', [
            'categorie' => $categorie,
            'products' => $products,
            'categories' => $categorieRepository->findAll(),
        ]);
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(Request $request, Product $product, CartService $cartService): Response
    {
        if(count($request->request->all()) > 0) {
            $article = [];
            $article['qty'] = $request->request->get('qty');
            $article['product'] = $product;

            $cartService->addToCart($article);
        }

        return $this->render('product/details.html.twig', [
            'product' => $product,
        ]);
    }
}
