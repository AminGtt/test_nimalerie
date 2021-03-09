<?php

namespace App\Controller\Admin;

use App\Entity\Brand;
use App\Form\BrandType;
use App\Repository\BrandRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("admin/marque")
 * @IsGranted("ROLE_ADMIN")
 */
class BrandController extends AbstractController
{
    /**
     * @Route("/", name="brand_index", methods={"GET"})
     */
    public function index(BrandRepository $brandRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/brand/index.html.twig', [
            'brands' => $brandRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="brand_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $brand = new Brand();
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($brand);
            $entityManager->flush();

            return $this->redirectToRoute('brand_index');
        }

        return $this->render('admin/brand/new.html.twig', [
            'brand' => $brand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="brand_show", methods={"GET"})
     */
    public function show(Brand $brand): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/brand/show.html.twig', [
            'brand' => $brand,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="brand_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Brand $brand): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('brand_index');
        }

        return $this->render('admin/brand/edit.html.twig', [
            'brand' => $brand,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="brand_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Brand $brand): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$brand->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($brand);
            $entityManager->flush();
        }

        return $this->redirectToRoute('brand_index');
    }
}
