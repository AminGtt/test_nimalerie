<?php

namespace App\Controller\Api\V1;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/api/v1/dashboard", name="api_v1_dashboard")
     */
    public function index(ProductRepository $productRepository): Response
    {
        return $this->json($productRepository->findAll());
    }
}
