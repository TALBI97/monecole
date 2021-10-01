<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CGUController extends AbstractController{

     /**
     * @Route("/CGU", name="cgu")
     */
    public function cgu()
    {
        return $this->render('shared/_cgu.html.twig');
    }

}