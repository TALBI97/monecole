<?php

namespace App\Controller\Admin\Classes;

use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditClassController extends AbstractController
{
    /**
     * @Route("admin/class/edit/{id}", name="class_edit")
     */
    public function index(int $id, Request $request, EntityManagerInterface $em, ClasseRepository $classeRepository): Response
    {
        $classe = $classeRepository->find($id);

        $form = $this->createForm(ClasseType::class, $classe);

        if(!$classe)
        {
            $this->addFlash('warning','cette classe n\'existe pas');
   
             return $this->redirectToRoute('list_classes');
        }

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

            $data = $form->getData();

            $prof = $data->getInstituteur();
            
            $classeOccupe = $classeRepository->findOneBy([
               'instituteur' => $prof 
            ]);

            if($classeOccupe !== null){

                $this->addFlash('warning','Ce professeur a deja une classe');

                return $this->redirectToRoute('admin_classe_create');
            }

            
            $em->flush();

            $this->addFlash('success','Votre classe a été modifiée ');

            return $this->redirectToRoute('list_classes');

        }

        return $this->render('admin/classe/classe_edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
