<?php

namespace App\Controller\Admin\Users;

use App\Repository\ClasseRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DeleteUserController extends AbstractController
{
    
    /**
     * @Route("admin/delete/{id}", name="delete_user")
     */

    public function deleteUser(UserRepository $userRepository,int $id,EntityManagerInterface $em): Response
    {

       $user=$userRepository->find($id);
    
       $em->remove($user);

       $em->flush();

       $this->addFlash('success','Votre utilisateur a ete supprime');

       return $this->redirectToRoute('list_users');
    }
}
