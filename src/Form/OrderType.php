<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Order;
use App\Entity\State;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('state', EntityType::class, [
                'class' => State::class,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-control form-control-lg',
                ],
                'placeholder' => 'Veuillez sélectionnez un état',
                'label' => 'Etat'
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'attr' => ['class' => 'form-control form-control-lg'],
                'placeholder' => 'Choisissez une marque'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
