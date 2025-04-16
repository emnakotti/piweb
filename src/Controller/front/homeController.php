<?php


namespace App\Controller\front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class homeController extends AbstractController
{

    #[Route('/home', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('front/base.html.twig');
    }
}
