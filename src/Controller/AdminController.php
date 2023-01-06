<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin/admin', name: 'app_admin')]
    public function index(AdminRepository $adminRepository): Response
    {
        $tab = $adminRepository->findAll();
        return $this->render('admin/index.html.twig', ['lstAdmin' => $tab]);
    }

    #[Route('/admin/admin/suppr/{id}', name: 'delete_admin')]
    public function delete(EntityManagerInterface $entityManager, int $id)
    {
        $admin = $entityManager->getRepository(Admin::class)->find($id);
        if(!$admin){
            throw $this->createNotFoundException('No admin found');
        }
        $entityManager->remove($admin);
        $entityManager->flush();
        $tab = $entityManager->getRepository(Admin::class)->findAll();
        $this->addFlash('success', 'Admin supprimer avec succes !');
        return $this->render('admin/index.html.twig', ['lstAdmin' => $tab]);
    }
}
