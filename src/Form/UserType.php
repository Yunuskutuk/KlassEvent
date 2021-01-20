<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => "Votre adresse de courriel : ",
                'attr' => [
                    'placeholder' => "Votre courriel"
                ]
            ])
            ->add('password', PasswordType::class, [
                'label' => "Votre mot de passe:  ",
                'attr' => [
                    'placeholder' => "Votre mot de passe"
                ]
            ])
            ->add('name', TextType::class, [
                'label' => "Votre nom : ",
                'attr' => [
                    'placeholder' => "Votre nom"
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => "Votre prénom : ",
                'attr' => [
                    'placeholder' => "Votre prénom"
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => "Votre numéro de téléphone : ",
                'attr' => [
                    'placeholder' => "N° de téléphone"
                ]
            ])
            ->add('adress', TextareaType::class, [
                'label' => "Votre adresse : ",
                'attr' => [
                    'placeholder' => "Votre adresse"
                ]
            ])
            ->add('adressEvent', TextareaType::class, [
                'label' => "Lieu ou adresse de l'événement :",
                'attr' => [
                    'placeholder' => "Adresse de l'événement"
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
