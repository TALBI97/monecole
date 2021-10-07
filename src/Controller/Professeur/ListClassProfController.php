<?php 

namespace App\Controller\Professeur;

use App\Entity\User;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ListClassProfController extends AbstractController
{
    /**
     * @Route("professeur/prof/show", name="prof_show")
     */
    public function show( ClasseRepository $classeRepository)
    {
        $prof = $this->getUser();

        if(!$prof)
        {
            $this->addFlash('warning','Le professeur n\'existe pas');
             return $this->redirectToRoute('public_home');
        }
        if($prof->getRoles()[0] !== User::ROLE_PROFESSEUR){
            
            $this->addFlash('warning','seul les prof peuvent acceder a cette page');
            
            return $this->redirectToRoute('public_home');
        }
        $classe = $classeRepository->findOneBy([
            'instituteur' => $prof
        ]);

        if(!$classe)
        {
            $this->addFlash('warning','La classe n\'existe pas');
            return $this->redirectToRoute('public_home');
        }

        return $this->render('professeur/list_user_eleve.html.twig',[
            'classe' => $classe
        ]);
    }
}