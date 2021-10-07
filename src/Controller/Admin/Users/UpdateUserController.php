<?php

namespace App\Controller\Admin\Users;

use App\Form\ClasseType;
use App\Form\RegistrationFormType;
use App\Repository\ClasseRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class UpdateUserController extends AbstractController
{
    /**
     * @Route("admin/user/update/{id}", name="update_user")
     */
    public function index(int $id, Request $request, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);
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
            $this->addFlash('success','Votre classe a été modifiée ');
            return $this->redirectToRoute('user_show',['id'=>$id]);
        }

        return $this->render('admin/user/update_user.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
