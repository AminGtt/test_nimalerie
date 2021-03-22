<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreditController extends AbstractController
{
    /**
     * @Route("/cgv", name="cgv")
     */
    public function cgv(): Response
    {
        return $this->render('credit/cgv.html.twig');
    }

    /**
     * @Route("/quiSommesNous", name="quiSommesNous")
     */
    public function quiSommesNous(): Response
    {
        return $this->render('credit/quiSommesNous.html.twig');
    }

    /**
     * @Route("/mentionsLegales", name="mentionsLegales")
     */
    public function mentionsLegales(): Response
    {
        return $this->render('credit/mentionsLegales.html.twig');
    }

    /**
     * @Route("/privacy", name="privacy")
     */
    public function privacy(): Response
    {
        return $this->render('credit/privacy.html.twig');
    }
}
