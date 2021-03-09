<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Order;
use App\Entity\ProductOrder;
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
                'expanded' => true,
                'attr' => ['class' => 'form-control'],
            ])
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'attr' => ['class' => 'form-control'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
