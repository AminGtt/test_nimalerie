<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/admin/contact_form", name="admin_contact_form_")
 */
class ContactFormController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function list(): Response
    {
        return $this->render('admin/contact_form/index.html.twig');
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(): Response
    {
        return $this->render('admin/contact_form/index.html.twig');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(): Response
    {
        return $this->render('admin/contact_form/index.html.twig');
    }
}
