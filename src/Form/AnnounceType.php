<?php

namespace App\Form;

use App\Entity\Announce;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnounceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre de l\'annonce :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
            ->add('price', TextType::class, [
                'label' => 'Prix :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
            ->add('photo')
            ->add('city', TextType::class, [
                'label' => 'Ville :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie :',
                'class' => Category::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Announce::class,
        ]);
    }
}
