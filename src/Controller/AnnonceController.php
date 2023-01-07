<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnnonceController extends AbstractController
{
    #[Route('/annonce', name: 'app_annonce')]
    public function index(EntityManagerInterface $em): Response
    {
        $tabBien = $em->getRepository(Bien::class)->findAll();
        $tabCat = $em->getRepository(Categorie::class)->findAll();
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController', 'lstBien' => $tabBien, 'lstCat' => $tabCat
        ]);
    }

    #[Route('/annonce/{id}', name: 'app_annonce_cat')]
    public function annonceCat(EntityManagerInterface $em, int $id): Response
    {
        $currentCat = $em->getRepository(Categorie::class)->find($id);
        $tabBien = $em->getRepository(Bien::class)->findBy(['categorie' => $currentCat]);
        $tabCat = $em->getRepository(Categorie::class)->findAll();
        unset($tabCat[array_search($currentCat, $tabCat)]);
        return $this->render('annonce/index.html.twig', [
            'controller_name' => 'AnnonceController', 'lstBien' => $tabBien, 'lstCat' => $tabCat, 'currentCat' => $currentCat
        ]);
    }

}
