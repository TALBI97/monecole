<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MentionLegalController extends AbstractController{

     /**
     * @Route("/mentionLegale", name="mention")
     */
    public function mention()
    {
        return $this->render('shared/_mentionLegal.html.twig');
    }

}