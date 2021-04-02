<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use App\Form\ClientType;
use App\Form\InfoAccountType;
use Doctrine\ORM\EntityManagerInterface;
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
        $form = $this->createForm(InfoAccountType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $client->setPassword(
                $passwordEncoder->encodePassword(
                    $client,
                    $this->getUser()->getPassword()
                )
            );

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('account_show');
        }

        return $this->render('account/editMyAcc.html.twig', [
            'client' => $this->getUser(),
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/new_password", name="change_pass")
     */
    public function passwordChange(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $em): Response
    {
        $client = $this->getUser();

        $form = $this->createForm(ChangePasswordType::class, $client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $oldPassword = $form->get('oldPassword')->getData();
            $newPassword = $form->get('plainPassword')->getData();


            if ($passwordEncoder->isPasswordValid($client, $oldPassword)) {

                $newPasswordEncoded = $passwordEncoder->encodePassword($client, $newPassword);
                $client->setPassword($newPasswordEncoded);

                $em->persist($client);
                $em->flush();

                $this->addFlash('success', 'Votre mot de passe à bien été changé.');

                return $this->redirectToRoute('account_show');
            } else {
                $error = 'Votre ancien mot de passe est incorrect';

                return $this->render('account/chPasswd.html.twig', [
                    'client' => $this->getUser(),
                    'form' => $form->createView(),
                    'error' => $error
                ]);
            }
        }

        return $this->render('account/chPasswd.html.twig', [
            'client' => $this->getUser(),
            'form' => $form->createView(),
        ]);
    }
}
