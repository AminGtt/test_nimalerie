<?php

namespace App\Controller;

use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class PartsController extends AbstractController
{

    public function header(CategorieRepository $categRepo): Response
    {
        return $this->render('header/header.html.twig', [
            'categories' => $categRepo->findAll(),
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
