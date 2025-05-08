<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
        public function index(AuthenticationUtils $authenticationUtils): Response
        {
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
  
            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();
            //dd($lastUsername);
  
            return $this->render('login/index.html.twig', [
                'last_username' => $lastUsername,
                'error'         => $error,
            ]);
    }

    #[Route('/deconnexion', name: 'app_logout')]
    public function logout(Security $security): Response
    {
        $response = $security->logout(); // déconnecte l'utilisateur (avec CSRF par défaut)

        // Optionnel : redirection personnalisée
        $response = $security->logout(false);

        return $this->redirectToRoute('app_login');

    
    }
}
