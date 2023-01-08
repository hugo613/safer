<?php

namespace App\Controller;

use App\Repository\BienRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class FavorisController extends AbstractController
{
    #[Route('/favoris', name: 'app_favoris')]
    public function index(SessionInterface $session, BienRepository $bienRepository): Response
    {

        $favoris = $session->get('favoris', []);
        $favoriscomplet = [];

        foreach($favoris as $id => $quantity){
            $favoriscomplet[] = [
                'bien' => $bienRepository->find($id),
                'quantite' => $quantity
            ];

        }

        return $this->render('favoris/index.html.twig', [
            'controller_name' => 'FavorisController',
            'items' => $favoriscomplet
        ]);
    }

    #[Route('/favoris/add/{id}', name: 'app_favorisadd')]
    public function add($id, SessionInterface $session){

        $favoris = $session->get('favoris', []);

        if(!empty($favoris[$id])){
            $favoris[$id]++;
        }else{
            $favoris[$id] = 1;
        }
        
        $session->set('favoris', $favoris);
        return $this->redirectToRoute("app_favoris");
        
    }
    #[Route('/favoris/suppr/{id}', name: 'app_favorissuppr')]
    public function suppr($id, SessionInterface $session){
        $favoris = $session->get('favoris', []);
        if(!empty($favoris[$id])){
            unset($favoris[$id]);
        }
        $session->set('favoris', $favoris);
        return $this->redirectToRoute("app_favoris");
    }
}
