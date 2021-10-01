<?php

namespace App\Controller\Partager;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{
    /**
     * @Route("/", name="public_home")
     */
    public function home(): Response
    {
        return $this->render('public/public_home.html.twig');
    }
}

