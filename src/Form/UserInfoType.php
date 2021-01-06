<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserInfoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "votre nom: ",
                'attr' => [
                    'placeholder' => "votre nom"
                ]
            ])
            ->add('firstName', TextType::class, [
                'label' => "votre prénom: ",
                'attr' => [
                    'placeholder' => "votre prénom"
                ]
            ])
            ->add('phone', TelType::class, [
                'label' => "votre numéro de téléphone: ",
                'attr' => [
                    'placeholder' => "n° de téléphone"
                ]
            ])
            ->add('adress', TextareaType::class, [
                'label' => "votre adresse: ",
                'attr' => [
                    'placeholder' => "votre adresse"
                ]
            ])
            ->add('adressEvent', TextareaType::class, [
                'label' => "lieu ou adresse de l'événement",
                'attr' => [
                    'placeholder' => "adresse de l'événement"
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
