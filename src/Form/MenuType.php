<?php

namespace App\Form;

use App\Entity\Menu;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('price', TextType::class, [
                'label' => 'Prix'
            ])
            ->add('price')
            ->add('description')
            ->add('more')->add('pathFile', VichFileType::class, [
                'required'      => true,
                'download_uri' => true, // not mandatory, default is true
                'label' => 'Uploader votre image',
            ])
            ->add('menuOfWeek', CheckboxType::class, [
                'label' => 'Menu de la semaine'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}
