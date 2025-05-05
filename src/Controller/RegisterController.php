<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User(); // Nous utilisons une instance de lentity USER
        //dd($user);

        $form=$this->createForm(UserFormType::class,$user); 
       
        // Formulaire base sur le UserformType et nous allons lui associer objet User.

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // dd($form->getData());

            $entityManager->persist($user);
            $entityManager->flush();
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
