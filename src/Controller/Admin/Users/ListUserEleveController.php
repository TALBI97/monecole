<?php

namespace App\Controller\Admin\Users;


use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListUserEleveController extends AbstractController{

    /**
     * @Route("professeur/eleve/list", name="list_users_eleve")
     */

    public function list(UserRepository $productRepository)
    {
        $users=$productRepository->findAll();


        return $this->render("public/professeur/list_user_eleve.html.twig",['users'=>$users]);
    }
}