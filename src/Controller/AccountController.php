<?php

namespace App\Controller;

use App\Form\ClientType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/myaccount", name="account_")
 * @IsGranted("ROLE_USER")
 */
class AccountController extends AbstractController
{
    /**
     * @Route("/", name="show")
     */
    public function myAcc(): Response
    {
        return $this->render('account/myAcc.html.twig', [
            'client' => $this->getUser()
        ]);
    }

    /**
     * @Route("/edit", name="edit")
     */
    public function editMyAcc(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $client = $this->getUser();
        $form = $this->createForm(ClientType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client->setPassword(
                $passwordEncoder->encodePassword(
                    $client,
                    $form->get('password')->getData())
            );

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account_show');
        }

        return $this->render('account/editMyAcc.html.twig', [
            'client' => $this->getUser(),
            'form' => $form->createView()
        ]);
    }
}
