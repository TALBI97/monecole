<?php 

namespace App\Controller\Admin\Users;


use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowUserController extends AbstractController
{
    /**
     * @Route("admin/user/{id}", name="user_show")
     */
    public function show(string $id, UserRepository $userRepository)
    {
        $user = $userRepository->findOneBy([
            'id' => $id
        ]);

        if(!$user)
        {
            $this->addFlash('warning','L\'utilisateur n\'existe pas');
            return $this->redirectToRoute('public_home');
        }

        return $this->render('admin/user/show_user.html.twig',[
            'user' => $user
        ]);
    }
}