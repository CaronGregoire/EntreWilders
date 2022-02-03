<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nickname', TextType::class, [
                'label' => 'Pseudo :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Prénom :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'attr' => [
                    'class' => 'text-center border rounded-3 shadow-lg',
                    ]
    ])
                ->add('plainPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'text-center border rounded-3 shadow-lg',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'merci de rentrer votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        'max' => 4096,
                    ]),
                ],
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
