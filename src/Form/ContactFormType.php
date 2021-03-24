<?php

namespace App\Form;

use App\Entity\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Jean-Claude "BeauGosse" Dusse'
                ]
            ])
            ->add('phone', TelType::class, [
                'attr' => [
                    'placeholder' => 'Téléphone'
                ]
            ])
            ->add('mail', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Adresse e-mail'
                ]
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Message'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}
