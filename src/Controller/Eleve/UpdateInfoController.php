<?php

namespace App\Controller\Eleve;

use App\Form\EmailMessageType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\RegistrationFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class UpdateInfoController extends AbstractController{

     /**
     * @Route("eleve/update/{id}", name="update_infosss")
     */
    public function index(int $id, Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        // $user = $userRepository->find($id);
        $user = $this->getUser();

        // dd($user);

        $form = $this->createForm(RegistrationFormType::class, $user);

        if(!$user)
        {
            $this->addFlash('warning','cette utilisateur n\'existe pas');
   
             return $this->redirectToRoute('list_users');
        }

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            
            $em->flush();

            $this->addFlash('success','Vos infos ont été modifiée ');

            return $this->redirectToRoute('eleve_accueil');


        }

        return $this->render('admin/user/update_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}