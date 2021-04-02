<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactFormController extends AbstractController
{
    /**
     * @Route("/contact_form", name="contact_form_submit", methods={"POST"})
     */
    public function index(Request $request): Response
    {
        $flashCurrentRoute = array_slice($request->getSession()->getFlashBag()->get('currentRoute'), -1);

        $contact = new ContactForm();
        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);

//        dump(array_slice($request->getSession()->getFlashBag()->get('currentRoute'), -1));

        if ($flashCurrentRoute && $flashCurrentRoute[0]) {
            $precedentRoute = $flashCurrentRoute[0];
        } else {
            $precedentRoute = 'home';
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $this->addFlash('success', 'Votre mail a bien été envoyé, nous vous recontacterons dans les plus brefs délais.');

            return $this->redirectToRoute($precedentRoute);
        } else {
            $this->addFlash('error', 'Une erreur s\'est produite!');


            return $this->redirectToRoute($precedentRoute);
        }
    }
}
