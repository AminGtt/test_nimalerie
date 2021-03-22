<?php

namespace App\Form;

use App\Entity\Brand;
use App\Entity\Categorie;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Kalash']
            ])
            ->add('description', TextType::class, [
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => 'Lorem ipsum',]
            ])
            ->add('excltaxPrice', MoneyType::class, [
                'label' => 'Prix HT',
                'attr' => ['class' => 'form-control form-control-lg',
                    'placeholder' => '9',]
            ])
            ->add('isActive', CheckboxType::class, [
                'label' => 'Est actif?',
                'required' => false,
                'attr' => ['class' => 'form-control form-control-lg'],
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'multiple' => false,
                'attr' => ['class' => 'form-control form-control-lg'],
                'required' => true,
                'placeholder' => 'Choisissez une catégorie'
            ])
            ->add('brand', EntityType::class, [
                'class' => Brand::class,
                'attr' => ['class' => 'form-control form-control-lg',],
                'label' => 'Marque',
                'placeholder' => 'Choisissez une marque'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
