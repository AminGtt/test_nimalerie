<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'toto@gmail.com'
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
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
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe SVP',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit avoir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ]
            ])
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Prénom'
                ],
            ])
            ->add('lastName', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Nom'
                ],
            ])
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'Mr' => 0,
                    'Mme' => 1
                ],
                'attr' => ['class' => 'form-control form-control-lg'],
                'label' => 'Genre',
                'placeholder' => 'Choisissez un genre'
            ])
            ->add('birthDate', BirthdayType::class, [
                'attr' => ['class' => 'form-control form-control-lg'],
                'widget' => 'single_text'
            ])
            ->add('fullAdress', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Adresse'
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter les CGV.',
                    ]),
                ],
                'attr' => [
                    'class' => 'form-check-label ml-2'
                ]
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
