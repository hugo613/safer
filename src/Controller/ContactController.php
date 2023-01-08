<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request as HttpFoundationRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\Validator\Constraints\DateTime;

class ContactController extends AbstractController
{
    #[Route('/admin/contact', name: 'app_contact_admin')]
    public function index(ContactRepository $contactRepository): Response
    {
        $tab = $contactRepository->findAll();
        return $this->render('contact/index.html.twig', ['lstContact' => $tab]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function sendMessage(HttpFoundationRequest $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $contact->setDate(new DateTimeImmutable());
            $entityManager->persist($contact);
            $entityManager->flush();
            $this->addFlash('success', 'Message envoyer !');
            return $this->redirectToRoute('app_contact');
        
        }
        return $this->render('contact/form.html.twig', [
            'formView' => $form->createView()
        ]);
    }
}
