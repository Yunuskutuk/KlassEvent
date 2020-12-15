<?php

namespace App\Form;

use App\Entity\Event;
use App\Entity\Option;
use App\Entity\Picture;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Nom du service: ",
                'attr' => [
                    'placeholder' => "Tapez le nom du service"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description du service',
                'attr' => [
                    'placeholder' => 'Ecrivez une description assez courte mais parlante pour le visiteur'
                ]
            ])
            ->add('event', EntityType::class, [
                'label' => 'Services proposé dans les évenements:',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '-- Choisir les évenements --',
                'choice_label' => 'event',
                'class' => Event::class
            ])
            ->add('options', EntityType::class, [
                'label' => 'Options du service:',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '-- Choisir les optionss --',
                'choice_label' => 'options',
                'class' => Option::class
            ])
            ->add('piture', EntityType::class, [
                'label' => 'Photos du services:',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '-- Choisir les photos --',
                'choice_label' => 'picture',
                'class' => Picture::class
            ])
            ->add('picture');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
