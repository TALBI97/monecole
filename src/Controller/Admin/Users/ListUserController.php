<?php

namespace App\Controller\Admin\Users;

use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListUserController extends AbstractController{

    /**
     * @Route("admin/user/list", name="list_users")
     */

    public function list(UserRepository $productRepository,Request $request,PaginatorInterface $paginator)
    {
        $users=$productRepository->findAll();

        $users = $paginator->paginate($users,$request->query->getInt('page',1),4);

        return $this->render("admin/user/list_user.html.twig",['users'=>$users]);
    }
}