<?php

namespace App\Form;

use App\Entity\Bien;
use App\Entity\Categorie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

class BienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, ['label'=>'Titre', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir titre du bien']])
            ->add('description', TextareaType::class, ['label'=>'Description', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir description du bien']])
            ->add('prix', IntegerType::class, ['label'=>'Prix', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir prix du bien']])
            ->add('cp', IntegerType::class, ['label'=>'Code postal', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir code postal']])
            ->add('estVente', ChoiceType::class, ['label'=>'Type', 'attr'=>['class'=>'form-control'], 'choices' => [
                'Vente' => true,
                'Location' => false
            ]])
            ->add('surface', TextType::class, ['label'=>'Surface', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir surface']])
            ->add('ville', TextType::class, ['label'=>'Ville', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir nom de la ville']])
            ->add('categorie', EntityType::class, ['class' => Categorie::class, 'label'=>'Categorie', 'attr'=>['class'=>'form-control'], 'choice_label' => 'Type',])
            ->add('add', SubmitType::class, ['label'=>'Ajouter Bien', 'attr'=>['class'=>'form-control sumbit-form']])
            ->add('img', FileType::class, ['label'=>'Image',  'mapped' => false, 'required' => false, 'constraints'=>[new File(['maxSize' => '1024k', 'mimeTypesMessage' => 'Please upload a valid png/jpg document',])]]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bien::class,
        ]);
    }
}
