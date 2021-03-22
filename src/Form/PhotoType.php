<?php

namespace App\Form;

use App\Entity\Photo;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhotoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('link', UrlType::class, [
                'label' => 'Lien',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'www.google.fr']
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'label' => 'Produit',
                'attr' => ['class' => 'form-control form-control-lg'],
                'placeholder' => 'Choisissez un produit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
