<?php

namespace App\Form;

use App\Entity\Admin;
use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, ['attr'=>['class'=>'form-control', 'placeholder'=>'Saisir email (*)']])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['class'=>'form-control', 'placeholder'=>'Saisir mot de passe (*)', 'autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('nom', TextType::class, ['label'=>'nom','required' => false, 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir mom']])
            ->add('prenom', TextType::class, ['label'=>'prenom','required' => false, 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir prénom']])
            ->add('login', TextType::class, ['label'=>'login', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir login (*)']])
            ->add('add', SubmitType::class, ['label'=>'Ajouter un admin', 'attr'=>['class'=>'form-control sumbit-form']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Admin::class,
        ]);
    }
}
