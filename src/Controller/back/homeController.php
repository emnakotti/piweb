<?php


namespace App\Controller\back;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController
{

    #[Route('/back', name: 'homepageb')]
    public function index(): Response
    {
        return $this->render('back/index.html.twig');
    }

    
    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        return $this->render('back/test.html.twig');
    }
}
