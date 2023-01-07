<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('mail', TextType::class, ['attr'=>['class'=>'form-control', 'placeholder'=>'Saisir email']])
            ->add('description', TextareaType::class, ['label'=>'Demande', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir votre demande']])
            ->add('add', SubmitType::class, ['label'=>'Envoyer message', 'attr'=>['class'=>'form-control sumbit-form']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
