<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Mr' => 0,
                    'Mme' => 1
                ],
                'attr' => ['class' => 'form-control'],
                'label' => 'Genre'
            ])
            ->add('name', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Nom de famille'
            ])

            ->add('email', EmailType::class, [
                'attr' => ['class' => 'form-control']
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'User' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN'
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles',
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Mot de passe'
            ])

            ->add('birthDate', BirthdayType::class, [
//                'attr' => ['class' => 'form-control'],
                'label' => 'Date de naissance'
            ])
            ->add('fullAdress', TextType::class, [
                'attr' => ['class' => 'form-control'],
                'label' => 'Adresse complète'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
