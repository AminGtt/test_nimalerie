<?php

namespace App\Controller\Admin;

use App\Entity\ContactForm;
use App\Repository\ContactFormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/contact_form", name="admin_contact_form_")
 */
class ContactFormController extends AbstractController
{
    /**
     * @Route("/", name="list", methods={"GET"})
     */
    public function list(ContactFormRepository $contactFormRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/contact_form/index.html.twig', [
            'contact_forms' => $contactFormRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"})
     */
    public function show(ContactForm $contactForm): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/contact_form/show.html.twig', [
            'contact_form' => $contactForm,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"})
     */
    public function delete(ContactForm $contactForm, Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$contactForm->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contactForm);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_contact_form_list');
    }
}
