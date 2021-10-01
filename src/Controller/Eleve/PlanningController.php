<?php

namespace App\Controller\Eleve;

use App\Form\EmailMessageType;
use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlanningController extends AbstractController{

     /**
     * @Route("eleve/planning", name="eleve_planning")
     */
    public function planningEleve()
    {
            
        return $this->render('eleve/planning_eleve.html.twig');
        
    }

}