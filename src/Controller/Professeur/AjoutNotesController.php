<?php

namespace App\Controller\Professeur;

use App\Form\BulteinType;
use App\Repository\BulteinRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AjoutNotesController extends AbstractController
{
    /**
     * @Route("professeur/notes/creer", name="prof_notes_create")
     */
    public function index(Request $request, EntityManagerInterface $em, UserRepository $userRepository,BulteinRepository $bulteinRepository): Response
    {
        $form=$this->createForm(BulteinType::class);

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();

            $em->persist($data);
            
            $em->flush();

            $this->addFlash('success','Votre notre a été créer');

            return $this->redirectToRoute('prof_show');

        }

        return $this->render('professeur/ajoutNote.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
