<?php

namespace App\Controller\Admin\Classes;

use App\Repository\ClasseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListClassController extends AbstractController{

    /**
     * @Route("admin/classe/list", name="list_classes")
     */

    public function list(ClasseRepository $classeRepository)
    {
        $classes = $classeRepository->findAll();

        return $this->render("admin/classe/list_classe.html.twig",['classes' => $classes]);
    }
}