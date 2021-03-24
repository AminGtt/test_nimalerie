<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use App\Repository\CategorieRepository;
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

//    public function contactForm(Request $request): Response
//    {
//        $contactForm = new ContactForm();
//        $form = $this->createForm(ContactFormType::class, $contactForm);
//        $form->handleRequest($request);
//
//        return $this->render();
//    }
}
