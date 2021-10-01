<?php

namespace App\Controller\Admin\Classes;

use App\Entity\LineClassEleve;
use App\Entity\User;
use App\Form\LineClasseEleveType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreerEleveController extends AbstractController
{
    /**
     * @Route("admin/eleve/creer/{id}", name="eleve_create")
     */
    public function index(Request $request, EntityManagerInterface $em,UserRepository $userRepository,int $id): Response
    {



        $form=$this->createForm(LineClasseEleveType::class);

        $form->handleRequest($request);

       

        if($form->isSubmitted() && $form->isValid())
        {

            /** @var LineClassEleve $data */
            $data = $form->getData();

            $em->persist($data);
            
            $em->flush();

            $this->addFlash('success','Votre eleve a été ajoutée ');

            return $this->redirectToRoute('list_classes');

        }

        return $this->render('eleve/creer_eleve.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
