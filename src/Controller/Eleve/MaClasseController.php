<?php 

namespace App\Controller\Eleve;

use App\Entity\LineClassEleve;
use App\Entity\User;
use App\Form\BulteinType;
use App\Form\ClasseType;
use App\Form\LineClasseEleveType;
use App\Repository\BulteinRepository;
use App\Repository\ClasseRepository;
use App\Repository\LineClassEleveRepository;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints\Length;

class MaClasseController extends AbstractController
{
    /**
     * @Route("eleve/maClasse/{id}", name="ma_classe")
     */
 public function show(Request $request,int $id,UserRepository $userRepository,LineClassEleveRepository $lineClassEleveRepository,ClasseRepository $classeRepository):Response
    {  
    
        $eleve = $this->getUser();
        $user = $userRepository->findAll();
        $classe = $classeRepository->findAll();
        $allLineClasse = $lineClassEleveRepository->findAll();
        //  dd($classe);
        $Idclasse=[];
        $classe = $lineClassEleveRepository->findby(['idEleve'=>$eleve]);
        //dd($Idclasse);
        $Idclasse=0;
        $idclasseeleve=[];

        
        $Idclasse = $classe[0]->getIdClasse()->getId();
        for ($i=0;$i<count($allLineClasse);$i++){

            if ($allLineClasse[$i]->getIdClasse()->getId() == $Idclasse){
              
                $idclasseeleve = $lineClassEleveRepository->findby(['idClasse'=>$Idclasse]);

            }
        }
        // dd($idclasseeleve);
         
        
        if(!$eleve)
        {
            $this->addFlash('warning','Le eleve n\'existe pas');
   
             return $this->redirectToRoute('public_home');
        }

        if($eleve->getRoles()[0] !== User::ROLE_ELEVE){
            
            $this->addFlash('warning','seul les prof peuvent acceder a cette page');
            
            return $this->redirectToRoute('public_home');
        }


        if(!$classe)
        {
            $this->addFlash('warning','La classe n\'existe pas');

            return $this->redirectToRoute('public_home');
        }

        return $this->render('eleve/maClasse.html.twig',[
            // 'classe' => $classe,
            'idclasseeleve'=>$idclasseeleve
        ]);

       
    }
}