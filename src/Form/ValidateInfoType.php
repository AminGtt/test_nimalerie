<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ValidateInfoType extends AbstractType
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
            ->add('birthDate', BirthdayType::class, [
                'attr' => ['class' => 'form-control form-control-lg'],
                'label' => 'Date de naissance',
                'widget' => 'single_text'
            ])
            ->add('fullAdress', TextType::class, [
                'attr' => [
                    'class' => 'form-control form-control-lg',
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
