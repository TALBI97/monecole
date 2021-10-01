<?php

namespace App\Controller\Admin\Classes;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreerClassController extends AbstractController
{
    /**
     * @Route("admin/classe/creer", name="admin_classe_create")
     */
    public function index(Request $request, EntityManagerInterface $em, UserRepository $userRepository,ClasseRepository $classeRepository): Response
    {
        $form=$this->createForm(ClasseType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {
            /** @var Classe $data */
            $data = $form->getData();

            $prof = $data->getInstituteur();
            $classe = $data->getNom();
            
            $professeurOccupe = $classeRepository->findOneBy([
               'instituteur' => $prof 
            ]);

            //   $classeOccupe = $classeRepository->findOneBy([
            //    'nom' => $classe 
            // ]);

            // dd($professeurOccupe,$classeOccupe);

            if( $professeurOccupe !== null){

                $this->addFlash('warning','Ce professeur a deja une classe');

                return $this->redirectToRoute('admin_classe_create');
            }

            $em->persist($data);
            
            $em->flush();

            $this->addFlash('success','Votre classe a été ajoutée '.$data->getNom().'');

            return $this->redirectToRoute('list_classes');

        }

        return $this->render('admin/classe/creer_classe.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
