<?php

namespace App\Form;

use App\Entity\MenuPicture;
use Symfony\Component\Form\AbstractType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class MenuPictureType extends AbstractType
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
            ->add('type', ChoiceType::class, [
                'label' => 'Type d\'image: ',
                'choices'  => [
                    'Entrée' => 'entree',
                    'Apéritif' => 'aperitif',
                    'Plat' => 'plat',
                    'Desserts et fruits' => 'dessert',
                    'Gateaux' => 'gateaux',
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => "information sur l'image",
                'attr' => [
                    'cols' => '30',
                    'rows' => '7'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MenuPicture::class,
        ]);
    }
}
