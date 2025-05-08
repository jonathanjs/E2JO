<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/categorie/{slug}', name: 'app_category')]
    public function index($slug, CategoryRepository $categoryRepository): Response
    {


        // CategoryRepository l'action qu'il fait :
        // 1 j'ouvre une connexion a ma base de donnée
        // 2 Connecte toi  à la table Category
        // 3 fais une action en base de données

        // Ensuite Nous allon utilisé la variable crée (Slug) dans l'url
        // Nous allons passé passé la variablen argument dans la methode find

        $category = $categoryRepository->findOneBySlug($slug);
        //dd($category);

        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }
}
