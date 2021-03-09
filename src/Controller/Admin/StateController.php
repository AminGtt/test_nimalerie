<?php

namespace App\Controller\Admin;

use App\Entity\State;
use App\Form\StateType;
use App\Repository\StateRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/state")
 * @IsGranted("ROLE_ADMIN")
 */
class StateController extends AbstractController
{
    /**
     * @Route("/", name="state_index", methods={"GET"})
     */
    public function index(StateRepository $stateRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/state/index.html.twig', [
            'states' => $stateRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="state_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $state = new State();
        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($state);
            $entityManager->flush();

            return $this->redirectToRoute('state_index');
        }

        return $this->render('admin/state/new.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="state_show", methods={"GET"})
     */
    public function show(State $state): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/state/show.html.twig', [
            'state' => $state,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="state_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, State $state): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('state_index');
        }

        return $this->render('admin/state/edit.html.twig', [
            'state' => $state,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="state_delete", methods={"DELETE"})
     */
    public function delete(Request $request, State $state): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$state->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($state);
            $entityManager->flush();
        }

        return $this->redirectToRoute('state_index');
    }
}
