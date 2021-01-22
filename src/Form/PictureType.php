<?php

namespace App\Form;

use App\Entity\Picture;
use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pathFile', VichFileType::class, [
                'required'      => true,
                'download_uri' => true, // not mandatory, default is true
                'label' => 'Uploader un fichier depuis votre ordinateur',
            ])
            ->add('alt', TextType::class, [
                'label' => "message alternatif de l'image",
                'attr' => [
                    'placeholder' => "Tapez le nom alternatif de l'image"
                ]
            ])
            ->add('name', TextType::class, [
                'label' => "nom d'enregistrement du fichier",
                'attr' => [
                    'placeholder' => "donner le nom sous lequel l'image sera enregistrée"
                ]
            ])
            ->add('services', EntityType::class, [
                'label' => 'Services concernés: ',
                'expanded' => true,
                'multiple' => true,
                'placeholder' => '-- Choisir les services --',
                'choice_label' => 'title',
                'class' => Service::class
            ])
            ->add('description', TextareaType::class, [
                'label' => "information sur l'option dans le service",
                'attr' => [
                    'placeholder' => "description utile pour faire des choix dans les demandes de devis",
                    'cols' => '30',
                    'rows' => '7'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
