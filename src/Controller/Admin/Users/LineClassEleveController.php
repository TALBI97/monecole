<?php

namespace App\Controller\Admin\Users;

use App\Entity\Classe;
use App\Entity\LineClassEleve;
use App\Entity\User;
use App\Form\ClasseType;
use App\Form\LineClasseEleveType;
use App\Form\RegistrationFormType;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LineClassEleveController extends AbstractController
{
    /**
     * @Route("admin/classe_Eleve/creer", name="admin_classe_Eleve_create")
     */
    public function index(Request $request, EntityManagerInterface $em,ClasseRepository $classeRepository,UserRepository $userRepository, LineClassEleveRepository $lineClassEleveRepository): Response
    {   
       $form=$this->createForm(LineClasseEleveType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {
            /** @var LineClasseEleve $data */
            $data = $form->getData();

            $classe = $data->getIdClasse();
            $eleve = $data->getIdEleve();

            $eleveOccupe = $lineClassEleveRepository->findOneBy([
               'idEleve' => $eleve,
              
            ]);
          



            if($eleveOccupe !== null  ){

                $this->addFlash('warning','Cet eleve a deja une classe');

                return $this->redirectToRoute('admin_classe_Eleve_create');
            }

            $em->persist($data);
            
            $em->flush();

            $this->addFlash('success','Votre classe a été ajoutée');

            return $this->redirectToRoute('admin_classe_Eleve_create');

        }

        return $this->render('admin/eleve/lineClassEleve.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
