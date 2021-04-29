<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('cc_numbers', TextType::class, [
                'label' => 'Numéros de la carte',
                'attr' => [
                    'placeholder' => 'test',
                    'class' => 'form-control form-control-lg'
                ],
            ])
            ->add('expiration', DateType::class, [
                'label' => 'Date d\'expiration de la carte',
                'attr' => [
                    'class' => 'form-control form-control-lg'
                ],
                'placeholder' => 'test',
                'widget' => 'single_text'
            ])
            ->add('name_on_card', TextType::class, [
                'label' => 'Nom sur la carte',
                'attr' => [
                    'placeholder' => 'test',
                    'class' => 'form-control form-control-lg'
                ],
            ])
            ->add('cvc', TextType::class, [
                'label' => 'CVC',
                'attr' => [
                    'placeholder' => 'test',
                    'class' => 'form-control form-control-lg'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
