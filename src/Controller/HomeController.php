<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Entity\Categorie;
use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em){
        $tabBien = $em->getRepository(Bien::class)->findAll();
        $tabCat = $em->getRepository(Categorie::class)->findAll();
        $nb = $em->getRepository(Bien::class)->count([]);
        $randBien = []; 
        for($i = 0; $i < 3; $i++){
            $rand = random_int(0, $nb-1);
            if (!in_array($tabBien[$rand], $randBien)) {
                $randBien[$i] =  $tabBien[$rand]; 
            }
            else{
                $i--;
            }
            
        }
            return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 'lstBien' => $randBien, 'lstCat' => $tabCat
        ]);
    }
}
