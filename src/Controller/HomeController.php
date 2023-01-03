<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response{
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/', name: 'app_acceuil')]
    public function accueil(EntityManagerInterface $em, BienRepository $bienRepository){

        //save une entity
        /*$bien = new Bien();
        $bien->setTitre("Test");
        $bien->setDescription("desc du test");
        $bien->setCp(44000);
        $bien->setEstVente(True);
        $bien->setPrix(30000);
        $bien->setSurface("10km");
        $em->persist($bien);    //ou flush()

        //recup entity
        $b2 = $bienRepository->find(2);
        $b2->setDescription("une description modifier");
        $em->flush($b2); //remove pour sup
*/
        $tab = $bienRepository->findAll();

            return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 'lstBien' => $tab
        ]);
    }
}
