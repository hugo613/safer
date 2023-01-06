<?php

namespace App\Controller;

use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class HomeController extends AbstractController
{

    #[Route('/', name: 'app_home')]
    public function index(EntityManagerInterface $em, BienRepository $bienRepository){
        $tab = $bienRepository->findAll();
        $nb = $bienRepository->count([]);
        $randBien = []; 
        for($i = 0; $i < 3; $i++){
            $rand = random_int(0, $nb-1);
            if (!in_array($tab[$rand], $randBien)) {
                $randBien[$i] =  $tab[$rand]; 
            }
            else{
                $i--;
            }
            
        }
            return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController', 'lstBien' => $randBien,
        ]);
    }
}
