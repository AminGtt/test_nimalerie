<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    /**
     * @Route("/cart", name="cart_details", methods={"GET"})
     */
    public function index(CartService $cartService): Response
    {
        $articles = $cartService->getArticlesInCart();

        $totalTTC = 0;
        $shippingTax = 7.99;

        foreach ($articles as $article) {
            $totalTTC += ($article['product']->getIncltaxPrice() * $article['qty']);
        }

        return $this->render('cart/cart_details.html.twig', [
            "articles" => $articles,
            "totalTtc" => $totalTTC,
            "shippingTax" => $shippingTax
        ]);
    }

    /**
     * @Route("/cart", name="cart_details_delete", methods={"POST"})
     */
    public function delete(CartService $cartService, Request $request): Response
    {
        $articleId = $request->request->get('product_id');

        $cartService->deleteArticle($articleId);

        return $this->redirectToRoute('cart_details');
    }
}
