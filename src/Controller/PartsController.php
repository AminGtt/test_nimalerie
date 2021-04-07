<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PartsController extends AbstractController
{

    public function header(CategorieRepository $categRepo): Response
    {
        return $this->render('header/header.html.twig', [
            'categories' => $categRepo->findAll(),
        ]);
    }

    public function cart(CategorieRepository $categRepo, Request $request, ProductRepository $productRepository): Response
    {
        return $this->render("header/cart.html.twig", [
            'product' => $productRepository->find($request->cookies->get('ProductId'))
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
