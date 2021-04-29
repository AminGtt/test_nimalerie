<?php

namespace App\Controller;

use App\Form\ClientType;
use App\Form\InfoAccountType;
use App\Form\PaymentType;
use App\Form\ValidateInfoType;
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
    public function cart(CartService $cartService): Response
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

    /**
     * @Route("/cart/validation_info", name="cart_validation_info", methods={"GET"})
     */
    public function buy(Request $request, CartService $cartService): Response
    {
        // if the client isn't connected, redirect on login
        // else redirect him on the validation

        if (!$this->getUser()){

            $this->addFlash('target', $request->attributes->get('_route'));

            return $this->redirectToRoute('app_login');

        } else {
            $client = $this->getUser();
            $form = $this->createForm(ValidateInfoType::class, $client);
            $articles = $cartService->getArticlesInCart();

            $totalTTC = 0;
            $shippingTax = 7.99;

            foreach ($articles as $article) {
                $totalTTC += ($article['product']->getIncltaxPrice() * $article['qty']);
            }

            return $this->render('cart/validate_order.html.twig', [
                "articles" => $articles,
                "totalTtc" => $totalTTC,
                "shippingTax" => $shippingTax,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Route("/cart/payment", name="cart_payment")
     */
    public function payment(CartService $cartService): Response
    {
        $form = $this->createForm(PaymentType::class);
        $articles = $cartService->getArticlesInCart();

        $totalTTC = 0;
        $shippingTax = 7.99;

        foreach ($articles as $article) {
            $totalTTC += ($article['product']->getIncltaxPrice() * $article['qty']);
        }

        return $this->render('cart/payment.html.twig', [
            "articles" => $articles,
            "totalTtc" => $totalTTC,
            "shippingTax" => $shippingTax,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/cart/final", name="cart_final")
     */
    public function finalisation(CartService $cartService): Response
    {
        return $this->render('cart/finalisation.html.twig', [

        ]);
    }
}
