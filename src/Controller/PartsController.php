<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class PartsController extends AbstractController
{

    public function header(CategorieRepository $categRepo): Response
    {
        return $this->render('header/header.html.twig', [
            'categories' => $categRepo->findAll(),
        ]);
    }

    public function cart(SessionInterface $session, CartService $cartService): Response
    {
        if (!$session->has('panier')) {
            $session->set('panier', []);
        }

        $articles = $cartService->getArticlesInCart();

        $totalHT = 0;
        $totalTTC = 0;

        foreach ($articles as $article) {
            $totalHT += ($article['product']->getExcltaxPrice() * $article['qty']);
            $totalTTC += ($article['product']->getIncltaxPrice() * $article['qty']);
        }

        return $this->render('header/cart.html.twig', [
            'articles' => $articles,
            "totalHt" => $totalHT,
            "totalTtc" => $totalTTC
        ]);
    }

//    public function contactForm(Request $request): Response
//    {
//        $contactForm = new ContactForm();
//        $form = $this->createForm(ContactFormType::class, $contactForm);
//        $form->handleRequest($request);
//
//        return $this->render();
//    }
}
