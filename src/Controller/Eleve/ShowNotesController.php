<?php 

namespace App\Controller\Eleve;

use App\Entity\LineClassEleve;
use App\Form\BulteinType;
use App\Repository\BulteinRepository;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Validator\Constraints\Length;

class ShowNotesController extends AbstractController
{
    /**
     * @Route("eleve/show/{id}", name="mes_notes")
     */
 public function show(int $id,BulteinRepository $bulteinRepository,UserRepository $userRepository)
    {   
        $users = $userRepository->find($id);
        $showUser = $bulteinRepository->findBy([
            'Eleve' =>$users
        ]);

        $total=[];
        for ($i=0 ; $i <count($showUser ); $i++) { 
           $total[$i] = $showUser[$i]->getNote();
         
        }
        $moyenne=0;
        for ($j=0 ; $j <count($total ); $j++) { 
           $moyenne += $total[$j];
        }
        if($moyenne == 0){
            $this->addFlash('warning','Vous avez pas de bulletin a voir !');
             return $this->redirectToRoute('accueil');
        }
        $moyenne_total = $moyenne / count($total );
        if(!$users)
        {
            $this->addFlash('warning','cette classe n\'existe pas');
             return $this->redirectToRoute('eleve_show');
        }
       
        return $this->render('eleve/Bulletin.html.twig',[
            'users'=>$users,
            'showUser'=>$showUser,
            'moyenne'=>$moyenne_total
        
        ]);
    }
}