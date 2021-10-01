<?php

namespace App\Controller\Admin\Action;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoleProfesseurController extends AbstractController
{
    /**
     * @Route("admin/user/role/Professeur/{id}", name="admin_user_role_professeur")
     */
    public function roleProfesseur(int $id, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $user = $userRepository->find($id);

        if(!$user)
        {
            $this->addFlash('danger','Cet utilisateur n\'existe pas.');
            return $this->redirectToRoute('list_users');
        }

        $user->setRoles([]);

        $user->setRoles([User::ROLE_PROFESSEUR]);

        $em->flush();

        $this->addFlash('success','L\'utilisateur a bien le rôle : Professeur');

        return $this->redirectToRoute('user_show',[ 'id' => $id]);
    }
}