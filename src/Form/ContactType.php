<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name', TextType::class, [
                'label' => "Votre nom",
            ])
            ->add('SenderEmail', EmailType::class, [
                'label' => "Votre email",
            ])
            ->add('Number', TextType::class, [
                'label' => "Votre numéro",
            ])
            ->add('Subject', TextType::class, [
                'label' => "Objet",
            ])
            ->add('Message', TextareaType::class, [
                'label' => "Votre Message",
                'attr' => [
                    'cols' => '30',
                    'rows' => '7',
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
