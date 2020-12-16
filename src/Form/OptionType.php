<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class OptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => "Nom de l'option: ",
                'attr' => [
                    'placeholder' => "Tapez le nom de l'option"
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description de l\'option: ',
                'attr' => [
                    'placeholder' => 'Ecrivez une description assez courte mais parlante pour le visiteur'
                ]
            ])
            ->add('services', EntityType::class, [
                'label' => 'Services concernés: ',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '-- Choisir les services --',
                'choice_label' => 'title',
                'class' => Service::class
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Option::class,
        ]);
    }
}
