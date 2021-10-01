<?php 

namespace App\Controller\Admin\Classes;

use App\Entity\LineClassEleve;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowClassController extends AbstractController
{
    /**
     * @Route("admin/classe/{id}", name="class_show")
     */
    public function show(int $id,ClasseRepository $classeRepository)
    {
        $classe = $classeRepository->find($id);

            //    dd($classe->getLineClassEleves());

        if(!$classe)
        {
            $this->addFlash('warning','cette classe n\'existe pas');
   
             return $this->redirectToRoute('list_classes');
        }
       
      
        return $this->render('admin/classe/show_class.html.twig',[
            'classe' => $classe
        ]);
    }
}