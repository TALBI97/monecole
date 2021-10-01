<?php

namespace App\Controller;

use App\Form\EmailMessageType;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccueilController extends AbstractController{

     /**
     * @Route("/accueil", name="accueil")
     */
    public function accueilAdmin()
    {
    
        return $this->render('public/public_home.html.twig');

    }


}