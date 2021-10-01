<?php

namespace App\Controller\Admin\Users;


use App\Entity\User;
use App\Repository\ClasseRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\LineClassEleveRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListEleveController extends AbstractController{

    /**
     * @Route("admin/eleve/list", name="list_eleves")
     */

    public function list(LineClassEleveRepository $lineClassEleveRepository,ClasseRepository $classeRepository )
    {

    $lineClasses = $lineClassEleveRepository->findAll();

      return $this->render("admin/eleve/listLineClassEleve.html.twig",['lineClasses' => $lineClasses]);


    }




    
}