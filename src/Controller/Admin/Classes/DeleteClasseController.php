<?php 

namespace App\Controller\Admin\Classes;

use App\Entity\LineClassEleve;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteClasseController extends AbstractController
{
    /**
     * @Route("admin/classe/delete/{id}", name="class_delete")
     */
    public function delete(int $id,ClasseRepository $classeRepository,EntityManagerInterface $em)
    {
        $classe = $classeRepository->find($id);


        if(!$classe)
        {
            $this->addFlash('warning','cette classe n\'existe pas');
   
             return $this->redirectToRoute('list_classes');
        }

        $em->remove($classe);

        $em->flush();

        $this->addFlash('success','cette classe est supprimée');

        return $this->redirectToRoute('list_classes');
       
    }
}