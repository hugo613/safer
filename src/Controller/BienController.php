<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BienController extends AbstractController
{
    #[Route('/bien', name: 'app_bien')]
    public function index(): Response
    {
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
        ]);
    }

    #[Route('/addBien', name: 'app_add_bien')]
    public function add(FormFactoryInterface $factory)
    {
        $builder = $factory->createBuilder();
        $builder->setMethod("get")
            ->add('name', TextType::class, ['label'=>'Titre', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir titre du bien']])
            ->add('description', TextareaType::class, ['label'=>'Description', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir description du bien']])
            ->add('prix', IntegerType::class, ['label'=>'Prix', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir prix du bien']])
            ->add('cp', IntegerType::class, ['label'=>'Code postal', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir code postal']])
            ->add('ville', TextType::class, ['label'=>'Ville', 'attr'=>['class'=>'form-control', 'placeholder'=>'Saisir nom de la ville']])
            ->add('estVente', ChoiceType::class, ['label'=>'Type', 'attr'=>['class'=>'form-control'], 'choices' => [
                'Vente' => true,
                'Location' => false
            ]])
            ->add('categorie', ChoiceType::class, ['label'=>'Categorie', 'attr'=>['class'=>'form-control'], 'choices' => [
                'Terrain agricole' => 1,
                'Prairie' => 2,
                'Bois' => 3,
                'Batiments' => 4,
                'Exploitations' => 5
            ]])
            ->add('add', SubmitType::class, ['label'=>'Ajouter un bien', 'attr'=>['class'=>'form-control sumbit-form']]);
        $form=$builder->getForm();
        $formView=$form->createView();
        return $this->render('bien/add.html.twig', [
            'formView' => $formView,
        ]);
    }
}
