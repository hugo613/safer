<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Component\String\Slugger\SluggerInterface;

class BienController extends AbstractController
{
    #[Route('/admin/bien', name: 'app_bien')]
    public function index(BienRepository $bienRepository): Response
    {
        $tab = $bienRepository->findAll();
        return $this->render('bien/index.html.twig', ['lstBien' => $tab]);
    }


    #[Route('/admin/bien/add', name: 'add_bien')]
    public function add(HttpFoundationRequest $request, EntityManagerInterface $entityManager, SluggerInterface $slugger)
    {
        $bien = new Bien();
        $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $imgFile = $form->get('img')->getData();

            if ($imgFile) {
                $originalFilename = pathinfo($imgFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imgFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $imgFile->move(
                        $this->getParameter('image_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    $e;
                }
                $bien->setImage($newFilename);
            }
            $entityManager->persist($bien);
            $entityManager->flush();
            $this->addFlash('success', 'Bien cree avec succes !');
            return $this->redirectToRoute('app_bien');
        }
        return $this->render('bien/form.html.twig', [
        'formView' => $form->createView(), 'action' => "Ajouter"
        ]);
    }


    #[Route('/admin/bien/modif/{id}', name: "update_bien")]
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
            $this->addFlash('success', 'Bien modifier avec succes !');
            return $this->redirectToRoute('app_bien');
        }
        return $this->render('bien/form.html.twig', [
        'formView' => $form->createView(), 'action' => "Modifier"
        ]);
    }

    #[Route('/admin/bien/suppr/{id}', name: 'delete_bien')]
    public function delete(EntityManagerInterface $entityManager, int $id)
    {
        $bien = $entityManager->getRepository(Bien::class)->find($id);
        if(!$bien){
            throw $this->createNotFoundException('No bien found');
        }
        $entityManager->remove($bien);
        $entityManager->flush();
        $tab = $entityManager->getRepository(Bien::class)->findAll();
        $this->addFlash('success', 'Bien supprimer avec succes !');
        return $this->render('bien/index.html.twig', ['lstBien' => $tab]);
    }
}
