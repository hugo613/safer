<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;

class BienController extends AbstractController
{
    #[Route('/bien', name: 'app_bien')]
    public function index(): Response
    {
        return $this->render('bien/index.html.twig', [
        'controller_name' => 'BienController',
        ]);
    }


    #[Route('/bien/add', name: 'add_bien')]
    public function add(HttpFoundationRequest $request, EntityManagerInterface $entityManager)
    {
        $bien = new Bien();

        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($bien);
            $entityManager->flush();
        }

        return $this->render('bien/form.html.twig', [
        'formView' => $form->createView(), 'action' => "Ajouter"
        ]);
    }


    #[Route('/bien/modif/{id}', name: "update_bien")]
    public function update( HttpFoundationRequest $request, EntityManagerInterface $entityManager, int $id)
    {
        $bien = $entityManager->getRepository(Bien::class)->find($id);

        if(!$bien){
            throw $this->createNotFoundException(
                'No bien found for id '.$id
            );
        }

        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($bien);
            $entityManager->flush();
        }

        return $this->render('bien/form.html.twig', [
        'formView' => $form->createView(), 'action' => "Modifier"
        ]);
    }

    #[Route('/bien/suppr/{id}', name: 'delete_bien')]
    public function delete(EntityManagerInterface $entityManager, int $id)
    {
        $bien = $entityManager->getRepository(Bien::class)->find($id);

        if(!$bien){
            throw $this->createNotFoundException(
                'No bien found for id '.$id
            );
        }

        $entityManager->remove($bien);
        $entityManager->flush();

        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
        ]);
    }
}
