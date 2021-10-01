<?php

namespace App\Controller\Admin\Action;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RoleEleveController extends AbstractController
{
    /**
     * @Route("admin/user/role/eleve/{id}", name="admin_user_role_eleve")
     */
    public function roleEleve(int $id, UserRepository $userRepository, EntityManagerInterface $em)
    {
        $user = $userRepository->find($id);

        if(!$user)
        {
            $this->addFlash('danger','Cet utilisateur n\'existe pas.');
            return $this->redirectToRoute('list_users');
        }

        $user->setRoles([]);

        $user->setRoles([User::ROLE_ELEVE]);

        $em->flush();

        $this->addFlash('success','L\'utilisateur a bien le rôle : eleve');

        return $this->redirectToRoute('user_show',[ 'id' => $id]);
    }
}