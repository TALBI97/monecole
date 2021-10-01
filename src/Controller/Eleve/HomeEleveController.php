<?php

namespace App\Controller\Eleve;

use App\Form\EmailMessageType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeEleveController extends AbstractController{

     /**
     * @Route("eleve/accueil", name="eleve_accueil")
     */
    public function accueilEleve()
    {
    
        return $this->render('eleve/home_eleve.html.twig');

    }

}