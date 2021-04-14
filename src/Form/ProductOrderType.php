<?php

namespace App\Form;

use App\Entity\Order;
use App\Entity\Product;
use App\Entity\ProductOrder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('quantity', IntegerType::class, [
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Choisissez une quantité',
                    'min' => 1],
                'label' => 'Quantité :'
                ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'attr' => ['class' => 'form-control form-control-lg'],
                'label' => 'Produit :',
                'placeholder' => 'Choisissez un produit'
                ])
            ->add('order', EntityType::class, [
                'class' => Order::class,
                'attr' => ['class' => 'form-control form-control-lg'],
                'label' => 'Commande :',
                'placeholder' => 'Choisissez une commande'
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductOrder::class,
        ]);
    }
}
