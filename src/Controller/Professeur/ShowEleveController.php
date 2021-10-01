<?php 

namespace App\Controller\Professeur;

use App\Entity\LineClassEleve;
use App\Form\BulteinType;
use App\Repository\BulteinRepository;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ShowEleveController extends AbstractController
{
    /**
     * @Route("professeur/show/{id}", name="eleve_show")
     */
 public function show(int $id,BulteinRepository $bulteinRepository,UserRepository $userRepository)
    {   
         $users = $userRepository->find($id);

        // $form = $this->createForm(BulteinType::class);
        // dd($form);
        // $note=$users->getBultein()->getNote();
        // $matiere=$users->getBultein()->getMatiere();

        $showUser = $bulteinRepository->findBy([
            'Eleve' =>$users
        ]);
        //  dd($showUser);

        if(!$users)
        {
            $this->addFlash('warning','cette classe n\'existe pas');
   
             return $this->redirectToRoute('prof_show');
        }
       
      
        return $this->render('professeur/showEleve.html.twig',[
            'users'=>$users,
            'showUser'=>$showUser
        
        ]);
    }
}