<?php

namespace App\Controller\Admin;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("admin/client")
 * @IsGranted("ROLE_ADMIN")
 */
class ClientController extends AbstractController
{
    /**
     * @Route("/", name="client_index", methods={"GET"})
     */
    public function index(ClientRepository $clientRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/client/index.html.twig', [
            'clients' => $clientRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="client_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $client = new Client();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client->setPassword(
                $passwordEncoder->encodePassword(
                    $client,
                    $form->get('password')->getData())
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($client);
            $entityManager->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('admin/client/new.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_show", methods={"GET"})
     */
    public function show(Client $client): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('admin/client/show.html.twig', [
            'client' => $client,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="client_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Client $client, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client->setPassword(
                $passwordEncoder->encodePassword(
                    $client,
                    $form->get('password')->getData())
            );

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('client_index');
        }

        return $this->render('admin/client/edit.html.twig', [
            'client' => $client,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="client_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Client $client): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$client->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($client);
            $entityManager->flush();
        }

        return $this->redirectToRoute('client_index');
    }
}
