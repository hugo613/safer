<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationRequestHandler;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }

    #[Route('/bien/add', name: 'add_bien')]
    public function add(HttpFoundationRequest $request, EntityManagerInterface $entityManager)
    {
        $categorie = new Categorie();

        $form = $this->createForm(BienType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($categorie);
            $entityManager->flush();
        }

        return $this->render('bien/form.html.twig', [
        'formView' => $form->createView(), 'action' => "Ajouter"
        ]);
    }


    #[Route('/categorie/modif/{id}', name: "update_cat")]
    public function update( HttpFoundationRequest $request, EntityManagerInterface $entityManager, int $id)
    {
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        if(!$categorie){
            throw $this->createNotFoundException(
                'No categorie found for id '.$id
            );
        }

        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($categorie);
            $entityManager->flush();
        }

        return $this->render('categorie/form.html.twig', [
        'formView' => $form->createView(), 'action' => "Modifier"
        ]);
    }

    #[Route('/categorie/suppr/{id}', name: 'delete_cat')]
    public function delete(EntityManagerInterface $entityManager, int $id)
    {
        $categorie = $entityManager->getRepository(Categorie::class)->find($id);

        if(!$categorie){
            throw $this->createNotFoundException(
                'No categorie found for id '.$id
            );
        }

        $entityManager->remove($categorie);
        $entityManager->flush();

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }
}
