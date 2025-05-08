<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifierPasswordType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

final class CompteController extends AbstractController
{
    #[Route('/compte', name: 'app_compte')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordHasherInterface $userPassword): Response
    {

        $user= $this->getUser();

        if (!$user instanceof \App\Entity\User) {
                throw new \LogicException('L\'utilisateur n\'est pas connecté ou le type d\'utilisateur est incorrect.');
            }
            
        $form = $this->createForm(ModifierPasswordType::class,$user);
        $form->handleRequest($request);
        $fields = $form->all(); // Permet d'accerder a tous les champs du formulaire

        if($form->isSubmitted() && $form->isValid()){

            $mdpactuel = $fields['password_actuel']->getData();
        

            if($userPassword->isPasswordValid($user,$mdpactuel)){
                
                $newPassword = $form->get('plainPassword')->getData();

                $hashedPassword = $userPassword->hashPassword($user, $newPassword);
                $user->setPassword($hashedPassword);
        
                $entityManager->flush();

                $this->addFlash('success', 'Mot de passe mis à jour avec succès !');


            }

           
   

        }

     

        return $this->render('compte/index.html.twig', [
            'form' => $form,
        ]);
    }

  
}
