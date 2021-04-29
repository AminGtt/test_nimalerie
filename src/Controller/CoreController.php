<?php

namespace App\Controller;

use App\Entity\ContactForm;
use App\Form\ContactFormType;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CoreController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, CategorieRepository $categorieRepository): Response
    {
        $contactForm = new ContactForm();
        $form = $this->createForm(ContactFormType::class, $contactForm);

        // this flash is needed for the contactForm,
        // the form is available on different pages and
        // if we do not set à flash from the route where we come,
        // the redirection is always done on the homepage
        $this->addFlash('currentRoute', $request->attributes->get('_route'));

        $form->handleRequest($request);

        return $this->render('core/index.html.twig', [
            "categories" => $categorieRepository->findAll(),
            "form" => $form->createView(),
        ]);
    }
}
