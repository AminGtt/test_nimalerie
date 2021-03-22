<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/product", name="product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="list")
     */
    public function list(): Response
    {
        return $this->render('product/index.html.twig');
    }

    /**
     * @Route("/details/{id}", name="details")
     */
    public function details(): Response
    {
        return $this->render('product/index.html.twig');
    }
}
