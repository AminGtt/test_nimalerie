<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
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
                'attr' => ['class' => 'form-control form-control-lg'],
                'label' => 'Genre',
                'placeholder' => 'Choisissez un genre'
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Cersei'
                ],
                'label' => 'Prénom'
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Lannister'
                ],
                'label' => 'Nom de famille'
            ])

            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'toto@gmail.com'
                ]
            ])
//            ->add('roles', ChoiceType::class, [
//                'choices' => [
//                    'User' => 'ROLE_USER', 'Admin' => 'ROLE_ADMIN'
//                ],
//                'expanded' => true,
//                'multiple' => true,
//                'label' => 'Rôles',
//            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Votre mot de passe ne correspond pas.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Repeter le mot de passe',
                    'attr' => [
                        'class' => 'form-control form-control-lg',
                        'placeholder' => 'Mot de passe'
                    ]
                ],
            ])

            ->add('birthDate', BirthdayType::class, [
//                'attr' => ['class' => 'form-control'],
                'label' => 'Date de naissance'
            ])
            ->add('fullAdress', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => '42 rue du test unitaire 13000 MARSEILLE'
                ],
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
